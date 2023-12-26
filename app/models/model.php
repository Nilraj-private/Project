<?php

namespace app\models;

use DateTime;
use PHPMailer\PHPMailer\PHPMailer;

class Model
{
  var $servername = "localhost";
  var $db_name = "recovery_niki_new_db";
  var $username = "recovery_demo";
  var $password = "-pW+@vC;soxy";
  var $conn = '';
  var $API_KEY = 'eGNMdHhRUjlkc2lHZ0FkUVNRZ2pLOW13MENSNGJGSHJROUZIVFRSRmwwRTo=';

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

  function select($tableName, $select = '*', $where = '', $join = '', $data = [], $limit = '', $offset = 0)
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
      $sql .= " LIMIT $limit OFFSET $offset ";
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

    if (!empty($columnArray)) {
      foreach ($columnArray as $key => $each) {
        if ($each != 'deliver_through_courier' && $each != 'courier_name' && $each != 'courier_dock_number') {
          $dataArray[$each] = $valueArray[$key];
        } else {
          $actionHistoryDataArray[$each] = $valueArray[$key];
        }
      }

      if ($tableName == 'customer') {
        $sql = "INSERT INTO user (username,password,user_type,is_active) VALUES ('" . $dataArray['customer_primary_email_id'] . "','" . md5($dataArray['customer_mobile_no1']) . "','Customer',1);";
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
          return false;
        }
        $user_id = $this->select("user", 'id', "username = '" . $dataArray['customer_primary_email_id'] . "'")[0]['id'];
        $dataArray['user_id'] = $user_id;
      } elseif ($tableName == 'employee') {
        $sql = "INSERT INTO user (username,password,user_type,is_active) VALUES ('" . $dataArray['employee_email_id'] . "','" . md5($dataArray['employee_mobile_no1']) . "','" . $dataArray['user_type'] . "',1);";
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
          return false;
        }
        $user_id = $this->select("user", 'id', "username = '" . $dataArray['employee_email_id'] . "'")[0]['id'];
        if ($dataArray['user_type'] != 'SuperAdmin')
          unset($dataArray['user_type']);
        $dataArray['user_id'] = $user_id;
      }

      $sql = "INSERT INTO $tableName (" . implode(",", array_keys($dataArray)) . ") VALUES ('" . implode("', '", array_values($dataArray)) . "');";
    } elseif ($tableName == 'action_history') {
      $case_register_id = $data['case_register_id'];
      unset($data['case_register_id']);

      $sql = "INSERT INTO $tableName (case_register_id," . implode(",", array_keys($data)) . ") VALUES ($case_register_id,'" . implode("', '", array_values($data)) . "');";
    }

    $result = mysqli_query($this->conn, $sql);

    if ($result) {
      if (isset($actionHistoryDataArray) && !empty($actionHistoryDataArray)) {
        $inwardId = $this->select($tableName, "id", "", "", "", 1)[0]['id'];
        if (isset($actionHistoryDataArray["deliver_through_courier"]) && $actionHistoryDataArray["deliver_through_courier"] == "on") {
          $action_description = "Media Inward Courier Doc.#:" . $actionHistoryDataArray["courier_name"] . " || " . $actionHistoryDataArray["courier_dock_number"];
        } else {
          $action_description = "Media Inward Hand Delivery to the bearer of Inward Sheet";
        }

        $add_action_history_sql = "INSERT INTO `action_history` (case_register_id, action_title, action_description, visibility_type) VALUES ($inwardId,'Media Inward','$action_description','PRIVATE');";
        mysqli_query($this->conn, $add_action_history_sql);
      }

      if ($tableName == 'case_register') {
        $modelArray = $this->select($tableName, '*', '', '', '', 1)[0];
        $customer = $this->select('customer', '*', "id = " . $valueArray[0] ?? 0)[0];
        $modelArray = array_merge($customer, $modelArray);

        if (!empty($modelArray['device_maker_id'])) {
          $manufacturer = $this->select('device_manufacturer', 'manufacturer_name', 'id = ' . $modelArray['device_maker_id'] ?? 0, '', '', 1)[0];
          $modelArray = array_merge($manufacturer, $modelArray);
        }
        $this->sendMail($customer['customer_primary_email_id'], "Media Details for #" . $modelArray['id'], 'register/inward_email.php', $modelArray);

        $this->generateWhatsappMessage($modelArray, 'Create Inward');
      }
      $_SESSION['success_message'] = $title . ' created successfully';

      return true;
    } else {
      return false;
    }
  }

  function update($tableName, $datas, $title = '')
  {
    $update = $where = $action_description = $action_title = '';
    $columnArray = $valueArray = $dataArray = [];
    foreach ($datas as $key => $data) {
      if ($key == 'formData') {
        $columnArray = array_column($data, 'name');
        $valueArray = array_column($data, 'value');
      } else {
        $columnArray[] = $key;
        $valueArray[] = $data;
      }
    }

    if (!empty($columnArray)) {
      foreach ($columnArray as $key => $column) {
        $dataArray[$column] = $valueArray[$key];
      }
    }

    if (isset($dataArray['event_name'])) {
      if ($dataArray['event_name'] == 'send_estimate') {
        if (isset($dataArray['send_email'])) {
          $update = '  case_status=2, ';
        } elseif (isset($dataArray['case_status']) && $dataArray['case_status'] != 0) {
          $update = '  case_status=3, ';
        }
        $update .= ' estimate_amount="' . $dataArray['estimate_amount'] . '", customer_remarks="' . $dataArray['customer_remarks'] . '", estimate_approved_by_customer="' . $dataArray['customer_estimate_status'] . '" WHERE id=' . $dataArray['inward_register_id'];

        if ($dataArray['customer_estimate_status'] == '0') {
          $action_title = 'Media Estimation';
          $action_description = 'Media estimation email sent to customer';
        } elseif ($dataArray['customer_estimate_status'] == '1') {
          $action_title = 'Estimation Approved';
          $action_description = 'Media estimation charges approved by client';
        } elseif ($dataArray['customer_estimate_status'] == '2') {
          $action_title = 'Estimation Reject';
          $action_description = 'Media estimation charges rejected by client';
        }
        self::insert("action_history", ["case_register_id" => $dataArray["inward_register_id"], "action_title" => $action_title, "action_description" => $action_description, "visibility_type" => "PRIVATE"], "");
      } else if ($dataArray['event_name'] == 'move_to_outward') {
        $update = ' case_status=4, case_register_state=2, outward_remarks="' . $dataArray['outward_remarks'] . '" WHERE id=' . $dataArray['inward_register_id'];

        if (isset($dataArray['deliver_through_courier'])) {
          $action_description = "Media Outward Courier Doc.#:" . $dataArray['courier_dock_number'] . " || " . $dataArray['courier_name'];
        } else {
          $action_description = "Media Outward Hand Delivery to the bearer of Inward Sheet";
        }

        self::insert("action_history", ["case_register_id" => $dataArray["inward_register_id"], "action_title" => "Media Outward", "action_description" => $action_description, "visibility_type" => "PRIVATE"], "");
      } else if ($dataArray["event_name"] == "add_storage_detail") {
        $register_id = 0;
        unset($dataArray['type']);
        unset($dataArray['inward_register_id_storage']);
        unset($dataArray['event_name']);
        foreach ($dataArray as $column => $data) {
          if ($column == 'inward_register_id') {
            $register_id = $data;
            $where = " WHERE id = " . $data;
          } else {
            if ($column == 'case_result' && $data == 'on') {
              $data = 1;
            } else {
              $data = '"' . $data . '"';
            }
            $update .= ((empty($update)) ? ' ' . $column . '= ' . $data : ',' . $column . '= ' . $data);
          }
        }
        if ($register_id != 0) {
          self::insert('action_history', ['case_register_id' => $register_id, 'action_title' => 'storage_detail', 'action_description' => 'Recovered data storage details HDD#' . $dataArray['sd_hddno'] . ' || storage size : ' . $dataArray['sd_size'] . ' || Note : ' . $dataArray['sd_remarks'], 'visibility_type' => 'PRIVATE'], '');
        }

        if (!isset($dataArray['case_result'])) {
          $update .= ' ,case_result = 0';
        }
        $update .= $where;
      } else if ($dataArray["event_name"] == "send_data_tree" && isset($dataArray['case_result'])) {
        $update = ' case_result=1 where id =' . $dataArray['inward_register_id'];
        if (isset($dataArray['send_email'])) {
          $action_description = "Data recovery file tree has been sent.";
        } else {
          $action_description = "Register status updated successfully.";
        }
        self::insert('action_history', ['case_register_id' => $dataArray['inward_register_id'], 'action_title' => 'Data Tree', 'action_description' => $action_description, 'visibility_type' => 'PRIVATE'], '');
      }
    } else {
      foreach ($dataArray as $column => $data) {
        if (!isset($dataArray['password'])) {
          if ($column != 'case_status' || $column != 'estimate_approved_by_customer') {
            if ($tableName == 'customer' && ($column == 'user_id' || $column == 'customer_city_location')) {
            } else {
              $data = '"' . $data . '"';
            }
            $update .= (empty($update)) ? ' ' . $column . '=' . $data . ' ' : ',' . $column . '=' . $data . ' ';
          }
        } else {
          $query = " $column = '" . $data . "' ";
          $update .= (empty($update) ? $query : " ,$query");
        }
      }
      $update .= " WHERE id = " . $dataArray['id'];
    }
    if (!empty($update)) {
      $sql = "UPDATE $tableName SET $update";
      $result = mysqli_query($this->conn, $sql);
    } else {
      $result = 1;
    }
    if ($result) {
      $_SESSION['success_message'] = $title . ' successfully';
      if (isset($dataArray['event_name']) && ($dataArray['event_name'] == 'move_to_outward' || ($dataArray['event_name'] == 'send_estimate'  && isset($dataArray['send_email'])) || ($dataArray['event_name'] == 'send_data_tree' && isset($dataArray['send_email'])))) {
        $inward_device = $this->select($tableName, '*', 'id=' . $dataArray["inward_register_id"], '', '', 1)[0];
        $customer = $this->select('customer', '*', "id = " . $inward_device['customer_id'] ?? 0)[0];
        $modelArray = array_merge($customer, $inward_device);

        if (!empty($modelArray['device_maker_id'])) {
          $manufacturer = $this->select('device_manufacturer', 'manufacturer_name', 'id = ' . $modelArray['device_maker_id'] ?? 0, '', '', 1)[0];
          $modelArray = array_merge($manufacturer, $modelArray);
        }
        if ($dataArray['event_name'] == 'move_to_outward') {
          if (isset($dataArray['deliver_through_courier']))
            $modelArray['deliver_through_courier'] = $dataArray['deliver_through_courier'];
          $modelArray['courier_name'] = (isset($dataArray['courier_name'])) ? $dataArray['courier_name'] : '';
          $modelArray['courier_dock_number'] = (isset($dataArray['courier_dock_number'])) ? $dataArray['courier_dock_number'] : '';

          $this->sendMail($customer['customer_primary_email_id'], "Media Details for #" . $modelArray['id'], 'register/outward_email.php', $modelArray);

          $this->generateWhatsappMessage($modelArray, 'Move to Outward');
        } elseif ($dataArray['event_name'] == 'send_estimate') {
          if (isset($dataArray['send_email'])) {
            $this->sendMail($customer['customer_primary_email_id'], "Device Data Recovery Estimate (Inward# {$modelArray['id']}) - Ni-Ki Data Recovery Services", 'email/send_estimation.php', $modelArray);

            $this->generateWhatsappMessage($modelArray, 'Send Estimation');
          }
        } elseif ($dataArray['event_name'] == 'send_data_tree') {
          $this->sendMail($customer['customer_primary_email_id'], "Device Data Recovery Tree Structure (Inward #{$modelArray['id']}) - Ni-Ki Data Recovery Services", 'email/send_data_tree_structure.php', $modelArray, '', true, $_FILES['dataTreeFile']['tmp_name'], $_FILES['dataTreeFile']['name']);

          $this->generateWhatsappMessage($modelArray, 'Data Tree Structure');
        }
      }

      return $result;
    } else {
      return false;
    }
  }

  function delete($tableName, $data, $title = '')
  {
    if ($tableName == 'customer' || $tableName == 'employee') {
      $sql = "DELETE FROM user WHERE username = '" . $data['primary_email_id'] . "' AND user_type='Customer'";
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
    $sql = "SELECT id,user_type,is_active FROM user Where";
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
      
      if ($data[0]['is_active']) {
        if ($data[0]['user_type'] == 'Employee') {
          $user = "SELECT employee_name as user_name,employee_city_location as city FROM employee Where user_id= '" . $data[0]['id'] . "'";
        } elseif ($data[0]['user_type'] == 'Customer') {
          $user = "SELECT company_name as user_name,customer_city_location as city FROM customer Where user_id= '" . $data[0]['id'] . "'";
        }

        if (isset($user)) {
          $userResult = mysqli_query($this->conn, $user);
          $userData = mysqli_fetch_assoc($userResult);
          $_SESSION['user_name'] = $userData['user_name'];
          $_SESSION['user_city'] = $userData['city'];
        }

        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['success_message'] = 'Login successfully';
        $_SESSION['user_id'] = $data[0]['id'];
        $_SESSION['user_type'] = $data[0]['user_type'];
        return true;
      } else {
        $_SESSION['error_message'] = 'Please contact admin to UnBlock your user!!';
        return ['success' => 'false'];
      }
    } else {
      return ['success' => 'false'];
    }
  }

  function change_password($data)
  {
    $user = $this->select('user', '*', ' id=' . $data['id'])[0];
    if ($user['password'] == md5($data['current_password'])) {
      $this->update('user', ['id' => $data['id'], 'password' => md5($data['new_password'])], 'Password changed');
      return ['success' => true, 'reset_type' => $data['reset_type']];
    } else {
      return ['success' => false, 'message' => 'Current password is incorrect'];
    }
  }

  function sendMail($to, $subject, $view, $modelArray, $redirect = '', $html = true, $attachmentTempName = "", $attachmentName = "")
  {
    require_once "../../vendor/autoload.php";

    // $MAIL_HOST = "mail.recoveryourdata.co.in";
    // $MAIL_PORT = "587";
    // $SENDER_USERNAME = "authorise@recoveryourdata.co.in";
    // $SENDER_PWD = "Girirajbawa@nathdwara*";
    $MAIL_HOST = "sandbox.smtp.mailtrap.io";
    $MAIL_PORT = "587";
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
    if (!empty($attachmentTempName)) {
      $mail->AddAttachment($attachmentTempName, $attachmentName);
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

  public function sendWhatsAppMessage($data, $bodyVariableArray)
  {
    $curl = curl_init();
    /*  "headerValues": [
      "https://interaktprodstorage.blob.core.windows.net/mediaprodstoragecontainer/acfcda27-3c33-45d3-8726-f6c5435828c0/message_template_media/ltdFpVSxLWQG/logo-no_background-high-21-removebg-preview%20%282%29.png?se=2028-12-06T09%3A19%3A52Z&sp=rt&sv=2019-12-12&sr=b&sig=JjKlzPAbzoxwo/dgIC3jMvV%2BLdxE7h/xHLM%2By0ZpEwo%3D"
    ], */

    $bodyValues = $header = '';
    foreach ($bodyVariableArray as $variableValue) {
      $bodyValues .= (empty($bodyValues)) ? '"' . $variableValue . '"' : ',"' . $variableValue . '"';
    }
    if (isset($data['header_1']) && $data['header_1'] != '') {
      $header = '"headerValues": [ "' . $data['header_1'] . '" ],';
    }
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.interakt.ai/v1/public/message/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
                "countryCode": "+91",
                "phoneNumber": "' . $data['customer_mobile_no'] . '",
                "callbackData": "",
                "type": "Template",
                "template": {
                    "name": "' . $data['template_name'] . '",
                    "languageCode": "en",
                    ' . $header . '
                    "bodyValues": [
                        ' . $bodyValues . '
                        ]
                    }
                }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ' . $this->API_KEY,
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }

  public function generateWhatsappMessage($modelArray, $template_name)
  {
    $template_slug = $this->select('templates', 'template_name_slug', ' template_name="' . $template_name . '"')[0]['template_name_slug'];

    if (empty($template_slug)) {
      $_SESSION['error_message'] = 'Whatsapp API template value cannot be empty.';
      return false;
    } elseif (empty($modelArray['customer_mobile_no1'])) {
      $_SESSION['error_message'] = 'Client Primary Mobile No. cannot be empty.';
      return false;
    } elseif (strlen($modelArray['customer_mobile_no1']) != 10) {
      $_SESSION['error_message'] = 'Client Primary Mobile No. should be 10 digit number only, Invalid mobile number entered.';
      return false;
    }

    $params = $bodyVariableArray = [];

    $params['customer_mobile_no'] = $modelArray['customer_mobile_no1'];
    $params['template_name'] = $template_slug;
    $params['header_1'] = (isset($modelArray['id']) && !empty($modelArray['id'])) ? $modelArray['id'] : 'N/A';

    $bodyVariableArray['1'] = (isset($modelArray['customer_name']) && !empty($modelArray['customer_name'])) ? $modelArray['customer_name'] : 'N/A';
    $bodyVariableArray['2'] = (isset($modelArray['device_serial_number']) && !empty($modelArray['device_serial_number'])) ? $modelArray['device_serial_number'] : 'N/A';
    $bodyVariableArray['3'] = (isset($modelArray['manufacturer_name']) && !empty($modelArray['manufacturer_name'])) ? $modelArray['manufacturer_name'] : 'N/A';
    $bodyVariableArray['4'] = (isset($modelArray['device_model']) && !empty($modelArray['device_model'])) ? $modelArray['device_model'] : 'N/A';
    $bodyVariableArray['5'] = (isset($modelArray['device_type']) && !empty($modelArray['device_type'])) ? $modelArray['device_type'] : 'N/A';
    $bodyVariableArray['6'] = (isset($modelArray['device_size']) && !empty($modelArray['device_size']) && !in_array($modelArray['device_size'], ['TB', 'GB', 'MB'])) ? $modelArray['device_size'] : 'N/A';
    $bodyVariableArray['7'] = (isset($modelArray['crash_type']) && !empty($modelArray['crash_type'])) ? $modelArray['crash_type'] : 'N/A';
    $bodyVariableArray['8'] = (isset($modelArray['case_received_date']) && !empty($modelArray['case_received_date']) && $modelArray['case_received_date'] != '0000-00-00 00:00:00') ? date('d M, Y h:m a', strtotime($modelArray['case_received_date'])) : 'N/A';

    if ($template_name == 'Move to Outward') {
      $bodyVariableArray['9'] = (isset($modelArray['deliver_through_courier'])) ? $bodyVariableArray['8'] : 'N/A';
      $bodyVariableArray['10'] = (isset($modelArray['deliver_through_courier']) && !empty($modelArray['courier_name'])) ? $modelArray['courier_name'] : 'N/A';
      $bodyVariableArray['11'] = (isset($modelArray['deliver_through_courier']) && !empty($modelArray['courier_dock_number'])) ? $modelArray['courier_dock_number'] : 'N/A';
      $bodyVariableArray['12'] = (isset($modelArray['deliver_through_courier'])) ? 'Yes' : 'No';
      $bodyVariableArray['13'] = (isset($modelArray['outward_remarks']) && !empty($modelArray['outward_remarks'])) ? $modelArray['outward_remarks'] : 'N/A';
    } elseif ($template_name == 'Send Estimation') {
      $bodyVariableArray['9'] = (isset($modelArray['estimate_amount']) && !empty($modelArray['estimate_amount'])) ? $modelArray['estimate_amount'] : 'N/A';
      $bodyVariableArray['10'] = (isset($modelArray['customer_remarks']) && !empty($modelArray['customer_remarks'])) ? $modelArray['customer_remarks'] : 'N/A';
    }

    $api_response = json_decode($this->sendWhatsAppMessage($params, $bodyVariableArray));

    if (isset($api_response->result) && $api_response->result == false) {
      $_SESSION['error_message'] = 'Whatsapp message not send, ' . $api_response->message;
    }
    return $api_response;
  }
}
