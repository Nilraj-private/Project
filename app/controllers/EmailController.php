<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["event_name"]) && $_POST["event_name"] == 'send_estimate') {
        if (isset($_POST['send_email'])) {
            $customer = $model->select('customer', 'customer_primary_email_id,customer_name', ' id=' . $_POST['customer_id'])[0];

            $model->update('case_register', $_POST);

            $inward = $model->select('case_register', 'id,device_serial_number,device_internal_serial_number,device_model,device_type,device_size,crash_type,customer_remarks,estimate_amount,case_received_date,device_maker_id', ' id=' . $_POST['inward_register_id'])[0];
            
            $modelArray = array_merge($inward,$customer);
            
            $manufacturer = $model->select('device_manufacturer', 'manufacturer_name', ' id=' . $inward['device_maker_id'])[0];

            $modelArray = array_merge($manufacturer,$modelArray);
            
            $model->sendMail($customer['customer_primary_email_id'], "Device Data Recovery Estimate (Inward# {$inward['id']}) - Ni-Ki Data Recovery Services",'email/send_estimation.php', $modelArray, true);
            return;
        } else {
            $model->update('case_register', $_POST, 'Inward updated');
            header("Location: ../views/register/register.php?type=" . $_POST['type']);
        }
    } else if (isset($_POST["event_name"]) && $_POST["event_name"] == 'move_to_owtward') {
        return $model->update('case_register', $_POST, 'Device moved to outward');
    }
}