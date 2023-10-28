<?php

include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
}

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $model = (new Model());
    $city = $model->select("city_location", "*", " id = " . $_GET['id'])[0];
}
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
                        <div class="col-sm-6 res_width65">
                            <h1><?= (!isset($_GET['id']) ? 'Add New' : 'Update') ?> City</h1>
                        </div>
                        <div class="col-sm-6 res_width35">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">City</a> </li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid ">
                    <form id="create_city">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="card  mb35">
                                    <!-- <div class="card-header">
                                        <h3 class="float-left"><?= (!isset($_GET['id']) ? 'Add' : 'Update') ?> City :</h3>
                                    </div> -->
                                    <div class="card-body res_col_form">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label>City Name</label>
                                                    <input type="text" class="form-control" name="city_name" id="city_name" placeholder="City Name" value="<?= $city['city_name'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt25px res_auto_btn res_mb12 ">
                                            <button type="button" class="btn btn-success mr10" onClick="addCity();"> <?= (!isset($_GET['id']) ? 'Add' : 'Update') ?> </button>
                                            <a type="button" href="<?= $_SESSION['url_path'] ?>/app/views/administrator/city_index.php" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top"><i class="fas fa-chevron-up"></i></a>
        </div>
        <aside class="control-sidebar control-sidebar-dark"></aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/jquery/jquery.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/jszip/jszip.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/js/adminlte.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/js/demo.js"></script>
    <!-- Page specific script -->

    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/moment/moment.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/toastr/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            if ("<?= isset($_SESSION['success_message']) ? 1 : 0 ?>" == 1) {
                toastr.success("<?= $_SESSION['success_message'] ?? '' ?>")
                var unnset = "<?php unset($_SESSION['success_message']); ?>"
            }
        })

        function addCity() {
            formData = $('#create_city').serializeArray();
            $.ajax({
                url: '../../controllers/CityController.php',
                type: 'POST',
                data: {
                    formData: formData,
                    id: "<?= $_GET['id'] ?? 0 ?>"
                },
                success: function(response) {
                    window.location.href = "city_index.php";
                },
            });
        }
    </script>
</body>

</html>