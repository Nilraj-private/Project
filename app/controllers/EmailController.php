<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["event_name"]) && $_POST["event_name"] == 'send_estimate') {
        if (isset($_POST['send_email'])) {
            $customer = $model->select('customer', '*', ' id=' . $_POST['customer_id'])[0];
            $inward = $model->select('case_register', '*', ' id=' . $_POST['inward_register_id'])[0];
            $modelArray = array_merge($inward,$customer);
            $model->sendMail($customer['customer_primary_email_id'], "Device Data Recovery Estimate (Inward# {$inward['id']}) - Ni-Ki Data Recovery Services",'email/send_estimation.php', $modelArray, true);
            return;
        } else {
            $model->update('case_register', $_POST, 'Inward Register');
            header("Location: ../views/register/register.php?type=" . $_POST['type']);
        }
    }
}