<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["event_name"]) && $_POST["event_name"] == 'send_message') {
        // $model->sendWhatsAppMessage();
    }
}
