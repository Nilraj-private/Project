<?php

$_SESSION['url_path'] = 'https://recoveryourdata.co.in/module1';

if (!isset($_SESSION['user_id'])) {
  header("Location: auth/login.php");
}
$_SESSION['page'] = 'dashboard.php';
?>
<?php include('template/head.php') ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('template/header.php') ?>

    <!-- Main Sidebar Container -->
    <?php include('template/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
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

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid pb35 res_pb10">

          <h5 class="mt-4 mb-2 title_txt res_mt2">Register Activity<span class="title-lines"></span></h5>
          <div class="row">
            <div class="col-md-3 col-sm-6 col-12 col-md-3n ">
              <div class="block_holder">
                <div class="div1">
                  <p>Inward</p>
                </div>
                <div class="div_info">
                  <p>Inward Register</p>
                  <a href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php?type=inward" class="button btn_1">More Info</a>
                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 col-md-3n ">
              <div class="block_holder">
                <div class="div1">
                  <p>Outward</p>
                </div>
                <div class="div_info">
                  <p>Outward Register</p>
                  <a href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php?type=outward" class="button btn_1">More Info</a>
                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 col-md-3n ">
              <div class="block_holder">
                <div class="div1">
                  <p>Create Inward</p>
                </div>
                <div class="div_info">
                  <p>New Inward Form</p>
                  <a href="<?= $_SESSION['url_path'] ?>/app/views/register/create_inward.php" class="button btn_1">More Info</a>
                </div>
              </div>
            </div>
          </div>

          <h5 class="mt45 res_mt5 mb-2 title_txt">Inward Work Status<span class="title-lines title-lines2"></span></h5>
          <div class="row">
            <div class="col-md-3 col-sm-6 col-12 col-md-3n ">
              <div class="block_holder">
                <div class="div1 div2">
                  <p>Recent Inward</p>
                </div>
                <div class="div_info">
                  <p>Recent State</p>
                  <a href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php?case_status=open" class="button btn_1 btn_2">More Info</a>
                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 col-md-3n ">
              <div class="block_holder">
                <div class="div1 div2">
                  <p>Inprocess Inward</p>
                </div>
                <div class="div_info">
                  <p>Inprocess State</p>
                  <a href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php?case_status=inprogress" class="button btn_1 btn_2">More Info</a>
                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 col-md-3n ">
              <div class="block_holder">
                <div class="div1 div2">
                  <p>Proceeds Inward</p>
                </div>
                <div class="div_info">
                  <p>Proceeds State</p>
                  <a href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php?case_status=processed" class="button btn_1 btn_2">More Info</a>
                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 col-md-3n ">
              <div class="block_holder">
                <div class="div1 div2">
                  <p>Close Inward</p>
                </div>
                <div class="div_info">
                  <p>Close State</p>
                  <a href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php?case_status=close" class="button btn_1 btn_2">More Info</a>
                </div>
              </div>
            </div>
          </div>

          <div class="flex_row res_flex_column">
            <div class="col-md-6 col_w100">
              <h5 class="mt45 res_mt5 mb-2 title_txt">Customer Managment<span class="title-lines title-lines4"></span></h5>
              <div class="row">
                <div class="col-md-6">
                  <div class="block_holder">
                    <div class="div1 div4">
                      <p>My Customer</p>
                    </div>
                    <div class="div_info">
                      <p>Outward Details</p>
                      <a href="<?= $_SESSION['url_path'] ?>/app/views/customer/customer_index.php" class="button btn_1 btn_4">More Info</a>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="block_holder">
                    <div class="div1 div4">
                      <p>Add Customer</p>
                    </div>
                    <div class="div_info">
                      <p>Outward Details</p>
                      <a href="<?= $_SESSION['url_path'] ?>/app/views/customer/customer_form.php" class="button btn_1 btn_4">More Info</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col_w100">
              <h5 class="mt45 res_mt5 mb-2 title_txt">SMS Gateway<span class="title-lines title-lines5"></span></h5>
              <div class="row">
                <div class="col-md-6">
                  <div class="block_holder">
                    <div class="div1 div5">
                      <p>Promo: | Trans:</p>
                    </div>
                    <div class="div_info">
                      <p>SMS Credit</p>
                      <a href="#" class="button btn_1 btn_5">More Info</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
      </a>
    </div>
    <aside class="control-sidebar control-sidebar-dark"></aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/jquery/jquery.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/jszip/jszip.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/js/adminlte.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/js/demo.js"></script>
</body>

</html>