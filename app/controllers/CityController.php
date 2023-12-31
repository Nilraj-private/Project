<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && $_POST["id"] > 0) {
        return $model->update('city_location', $_POST, 'City updated');
    } else if (isset($_POST["delete_id"])) {
        return $model->delete('city_location', $_POST, 'City');
    } else {
        return $model->insert('city_location', $_POST['formData'], 'City');
    }
}
