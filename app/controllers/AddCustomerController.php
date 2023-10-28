<?php

require "../models/model.php";

use app\models\Model;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
}

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && $_POST["id"] > 0) {
        return $model->update('customer', $_POST);
    } else if (isset($_POST["delete_id"])) {
        return $model->delete('customer', $_POST['delete_id']);
    } else {
        return $model->insert('customer', $_POST['formData'], 'Customer');
    }
}
