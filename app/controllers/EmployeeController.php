<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && $_POST["id"] > 0) {
        return $model->update('employee', $_POST, 'Employee updated');
    } else if (isset($_POST["delete_id"])) {
        return $model->delete('employee', $_POST);
    } else {
        return $model->insert('employee', $_POST['formData']);
    }
}
