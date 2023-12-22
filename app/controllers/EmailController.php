<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["event_name"]) && $_POST["event_name"] == 'send_estimate') {
        return $model->update('case_register', $_POST, 'Inward updated');
    } else if (isset($_POST["event_name"]) && $_POST["event_name"] == 'move_to_outward') {
        return $model->update('case_register', $_POST, 'Device moved to outward');
    }
}
