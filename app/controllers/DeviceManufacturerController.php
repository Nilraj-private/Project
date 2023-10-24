<?php

require "../models/model.php";

use app\models\Model;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && $_POST["id"] > 0) {
        return (new Model())->update('device_manufacturer', $_POST);
    } else if (isset($_POST["delete_id"])) {
        return (new Model())->delete('device_manufacturer', $_POST['delete_id']);
    } else {
        return (new Model())->insert('device_manufacturer', $_POST['formData']);
    }
}
