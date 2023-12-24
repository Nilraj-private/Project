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
            return $model->update('case_register', array_merge($_POST, $_FILES), 'Data Tree send');
        } else if (isset($_POST['case_result'])) {
            return $model->update('case_register', $_POST, ucfirst($_POST['type']) . ' updated');
        }
    }
}
