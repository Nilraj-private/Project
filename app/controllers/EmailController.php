<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "../../vendor/autoload.php";
require "../models/model.php";

use app\models\Model;

$_SESSION['smtp_from_email'] = 'recovery@gmail.com';
$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["event_name"]) && $_POST["event_name"] == 'send_estimate') {
        if (isset($_POST['send_email'])) {
            sendEmail($_POST['customer_id']);
            header("Location: ../views/register/register.php?type=" . $_POST['type']);
        } else {
            $model->update('case_register', $_POST, 'Inward Register');
            header("Location: ../views/register/register.php?type=" . $_POST['type']);
        }
        //     } else if (isset($_POST["delete_id"])) {
        //         return $model->delete('city_location', $_POST['delete_id'], 'City');
        //     } else {
        //         return $model->insert('city_location', $_POST['formData'], 'City');
    }
}

function sendEmail($customer_id)
{
    $model = new Model();
    $customer = $model->select('customer', '*', ' id=' . $customer_id)[0];

    $mail = new PHPMailer;
    $mail->SMTPDebug = 3;
    $mail->isSMTP();
    $mail->Host = "sandbox.smtp.mailtrap.io";
    $mail->SMTPAuth = true;
    $mail->Username = "9f51d16c8abf51";
    $mail->Password = "75c10c91473816";
    $mail->Port = 2525;

    $mail->From = $_SESSION['smtp_from_email'];
    $mail->FromName = "Full Name";
    $mail->addAddress($customer['customer_primary_email_id'], $customer['customer_name']);
    $mail->isHTML(true);
    $mail->Subject = "Inward Estimation Confirmation";
    $mail->Body = "Here is the details and bill amount for your data recovery.";
    // $mail->AltBody = "This is the plain text version of the email content";
    if (!$mail->send()) {
        $_SESSION['error_message'] = "Mailer Error: " . $mail->ErrorInfo;
    } else {
        $_SESSION['success_message'] = 'Estimation mail send successfully';
    }
    return;
}
