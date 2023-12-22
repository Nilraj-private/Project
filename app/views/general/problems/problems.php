<?php

include('../../template/head.php');

$_SESSION['page'] = 'problems.php';

?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include('../../template/header.php') ?>

    <!-- Main Sidebar Container -->
    <?php include('../../template/sidebar.php') ?>

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
            <div class="col-sm-6 res_width40">
              <h1 class="res_fs22n">Manage Ploblem Issues</h1>
            </div>
            <div class="col-sm-6 res_width60">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Manage Ploblem Issues</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 mb-3">
              <div class="card mb35">
                <div class="card-header">
                  <a type="button" href="<?= $_SESSION['url_path'] ?>/app/views/general/problems/problem_details.php" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Add Problem</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr class="color_blue_bg">
                        <th>Problem No</th>
                        <th>Problem Title</th>
                        <th>Problem Details</th>
                        <th>Solutions</th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>0001</td>
                        <td>Head problem HDD return with non availability of donor</td>
                        <td>We regret to inform you that despite our diligent efforts, we have been unable to locate a suitable donor HDD in the market. As a result, we kindly request your cooperation in collecting the HDD, as it is deemed unrecoverable. We apologize for any inconvenience caused If you have any further questions or require assistance, please don't hesitate to reach out.</td>
                        <td></td>
                        <td>
                          <div class="input-group-prepend center_m">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a></li>
                              <li class="dropdown-item"><a href="problem_details.html"><i class='fa fa-search mr5'></i> View Details</a></li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete Record</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>0002</td>
                        <td>Firmware related issue</td>
                        <td>HDD is having firmware related issue. Estimated time of data delivery is 03 to 05 working days after your approval.</td>
                        <td></td>
                        <td>
                          <div class="input-group-prepend center_m">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a></li>
                              <li class="dropdown-item"><a href="problem_details.html"><i class='fa fa-search mr5'></i> View Details</a></li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete Record</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>0003</td>
                        <td>Unrecovverable</td>
                        <td></td>
                        <td>Respected Sir, Data recovery from this HDD is not possible due to a scratch ring found on the platter surface. Please find the attached image files for your reference. HDD can be collected unrecoverable at any time during office hours.</td>
                        <td>
                          <div class="input-group-prepend center_m">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a></li>
                              <li class="dropdown-item"><a href="problem_details.html"><i class='fa fa-search mr5'></i> View Details</a></li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete Record</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>0004</td>
                        <td>Firmware & Bad sectors</td>
                        <td>HDD is having firmware as well as bad sectors related issue. Estimated time of data delivery is 05 to 07 working days after your approval.</td>
                        <td></td>
                        <td>
                          <div class="input-group-prepend center_m">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a></li>
                              <li class="dropdown-item"><a href="problem_details.html"><i class='fa fa-search mr5'></i> View Details</a></li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete Record</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>0005</td>
                        <td>POD</td>
                        <td></td>
                        <td>Dear All, Courier has been received at your site on (Date). Please find the attached POD document.</td>
                        <td>
                          <div class="input-group-prepend center_m">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a></li>
                              <li class="dropdown-item"><a href="problem_details.html"><i class='fa fa-search mr5'></i> View Details</a></li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete Record</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>0006</td>
                        <td>Head & firmware</td>
                        <td>HDD is having firmware related issue as well as chances of head failure, may have to open drive for data recovery. Estimated time of data delivery is 09 to 11 days or more depending upon availability of donor drive.</td>
                        <td></td>
                        <td>
                          <div class="input-group-prepend center_m">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a></li>
                              <li class="dropdown-item"><a href="problem_details.html"><i class='fa fa-search mr5'></i> View Details</a></li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete Record</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>


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
      if ("<?= isset($_SESSION['error_message']) ? 1 : 0 ?>" == 1) {
        toastr.error("<?= $_SESSION['error_message'] ?? '' ?>")
        var unnset = "<?php unset($_SESSION['error_message']); ?>"
      }
    })

    function deleteCustomer(delete_id, customer_primary_email_id) {
      $.ajax({
        type: "POST",
        url: "../../controllers/CustomerController.php",
        data: {
          delete_id: delete_id,
          customer_primary_email_id: customer_primary_email_id
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