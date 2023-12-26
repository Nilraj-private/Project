<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {
    if (isset($_POST['term']['term']) && !empty($_POST['term']['term'])) {
        $customers = $model->select('customer', 'id,company_name,customer_name,customer_primary_email_id,customer_mobile_no1', ' company_name like "%' . $_POST['term']['term'] . '%"', '', [], 10);
        echo json_encode($customers);
    } elseif (isset($_POST["id"]) && $_POST["id"] > 0) {
        return $model->update('customer', $_POST, 'Customer updated');
    } else if (isset($_POST["delete_id"])) {
        return $model->delete('customer', $_POST, 'Customer');
    } else {
        $model->insert('customer', $_POST['formData'], 'Customer');
        $user['formData'][0]['name'] = 'username';
        $user['formData'][0]['value'] = '';
        $user['formData'][1]['name'] = 'password';
        $user['formData'][1]['value'] = '';
        $user['formData'][2]['name'] = 'user_type';
        $user['formData'][2]['value'] = '';
        return $model->insert('user', $user['formData'], 'Customer');
    }
    // }else{
    //     $_SESSION['error_message'] = 'Please contact admin to UnBlock your user!!';
    // }
}
