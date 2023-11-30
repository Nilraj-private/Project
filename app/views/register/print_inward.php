<?php

// include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

$model = (new Model());

$customer = $model->select('customer', 'company_name,customer_name,customer_mobile_no1,customer_primary_email_id,office_addressline', ' id=' . $_GET['customer_id'])[0];
$city_location = $model->select('city_location', 'city_name', ' id=' . $_GET['city_id'])[0];
$join = ' LEFT JOIN device_manufacturer as dm on dm.id=cr.device_maker_id ';
$inward = $model->select('case_register as cr', 'cr.*,dm.manufacturer_name', ' cr.id=' . $_GET['id'], $join)[0];

$modelArray = array_merge($inward, $city_location);
$modelArray = array_merge($modelArray, $customer);

$_SESSION['user_type'] = 'admin';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?= $_SESSION['url_path'] ?>/public/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= $_SESSION['url_path'] ?>/public/css/AdminLTE.css" />
    <title>Inward Receipt</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="container-fluid">
            <!-- Main content -->
            <section style="padding-top: 120px;padding-right: 150px;padding-left: 50px;">
                <div class="row no-print">
                    <div class="col-xs-12">
                        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
                <div class="row <?php echo ($_SESSION['user_type'] !== "Customer") ? 'hidden no-print' : ''; ?>">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <img src="<?php echo $_SESSION["url_path"]; ?>/public/images/logo2.jpg" alt="<?php echo $modelArray['company_name']; ?>">
                            <small class="pull-right">
                                <address>
                                    <strong>H.O. & Admin :</strong><br>
                                    G/18, Shree Ramway Plaza,<br>
                                    Kharivav Road, Dandia Bazar, Vadodara<br>
                                    Phone: +91- 0265-2458883<br />
                                    Mobile: +91- 9825705686 / 9898666379<br>
                                    Email: info@recoveryourdata.co.in
                                </address>
                            </small>
                        </h2>
                    </div><!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <strong>Customer Details :</strong>
                        <address>
                            <strong><?php echo $modelArray['company_name']; ?></strong><br>
                            <?php echo $modelArray['customer_name']; ?><br>
                            Contact: <?php echo $modelArray['customer_mobile_no1']; ?><br />
                            Email: <?php echo $modelArray['customer_primary_email_id']; ?>
                        </address>
                    </div><!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <strong>Address :</strong>
                        <address>
                            <?php echo ($modelArray['office_addressline']) ? $modelArray['office_addressline'] : 'N/A'; ?>

                        </address>
                        <strong>City :</strong>
                        <address>
                            <?php echo ($modelArray['city_name']) ? $modelArray['city_name'] : 'N/A'; ?>
                        </address>
                    </div><!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Inward: #<?php echo $modelArray['id']; ?></b><br />
                        <?php if (!empty($modelArray['case_received_date'])) ?>
                        <b>Received Date:</b>
                        <?= date('d M, Y h:m a', strtotime(($modelArray['case_received_date'] != '0000-00-00 00:00:00' ? $modelArray['case_received_date'] : ''))) ?>
                        <br><b>Submit Date :</b>
                        <?= date('d M, Y h:m a', strtotime(($modelArray['case_created_date'] != '0000-00-00 00:00:00' ? $modelArray['case_created_date'] : ''))) ?>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 ">
                        <table class="table table-responsive" style="margin-bottom: 0px;">
                            <tbody>
                                <tr>
                                    <h3>Inward Details <strong>(Serial No. :<?php echo ($modelArray['device_serial_number']) ? $modelArray['device_serial_number'] : 'N/A'; ?>)</strong></h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Device Manufacturer</th>
                                                <th>Device Model</th>
                                                <th>Device Type</th>
                                                <th>Device Size</th>
                                                <th>Type of Crash</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo isset($modelArray['manufacturer_name']) ? $modelArray['manufacturer_name'] : 'N/A'; ?></td>
                                                <td><?php echo ($modelArray['device_model']) ? $modelArray['device_model'] : 'N/A'; ?></td>
                                                <td><?php echo ($modelArray['device_type']) ? $modelArray['device_type'] : 'N/A'; ?></td>
                                                <td><?php echo ($modelArray['device_size']) ? $modelArray['device_size'] : 'N/A'; ?></td>
                                                <td><?php echo ($modelArray['crash_type']) ? $modelArray['crash_type'] : 'N/A'; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-12">
                        <p class="lead">Files and directories to be recovered</p>
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <?php echo $modelArray['files_to_recover']; ?>
                        </p>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-12">
                        <p class="lead">Note :</p>
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Please bring this information sheet at the time of collection of inward material.<br>
                            For security reasons, strictly no delivery shall be made without this sheet.
                        </p>
                    </div><!-- /.col -->
                    <div class="col-xs-12">
                        <p class="lead"><b>NEED HELP? Call Our Support Team 24/7 @ +91-9825005686</b></p>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
        </div>
    </div>
</body>

</html>