<?php

require "../models/model.php";

use app\models\Model;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["index"]) && $_POST["index"] == true) {
        return (new Model())->select('case_register', '*', '', '', $_POST);
    } else if (isset($_POST["id"]) && $_POST["id"] > 0) {
        return (new Model())->update('case_register', $_POST);
    } else if (isset($_POST["delete_id"])) {
        return (new Model())->delete('case_register', $_POST['delete_id']);
    } else {
        return (new Model())->insert('case_register', $_POST['formData']);
    }
}
