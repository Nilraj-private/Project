<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["index"]) && $_POST["index"] == true) {
        return $model->select('case_register', '*', '', '', $_POST);
    } else if (isset($_POST["event_name"]) && $_POST["event_name"] == 'moveToOwtward') {
        return $model->update('case_register', $_POST, 'Inward changed');
    } else if (isset($_POST["id"]) && $_POST["id"] > 0) {
        return $model->update('case_register', $_POST, 'Inward Register');
        // } else if (isset($_POST["delete_id"])) {
        //     return $model->delete('case_register', $_POST['delete_id'], 'Inward Register');
    } else {
        return $model->insert('case_register', $_POST['formData'], 'Inward Register');
    }
}
