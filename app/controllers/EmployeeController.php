<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && $_POST["id"] > 0) {
        echo $model->update('employee', $_POST, 'Employee updated');
    } else if (isset($_POST["delete_id"])) {
        return $model->delete('employee', $_POST);
    } else if (isset($_POST["event_name"])) {
        return $model->update('user', $_POST);
    } else {
        if (isset($_POST['formData']) && isset($_POST['formData'][4]['value'])) {
            $employee = $model->select('employee', 'employee_email_id,employee_mobile_no1', ' employee_email_id="' . $_POST['formData'][1]['value'] . '" and employee_mobile_no1="' . $_POST['formData'][2]['value'] . '"');
            if (empty($employee)) {
                $model->insert('employee', $_POST['formData']);
                echo json_encode(['success' => true]);
            } else {
                $_SESSION['error_message'] = 'User with same email and mobile no. already exist!!';
                echo json_encode(['success' => false]);
            }
        }
    }
}
