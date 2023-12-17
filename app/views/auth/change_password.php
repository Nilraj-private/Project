<?php

include('../template/head.php');

$_SESSION['page'] = 'change_password.php';

?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include('../template/header.php') ?>

    <!-- Main Sidebar Container -->
    <?php include('../template/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="date_strip">
              <h1><?= date('M d, Y') ?></h1>
              <p><?= date('H:i:s A') ?></p>
            </div>
          </div>
        </div>
      </section> -->

      <!-- Content Header (Page header) -->
      <section class="content-header res_mb5 res_pt2">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-md-12 res_width65">
              <h1>Change Password</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <form id="change_password_form">
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body res_col_form">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <!-- <label>Current Password</label> -->
                          <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password" required>
                          <div class="errorMessage" id="current_password_error" style="display:none"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <!-- <label>New Password</label> -->
                          <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
                          <div class="errorMessage" id="new_password_error" style="display:none"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <!-- <label>Repeat Password</label> -->
                          <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
                          <div class="errorMessage" id="confirm_password_error" style="display:none"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-3">
                        <button type="button" class="btn btn-success mr10" onClick="changePassword();">Change Password</button>
                      </div>
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

    function changePassword() {
      var validation = true;
      if ($('#current_password').val() == "") {
        $('#current_password_error').removeAttr('style').attr('style', "color:red;").html('Current Password is required.');
        $('#current_password_error').show();
        validation = false;
      } else {
        $('#current_password_error').hide();
      }
      if ($('#new_password').val() == "") {
        $('#new_password_error').removeAttr('style').attr('style', "color:red;").html('New Password is required.');
        $('#new_password_error').show();
        validation = false;
      } else {
        $('#new_password_error').hide();
      }

      if ($('#confirm_password').val() == "") {
        $('#confirm_password_error').removeAttr('style').attr('style', "color:red;").html('Confirm Password is required.');
        $('#confirm_password_error').show();
        validation = false;
      } else {
        $('#confirm_password_error').hide();

        if ($('#new_password').val() != "" && ($('#confirm_password').val() != $('#new_password').val())) {
          $('#confirm_password_error').removeAttr('style').attr('style', "color:red;").html('Confirm Password should be same as New password.');
          $('#confirm_password_error').show();
          validation = false;
        }
      }
      if (!validation) {
        return false;
      }
      formData = $('#change_password_form').serializeArray();
      $.ajax({
        url: '../../controllers/login.php',
        type: 'POST',
        data: {
          change_password: true,
          current_password: $('#current_password').val(),
          new_password: $('#new_password').val(),
          confirm_password: $('#confirm_password').val(),
          id: "<?= $_SESSION['user_id'] ?? 0 ?>"
        },
        dataType: "json",
        success: function(response) {
            if(response.success == false){
                $('#current_password_error').removeAttr('style').attr('style', "color:red;").html(response.message);
                $('#current_password_error').show();
            }else if(response.success == true){
                window.location.href = "change_password.php";
            }
        },
      });
    }
  </script>
</body>

</html>