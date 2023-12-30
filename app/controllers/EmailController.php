<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["event_name"]) && $_POST["event_name"] == 'send_estimate') {
        return $model->update('case_register', $_POST, 'Inward updated');
    } else if (isset($_POST["event_name"]) && $_POST["event_name"] == 'move_to_outward') {
        return $model->update('case_register', $_POST, 'Device moved to outward');
    } else if (isset($_POST["event_name"]) && $_POST["event_name"] == 'send_data_tree') {
        if (isset($_POST['send_email'])) {
            $target_dir = $_SESSION['url_path'] . "/public/uploads/";
            // $target_dir = 'C:/xampp/htdocs' . $_SESSION['url_path'] . "/public/uploads/";
            $target_file = $target_dir . date('YmdHms') . basename($_FILES["dataTreeFile"]["name"]);

            if (move_uploaded_file($_FILES["dataTreeFile"]["tmp_name"], $target_file)) {
                $_POST['target_file'] = $target_file;
                $_POST['file_name'] = date('YmdHms') . basename($_FILES["dataTreeFile"]["name"]);
                $_SESSION['success_message'] = "The file " . htmlspecialchars(basename($_FILES["dataTreeFile"]["name"])) . " has been uploaded.";
                return $model->update('case_register', array_merge($_POST, $_FILES), 'Data Tree send');
            } else {
                $_SESSION['error_message'] = "Sorry, there was an error uploading your file.";
            }
        } else if (isset($_POST['case_result'])) {
            return $model->update('case_register', $_POST, ucfirst($_POST['type']) . ' updated');
        }
    }
}
