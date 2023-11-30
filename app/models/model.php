<?php

namespace app\models;

use PHPMailer\PHPMailer\PHPMailer;

class Model
{
    var $servername = "localhost";
    var $db_name = "recovery_niki_new_db";
    var $username = "recovery_demo";
    var $password = "-pW+@vC;soxy";
    var $conn = '';

    function __construct()
    {
        session_start();
        if (!$this->conn) {
            $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);
        }
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $_SESSION['smtp_from_email'] = 'recovery@gmail.com';
    }

    function select($tableName, $select = '*', $where = '', $join = '', $data = [], $limit = '')
    {
        $sql = "Select $select From $tableName";

        if (!empty($join)) {
            $sql .= " $join ";
        }

        if (!empty($where)) {
            $sql .= " Where $where";
        }

        $sql .= ' ORDER BY id DESC ';

        if (!empty($limit)) {
            $sql .= " LIMIT 1 OFFSET 0 ";
        }

        $result = mysqli_query($this->conn, $sql);

        if ($result->num_rows) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function insert($tableName, $data, $title = '')
    {
        $columnArray = array_column($data, 'name');
        $valueArray = array_column($data, 'value');

        foreach ($columnArray as $key => $each) {
            $dataArray[$each] = $valueArray[$key];
        }

        if ($tableName == 'customer') {
            $sql = "INSERT INTO user (username,password,user_type) VALUES ('" . $dataArray['customer_primary_email_id'] . "','" . md5($dataArray['customer_mobile_no1']) . "','Customer');";
            $result = mysqli_query($this->conn, $sql);
            if (!$result) {
                return false;
            }
            $user_id = $this->select("user", 'id', "username = '" . $dataArray['customer_primary_email_id'] . "'")[0]['id'];
            $dataArray['user_id'] = $user_id;
        }

        $sql = "INSERT INTO $tableName (" . implode(",", array_keys($dataArray)) . ") VALUES ('" . implode("', '", array_values($dataArray)) . "');";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {

            if ($tableName == 'case_register') {
                $modelArray = $this->select($tableName, '*', '', '', '', 1)[0];
                $customer = $this->select('customer', '*', "id = " . $valueArray[0] ?? 0)[0];
                $modelArray = array_merge($customer, $modelArray);

                if (!empty($modelArray['device_maker_id'])) {
                    $manufacturer = $this->select('device_manufacturer', 'manufacturer_name', 'id = ' . $modelArray['device_maker_id'] ?? 0, '', '', 1)[0];
                    $modelArray = array_merge($manufacturer, $modelArray);
                }

                $this->sendMail($customer['customer_primary_email_id'], "Media Details for #" . $modelArray['id'], 'register/inward_submit_email.php', $modelArray);
            }
            $_SESSION['success_message'] = $title . ' created successfully';
            return $result;
        } else {
            return false;
        }
    }

    function update($tableName, $data, $title = '')
    {
        $update = $where = '';
        if (isset($data['event_name'])) {
            if ($data['event_name'] == 'send_estimate') {
                if (isset($data['send_email'])) {
                    $update = '  case_status=2, ';
                } elseif (isset($data['case_status']) && $data['case_status'] != 0) {
                    $update = '  case_status=3, ';
                }
                $update .= ' estimate_amount="' . $data['formData'][3]['value'] . '", customer_remarks="' . $data['formData'][4]['value'] . '", estimate_approved_by_customer="' . $data['formData'][5]['value'] . '" WHERE id=' . $data['inward_register_id'];
            } else if ($data['event_name'] == 'moveToOwtward') {
                $update = ' case_status=4, case_register_state=2 WHERE id=' . $data['inward_register_id'];
            } else if ($data['event_name'] == 'add_storage_detail') {

                $register_id = 0;
                $action_description = '';
                $name = array_column($data['formData'], 'name');
                $value = array_column($data['formData'], 'value');
                for ($i = 0; $i < count($name); $i++) {
                    if ($name[$i] == 'sd_hddno') {
                        $action_description = ($action_description == '') ? "HDD#" . $value[$i] : " || HDD#" . $value[$i];
                    } elseif ($name[$i] == 'sd_size') {
                        $action_description = ($action_description == '') ? "storage size : " . $value[$i] : " || storage size : " . $value[$i];
                    } elseif ('sd_remarks') {
                        $action_description = ($action_description == '') ? "Note : " . $value[$i] : " || Note : " . $value[$i];
                    }
                    if ($name[$i] != 'inward_register_id_storage' && $name[$i] != 'type') {
                        if ($name[$i] == 'case_result' && $value[$i] == 'on') {
                            $value[$i] = 1;
                        } else {
                            $value[$i] = '"' . $value[$i] . '"';
                        }
                        $update .= ' ' . $name[$i] . '= ' . $value[$i] . '' . ((count($name) - 1 != $i) ? ',' : '');
                    } else {
                        if ($name[$i] == 'inward_register_id_storage') {
                            $register_id = $value[$i];
                            $where = " WHERE id = " . $value[$i];
                        }
                    }
                }
                if ($register_id != 0) {
                    self::insert('action_history', ['case_register_id' => $register_id, 'action_title' => 'storage_detail', 'action_description' => '', 'visibility_type' => 'PRIVATE', 'action_dt' =>  new DateTime()], '');
                }

                if (!in_array("case_result", array_column($data['formData'], 'name'))) {
                    $update .= ' ,case_result = 0';
                }
                $update .= $where;
            }
        } elseif (isset($data['formData'])) {
            for ($i = 0; $i < count(array_column($data['formData'], 'name')); $i++) {
                if (array_column($data['formData'], 'name')[$i] != 'case_status' || array_column($data['formData'], 'name')[$i] != 'estimate_approved_by_customer')
                    $update = ' ' . array_column($data['formData'], 'name')[$i] . '="' . array_column($data['formData'], 'value')[$i] . '"' . ((count(array_column($data['formData'], 'name')) - 1 != $i) ? ',' : '');
            }
            $update .= " WHERE id = " . $data['id'];
        } else {
            $id = $data['id'];
            unset($data['id']);
            foreach ($data as $key => $value) {
                $query = " $key = '" . $value . "' ";
                $update .= (($update == '') ? $query : " ,$query");
            }
            $update .= " WHERE id = " . $id;
        }

        $sql = "UPDATE $tableName SET $update";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            $_SESSION['success_message'] = $title . ' successfully';
            return $result;
        } else {
            return false;
        }
    }

    function delete($tableName, $data, $title = '')
    {
        if ($tableName == 'customer') {
            $sql = "DELETE FROM user WHERE username = '" . $data['customer_primary_email_id'] . "' AND user_type='Customer'";
            $resultSubQuery = mysqli_query($this->conn, $sql);
            if (!$resultSubQuery) {
                $_SESSION['error_message'] = 'User not Found';
                return false;
            }
        }

        $sql = "DELETE FROM $tableName WHERE id = " . $data['delete_id'];
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            $_SESSION['success_message'] = $title . ' deleted successfully';
            return true;
        } else {
            return false;
        }
    }

    function user_authentication($data)
    {
        $sql = "SELECT id,user_type FROM user Where";
        $data['password'] = md5($data['password']);
        for ($i = 0; $i < count($data); $i++) {
            if ($i != 0) {
                $sql .= " AND ";
            }
            $sql .= " " . array_keys($data)[$i] . " = '" . $data[array_keys($data)[$i]] . "'";
        }
        $sql .= " LIMIT 1 ";

        $result = mysqli_query($this->conn, $sql);
        if ($result->num_rows) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            $customer = "SELECT company_name,customer_city_location FROM customer Where user_id= '" . $data[0]['id'] . "'";

            $customerResult = mysqli_query($this->conn, $customer);
            $customerData = mysqli_fetch_assoc($customerResult);

            $_SESSION['success_message'] = 'Login successfully';
            $_SESSION['user_id'] = $data[0]['id'];
            $_SESSION['user_type'] = $data[0]['user_type'];
            $_SESSION['company_name'] = $customerData['company_name'];
            $_SESSION['user_city'] = $customerData['customer_city_location'];
            return true;
        } else {
            return ['success' => 'false'];
        }
    }

    function change_password($data)
    {
        $user = $this->select('user', '*', ' id=' . $data['id'])[0];
        if ($user['password'] == md5($data['current_password'])) {
            $this->update('User', ['id' => $data['id'], 'password' => md5($data['new_password'])], 'Password changed ');

            return true;
        } else {
            return ['error' => true, 'message' => 'Current password is incorrect'];
        }
    }

    function sendMail($to, $subject, $view, $modelArray, $redirect = '', $html = true, $attachment = "")
    {
        require_once "../../vendor/autoload.php";

        // $MAIL_HOST = "mail.recoveryourdata.co.in";
        // $MAIL_PORT = "587";
        // $SENDER_USERNAME = "authorise@recoveryourdata.co.in";
        // $SENDER_PWD = "Girirajbawa@nathdwara*";
        $MAIL_HOST = "sandbox.smtp.mailtrap.io";
        $MAIL_PORT = "2525";
        $SENDER_USERNAME = "9f51d16c8abf51";
        $SENDER_PWD = "75c10c91473816";

        $REPLY_TO_EMAIL = "support@recoveryourdata.co.in";
        $REPLY_TO_NAME = "Ni-Ki Data Recovery Services";
        $FROM_EMAIL = "support@recoveryourdata.co.in";
        $FROM_NAME = "Ni-Ki Data Recovery Services";
        $SUBJECT = "Partner Program Registration Form";

        $mail = new PHPMailer(true); //New instance, with exceptions enabled
        $mail->IsSMTP();
        $mail->Host = $MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Port = $MAIL_PORT;
        $mail->Username = $SENDER_USERNAME;
        $mail->Password = $SENDER_PWD;
        $mail->AddReplyTo($REPLY_TO_EMAIL, $REPLY_TO_NAME);
        $mail->From       = $FROM_EMAIL;
        $mail->FromName   = $FROM_NAME;
        $mail->Subject  = $subject;
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
        $mail->WordWrap   = 80;
        if (!empty($attachment)) {
            $mail->AddAttachment($attachment);
        }

        $body = $this->render($modelArray, $view);
        $mail->Body = $body;
        $mail->IsHTML(true); // send as HTML 
        $mail->AddAddress(trim($to));
        if (!$mail->Send()) {
            $_SESSION['error_message'] = "Error sending: " . $mail->ErrorInfo;
        }
        $_SESSION['success_message'] = 'Mail send successfully';

        return;
    }

    function render(array $model, $template)
    {
        extract($model);

        ob_start();
        include('../views/' . $template);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
