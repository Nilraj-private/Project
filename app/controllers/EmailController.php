<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "../../vendor/autoload.php";
// require "../models/model.php";

// use app\models\Model;

// $model = (new Model());

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST["id"]) && $_POST["id"] > 0) {
//         return $model->update('city_location', $_POST, 'City');
//     } else if (isset($_POST["delete_id"])) {
//         return $model->delete('city_location', $_POST['delete_id'], 'City');
//     } else {
//         return $model->insert('city_location', $_POST['formData'], 'City');
//     }
// }
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg, 70);

// send email
$mail = new PHPMailer;
//Enable SMTP debugging.
$mail->SMTPDebug = 3;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name                      
$mail->Host = "sandbox.smtp.mailtrap.io";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "9f51d16c8abf51";
$mail->Password = "75c10c91473816";
// $mail->SMTPSecure = "tls";
$mail->Port = 2525;

$mail->From = "nilraj@gmail.com";
$mail->FromName = "Full Name";
$mail->addAddress("nilrajdhummad@gmail.com", "Recepient Name");
$mail->isHTML(true);
$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent successfully";
}

die;
