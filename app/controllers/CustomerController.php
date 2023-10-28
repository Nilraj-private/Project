<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && $_POST["id"] > 0) {
        return $model->update('customer', $_POST, 'Customer');
    } else if (isset($_POST["delete_id"])) {
        return $model->delete('customer', $_POST['delete_id'], 'Customer');
    } else {
        return $model->insert('customer', $_POST['formData'], 'Customer');
    }
}
