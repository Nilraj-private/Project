<?php

session_start();

if (isset($is_login_page) && $is_login_page == 1) {
  if (isset($_SESSION['user_id'])) {
    header("Location: " . $_SESSION['url_path'] . "/app/views/dashboard.php");
  }
} else {
  if (!isset($_SESSION['user_id'])) {
    header("Location: " . $_SESSION['url_path'] . "/app/views/auth/login.php");
  }
}

$_SESSION['url_path'] = 'https://recoveryourdata.co.in/module1';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ni-Ki Data Recovery Services</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- DataTables -->

  <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css?v=1.0.1" />

  <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/css/main.css">
  <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/plugins/toastr/toastr.min.css">
  <script src="https://kit.fontawesome.com/016e38d5fa.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  
</head>