<?php 

include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
}
$_SESSION['page'] = 'customer_form.php';

$model = (new Model());
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $customers = $model->select("customer", "*", " id = " . $_GET['id'])[0];
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
              <h1> Add New Customer </h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <form id="customer_form">
            <div class="row">
              <div class="col-12 mb-3">
                <div class="card mb35">
                  <div class="card-body res_col_form">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name *" value="<?= ($customers['company_name'] ?? '') ?>" required>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_name" placeholder="Customer Name *" value="<?= ($customers['customer_name'] ?? '') ?>" required>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_primary_email_id" placeholder="Primary Email *" value="<?= ($customers['customer_primary_email_id'] ?? '') ?>" required>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_mobile_no1" placeholder="Primary Mobile No.*" value="<?= ($customers['customer_mobile_no1'] ?? '') ?>" required>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="office_phone" placeholder="Office Phone" value="<?= ($customers['office_phone'] ?? '') ?>">
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <input type="text" class="form-control" name="customer_mobile_no2" placeholder="Customer Mobile No2" value="<?= ($customers['customer_mobile_no2'] ?? '') ?>">
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <textarea class="form-control" rows="3" name="office_addressline" placeholder="Office Address "><?= ($customers['office_addressline'] ?? '') ?></textarea>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-group">
                          <select class="form-control" name="customer_city_location" placeholder="Select Location (City)">
                            <option value="">Select Location (City)</option>
                            <?php foreach ($cities as $city) { ?>
                              <option value="<?= $city['id'] ?>" <?= (($customers['customer_city_location'] ?? '') == $city['id'] ? 'selected' : '') ?>><?= $city['city_name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <input type="hidden" name="user_id" value="<?= $user->id ?? 0 ?>">
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

  <script type="text/javascript">
    $(document).ready(function() {
      $("#customer_form").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serializeArray();
        $.ajax({
          type: "POST",
          url: "../../controllers/AddCustomerController.php",
          data: {
            formData: formData,
            id: "<?= $_GET['id'] ?? 0 ?>"
          },
          success: function(response) {
            window.location.href = "customer_index.php";
          }
        });
      });
    });
  </script>
</body>

</html>