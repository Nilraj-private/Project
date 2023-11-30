<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["event_name"]) && $_POST["event_name"] == 'add_action_history') {
        return $model->insert('action_history', $_POST['formData'], 'Action history added');
    } else if (isset($_POST["event_name"]) && $_POST["event_name"] == 'add_storage_detail') {
        return $model->update('case_register', $_POST, 'Storage detail added');
    } else if (isset($_POST["index"]) && $_POST["index"] == true) {
        return $model->select('case_register', '*', '', '', $_POST);
    } else if (isset($_POST["event_name"]) && $_POST["event_name"] == 'moveToOwtward') {
        return $model->update('case_register', $_POST, 'Inward updated');
    } else if (isset($_POST["id"]) && $_POST["id"] > 0) {
        return $model->update('case_register', $_POST, 'Inward updated');
    } else if (isset($_POST["delete_id"])) {
        return $model->delete($_POST['table_name'], $_POST, 'Action history ');
    } else {
        return $model->insert('case_register', $_POST['formData'], 'Inward');
    }
}
