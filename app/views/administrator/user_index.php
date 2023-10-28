<?php

include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

$_SESSION['page'] = 'user_index.php';

$model = (new Model());
$join = " left join city_location as cl on cl.id=e.employee_city_location ";
$employees = $model->select('employee as e', ' e.*,cl.city_name ', '', $join);
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
            <div class="col-sm-6 res_width50">
              <h1>Employee List</h1>
            </div>
            <div class="col-sm-6 res_width50">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">User</a> </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="float-left res_mt5 res_fs22">Search Employee</h3>
                  <!-- <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Add User</button> -->
                </div>
                <div class="card-body res_col_form">
                  <div class="row">
                    <div class="col-2"><input type="text" class="form-control" placeholder="Employee Name"></div>
                    <div class="col-2">
                      <select class="form-control" placeholder="Select Location">
                        <option>Select Location</option>
                        <?php foreach ($cities as $city) { ?>
                          <option value="<?= $city['id'] ?>"><?= $city['city_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-1 max_width100 res_mt10"><button type="submit" class="btn btn-primary wid100" onclick="stepper.next()">Search </button> </div>
                    <div class="col-1 max_width100 res_mt10"><button type="reset" class="btn btn-default wid100">Clear</button></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 mb-3">
              <div class="card mb35">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr class="color_blue_bg">
                        <th>SI No</th>
                        <th>Employee Name</th>
                        <th>Email Address</th>
                        <th>Mobile No.</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($employees as $employee) { ?>
                        <tr>
                          <td><?= $employee['id'] ?></td>
                          <td><?= $employee['employee_name'] ?>Rajkot-DEALERS</td>
                          <td><?= $employee['employee_email_id'] ?>rajkot@recoveryourdata.co.in</td>
                          <td><?= $employee['employee_mobile_no1'] ?>9876543210</td>
                          <td><?= $employee['city_name'] ?>Rajkot-DEALERS </td>
                          <td>
                            <!-- <small class="badge badge-danger">Block</small> -->
                          </td>
                          <td>
                            <div class="input-group-prepend">
                              <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                              <ul class="dropdown-menu">
                                <!-- <li class="dropdown-item">
                                  <a href="employee_form.php?id=<?= $employee['id'] ?>"><i class="fa fa-pencil mr5"></i> Edit Details</a>
                                </li> -->
                                <li class="dropdown-item">
                                  <a href="#"><i class='fa fa-user mr5'></i> Reset Password</a>
                                </li>
                                <li class="dropdown-item">
                                  <a type="button" onclick="deleteEmployee(<?= $employee['id'] ?>)"><i class='fa fa-trash-o mr5'></i> Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
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

    function deleteEmployee(delete_id) {
      $.ajax({
        type: "POST",
        url: "../../controllers/EmployeeController.php",
        data: {
          delete_id: delete_id,
        },
        success: function(response) {
          location.reload(true);
        }
      });
    }

    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>