<?php

require "../models/model.php";

use app\models\Model;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = new Model();
    if (isset($_POST["login_page"])) {
        unset($_POST["login_page"]);
        $result = $model->user_authentication($_POST);
        if ($result['success'] == 'false') {
            header("Location: ../views/auth/login.php");
        }
        header("Location: ../views/dashboard.php");
    } else if (isset($_POST["change_password"])) {
        print_r(json_encode($model->change_password($_POST)));
        return json_encode($model->change_password($_POST));
    }
    //  else if (isset($_POST["auth_type"]) && $_POST["auth_type"] == 'register') {
    //     if (isset($_POST["formData"])) {
    //         $dataArray = json_decode(base64_decode($_POST["formData"]));
    //         $arrayCount = count($dataArray);
    //         $dataArray[$arrayCount + 1]->name = 'user_type';
    //         $dataArray[$arrayCount + 1]->value = 'Employee';
    //         $dataArray[$arrayCount + 2]->name = 'is_active';
    //         $dataArray[$arrayCount + 2]->value = 0;
    //         return $model->insert('case_register', $dataArray);
    //     }
    // }
}
