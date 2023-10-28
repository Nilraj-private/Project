<?php

require "../models/model.php";

use app\models\Model;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
}

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["index"]) && $_POST["index"] == true) {
        return $model->select('case_register', '*', '', '', $_POST);
    } else if (isset($_POST["id"]) && $_POST["id"] > 0) {
        return $model->update('case_register', $_POST, $_POST['type']);
    } else if (isset($_POST["delete_id"])) {
        return $model->delete('case_register', $_POST['delete_id']);
    } else {
        return $model->insert('case_register', $_POST['formData']);
    }
}
