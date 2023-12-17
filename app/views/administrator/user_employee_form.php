<?php

include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

$_SESSION['page'] = 'user_form.php';

$model = (new Model());
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $employee = $model->select("employee", "*", " id = " . $_GET['id'])[0];
}
$cities = $model->select('city_location');
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('../template/header.php') ?>

        <!-- Main Sidebar Container -->
        <?php include('../template/sidebar.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="date_strip">
                            <h1><?= date('M d, Y') ?></h1>
                            <p><?= date('H:i:s A') ?></p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Content Header (Page header) -->
            <section class="content-header res_mb5 res_pt2">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1> Add New User </h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <form id="employee_form">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="card mb35">
                                    <div class="card-body res_col_form">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Name *</label>
                                                    <input type="text" class="form-control" name="employee_name" id="employee_name" placeholder="User Name *" value="<?= ($employee['employee_name'] ?? '') ?>" required>
                                                    <div id="employee_name_error" style="display:none;">User Name cannot be blank.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Email *</label>
                                                    <input type="email" class="form-control" name="employee_email_id" id="employee_email_id" placeholder="Email *" value="<?= ($employee['employee_email_id'] ?? '') ?>" required>
                                                    <div id="employee_email_id_error" style="display:none;">Email cannot be blank.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Mobile No.*</label>
                                                    <input type="text" class="form-control" name="employee_mobile_no1" id="employee_mobile_no1" placeholder="Mobile No.*" value="<?= ($employee['employee_mobile_no1'] ?? '') ?>" required>
                                                    <div id="employee_mobile_no1_error" style="display:none;">Mobile No. cannot be blank.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <select class="form-control" name="employee_city_location" id="employee_city_location" placeholder="Select Location (City)" required>
                                                        <option value="">Select Location (City)</option>
                                                        <?php foreach ($cities as $city) { ?>
                                                            <option value="<?= $city['id'] ?>" <?= (($employee['employee_city_location'] ?? '') == $city['id'] ? 'selected' : '') ?>><?= $city['city_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div id="employee_city_location_error" style="display:none;">Location cannot be blank.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <select class="form-control" name="user_type" id="user_type" placeholder="Select Location (City)" required>
                                                        <option value="">Select Role</option>
                                                        <option value="SuperAdmin" <?= (($employee['user_type'] ?? '') == 'SuperAdmin' ? 'selected' : '') ?>>Super Admin</option>
                                                        <option value="Employee" <?= (($employee['user_type'] ?? '') == 'Employee' ? 'selected' : '') ?>>Employee(Only Register Module Permission)</option>
                                                    </select>
                                                    <div id="user_type_error" style="display:none;">Role cannot be blank.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 mt25px res_auto_btn max_width100 flex_100">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success mr10"><?= (!isset($_GET['id']) ? 'Add' : 'Update') ?> </button>
                                                    <a type="button" href="<?= $_SESSION['url_path'] ?>/app/views/customer/customer_index.php" class="btn btn-danger">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </section>

            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top"><i class="fas fa-chevron-up"></i></a>
        </div>
        <aside class="control-sidebar control-sidebar-dark"></aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/jquery/jquery.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/js/adminlte.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/toastr/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            if ("<?= isset($_SESSION['success_message']) ? 1 : 0 ?>" == 1) {
                toastr.success("<?= $_SESSION['success_message'] ?? '' ?>")
                var unnset = "<?php unset($_SESSION['success_message']); ?>"
            }
        })

        $(document).ready(function() {
            $("#employee_form").submit(function(e) {
                e.preventDefault();
                var validate = false;
                if ($('#employee_name').val() == '') {
                    $('#employee_name_error').attr('style', "color:red;");
                    validate = true;
                } else {
                    $('#employee_name_error').hide();
                }
                if ($('#employee_email_id').val() == '') {
                    $('#employee_email_id_error').attr('style', "color:red;");
                    validate = true;
                } else {
                    $('#employee_email_id_error').hide();
                }
                if ($('#employee_mobile_no1').val() == '') {
                    $('#employee_mobile_no1_error').attr('style', "color:red;");
                    validate = true;
                } else {
                    $('#employee_mobile_no1_error').hide();
                }
                if ($('#employee_city_location').find(':selected').val() == '') {
                    $('#employee_city_location_error').attr('style', "color:red;");
                    validate = true;
                } else {
                    $('#employee_city_location_error').hide();
                }
                if ($('#user_type').find(':selected').val() == '') {
                    $('#user_type_error').attr('style', "color:red;");
                    validate = true;
                } else {
                    $('#user_type_error').hide();
                }
                if (validate == true) {
                    return;
                }
                var formData = $(this).serializeArray();
                $.ajax({
                    type: "POST",
                    url: "../../controllers/EmployeeController.php",
                    data: {
                        formData: formData,
                        id: "<?= $_GET['id'] ?? 0 ?>"
                    },
                    success: function(response) {
                        window.location.href = "user_index.php";
                    }
                });
            });
        });
    </script>
</body>

</html>