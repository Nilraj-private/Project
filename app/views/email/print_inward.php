<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= $_SESSION['url_path'] ?>/public/css/adminlte.min.css">

    <title>Inward Receipt</title>
</head>

<body class="skin-blue"><!-- Main content -->
    <section class="content invoice <?=  $user->role ? 'admin-print' : ''; ?>">
        <!-- title row -->
        <div class="row no-print">
            <div class="col-xs-12">
                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
        <div class="row <?php echo (Yii::app()->user->role !== User::CUSTOMER) ? 'hidden no-print' : ''; ?>">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="<?php echo IMAGES_DIR; ?>logo-real.png" alt="<?php echo Yii::app()->params['companyName']; ?>">
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
                    <strong><?php echo $model->Rel_Customer->company_name; ?></strong><br>
                    <?php echo $model->Rel_Customer->customer_name; ?><br>
                    Contact: <?php echo $model->Rel_Customer->customer_mobile_no1; ?><br />
                    Email: <?php echo $model->Rel_Customer->customer_primary_email_id; ?>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <strong>Address :</strong>
                <address>
                    <?php echo ($model->Rel_Customer->office_addressline) ? $model->Rel_Customer->office_addressline : 'N/A'; ?>

                </address>
                <strong>City :</strong>
                <address>
                    <?php echo ($model->Rel_Customer->Rel_City) ? $model->Rel_Customer->Rel_City->city_name : 'N/A'; ?>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Inward: #<?php echo $model->id; ?></b><br />
                <?php if (!empty($model->case_received_date)) ?>
                <b>Received Date:</b><?php echo $this->getFormattedDateTime($model->case_received_date); ?>

                <br><b>Submit Date :</b> <?php echo $this->getFormattedDate($model->case_created_date); ?>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <p class="lead">Inward Details <strong>(Serial No. :<?php echo ($model->device_serial_number) ? $model->device_serial_number : 'N/A'; ?>)</strong></p>
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

                            <td><?php echo isset($model->Rel_DeviceMfg) ? $model->Rel_DeviceMfg->manufacturer_name : 'N/A'; ?></td>
                            <td><?php echo ($model->device_model) ? $model->device_model : 'N/A'; ?></td>
                            <td><?php echo ($model->device_type) ? $model->device_type : 'N/A'; ?></td>
                            <td><?php echo ($model->device_size) ? $model->device_size : 'N/A'; ?></td>
                            <td><?php echo ($model->crash_type) ? $model->crash_type : 'N/A'; ?></td>
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
                    <?php echo $model->files_to_recover; ?>
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
                <p class="lead"><strong>NEED HELP? Call Our Support Team 24/7 @ +91-9825005686</strong></p>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</body>

</html>