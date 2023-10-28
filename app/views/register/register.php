<?php

include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
}

$_SESSION['page'] = 'register.php' . (isset($_GET['type']) ? '?type=' . $_GET['type'] : '');

$model = (new Model());
$where = '';

if (isset($_GET["type"]) && ($_GET["type"] == 'inward' || $_GET["type"] == 'outward')) {
  $type = $_GET["type"];
  $where .= " case_register_state=" . ($_GET['type'] == 'outward' ? 2 : ($_GET['type'] == 'inward' ? 1 : 3));
} elseif (!isset($_GET["type"])) {
  $type = '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach ($_POST as $key => $value) {
    if ($value != '') {
      $where .= (($where == '') ? '' : ' AND ') . " $key = '" . $value . "' ";
    }
  }
}

$join = ' LEFT JOIN customer as c on c.id=cr.customer_id ';
$case_registers = $model->select('case_register as cr', 'cr.*,c.company_name,c.customer_name', $where, $join);
$manufacturers = $model->select('device_manufacturer');
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
      <div id="flash_message">

      </div>
      <!-- Content Header (Page header) -->
      <section class="content-header res_mb5 res_pt2">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6 res_width50">
              <h1>Manage <?= ($type != '') ? ucfirst($type) . " Register" : "Register" ?> </h1>
            </div>
            <div class="col-sm-6 res_width50">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Manage <?= ($type != '') ? ucfirst($type) . " Register" : "Register" ?> </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- modal -->
      <div class="modal fade" id="modal_send_estimate">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Send Estimate</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="">
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Estimate Amount</label>
                      <input type="text" class="form-control" name="estimate_amount" id="estimate_amount" placeholder="Enter Amount">
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label>Estimation Details</label>
                      <textarea class="form-control" rows="3" placeholder="Enter Customer Update Details"></textarea>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label>Estimate Approved By Customer</label>
                      <select class="form-control">
                        <option value="">Pending</option>
                        <option value="1">Approved</option>
                        <option value="2">Rejected</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-12 mb-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="SendEmail">
                      <label class="form-check-label" for="exampleCheck1">Send Email</label>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <input class="submit btn btn-success" type="submit" name="yt0" value="Save">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-send-datatree">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Send Data Tree File</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12 mb-3">
                  <div class="custom-file ">
                    <input type="file" class="form-control" id="exampleInputFile">
                  </div>
                </div>

                <div class="col-12 mb-3">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Is Data Recovered</label>
                  </div>
                </div>

                <div class="col-12 mb-3">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                    <label class="form-check-label" for="exampleCheck1">Send Email</label>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <input class="submit btn btn-success" type="submit" name="yt0" value="Save">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal_add_storage_details">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Storage Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>HDD Numer</label>
                    <input type="text" class="form-control" placeholder="Enter Storage HDD Number">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label>Storage Size</label>
                    <input type="text" class="form-control" placeholder="Enter Storage Data Size. i.e. 205GB">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label>Storage Remarks</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Remarks"></textarea>
                  </div>
                </div>

                <div class="col-12 mb-3">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="DataRecovered">
                    <label class="form-check-label" for="exampleCheck1">Is Data Recovered</label>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <input class="submit btn btn-success" type="submit" name="yt0" value="Save">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="float-left res_mt5 res_fs22">Search Device</h3>
                  <a type="button" class="btn btn-primary float-right" href="<?= $_SESSION['url_path'] ?>/app/views/register/create_inward.php<?= isset($_GET['type']) ? '?type=' . $_GET['type'] : '' ?>">Create Inward</a>
                </div>
                <form method="post" action="register.php<?= isset($_GET['type']) ? '?type=' . $_GET['type'] : '' ?>">
                  <div class="card-body res_col_form">
                    <div class="row">
                      <div class="col-2">
                        <select class="form-control" name="case_register_state" id="case_register_state" placeholder="All Register">
                          <option value="">All Register</option>
                          <option value="1" <?= (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET) && ($_GET['type'] == 'inward')) ? 'selected' : ''; ?> <?= (isset($_POST) && ($_POST['case_register_state'] ?? '') == 1) ? 'selected' : ''; ?>>Inward</option>
                          <option value="2" <?= (($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET) && ($_GET['type'] == 'outward')) ? 'selected' : ''; ?> <?= (isset($_POST) && ($_POST['case_register_state'] ?? '') == 2) ? 'selected' : ''; ?>>Outward</option>
                        </select>
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="cr.id" id="cr.id" placeholder="Inward Id" value="<?= (isset($_POST) ? ($_POST['cr.id'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="device_serial_number" id="device_serial_number" placeholder="Serial #" value="<?= (isset($_POST) ? ($_POST['device_serial_number'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="device_model" id="device_model" placeholder="Model No." value="<?= (isset($_POST) ? ($_POST['device_model'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="c.company_name" id="c.company_name" placeholder="Company Name" value="<?= (isset($_POST) ? ($_POST['c.company_name'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="c.customer_name" id="c.customer_name" placeholder="Customer Name" value="<?= (isset($_POST) ? ($_POST['c.customer_name'] ?? '') : '') ?>">
                      </div>
                    </div>
                    <div class="row mt25px res_mt0">
                      <div class="col-2">
                        <div class="input-group date" id="case_received_date" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="case_received_date" id="case_received_date" data-target="#case_received_date" placeholder="Start Date">
                          <div class="input-group-append" data-target="#case_received_date" data-toggle="datetimepicker">
                            <div class="input-group-text">
                              <i class="fa fa-calendar calendar_code"></i>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-2">
                        <div class="input-group date" id="case_return_date" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="case_return_date" id="case_return_date" data-target="#case_return_date" placeholder="End Date">
                          <div class="input-group-append" data-target="#case_return_date" data-toggle="datetimepicker">
                            <div class="input-group-text">
                              <i class="fa fa-calendar calendar_code"></i>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-2">
                        <select class="form-control" name="device_maker_id" id="device_maker_id" placeholder="Select Manufacturer">
                          <option value="">Select Manufacturer</option>
                          <?php foreach ($manufacturers as $manufacturer) { ?>
                            <option value="<?= $manufacturer['id'] ?>" <?= (isset($_POST) && ($_POST['device_maker_id'] ?? '') == $manufacturer['id']) ? 'selected' : ''; ?>><?= $manufacturer['manufacturer_name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="col-2">
                        <select class="form-control" name="case_status" id="case_status" placeholder="Device Status">
                          <option value="">Device Status</option>
                          <option value="1" <?= (isset($_POST) && ($_POST['case_status'] ?? '') == 1) ? 'selected' : ''; ?>>Open</option>
                          <option value="2" <?= (isset($_POST) && ($_POST['case_status'] ?? '') == 2) ? 'selected' : ''; ?>>Inprocess</option>
                          <option value="3" <?= (isset($_POST) && ($_POST['case_status'] ?? '') == 3) ? 'selected' : ''; ?>>Processed</option>
                          <option value="4" <?= (isset($_POST) && ($_POST['case_status'] ?? '') == 4) ? 'selected' : ''; ?>>Close</option>
                        </select>
                      </div>

                      <div class="col-2">
                        <select class="form-control" name="case_result" id="case_result" placeholder="Recovery Status">
                          <option value="">Recovery Status</option>
                          <option value="1" <?= (isset($_POST) && ($_POST['case_result'] ?? '') == 1) ? 'selected' : ''; ?>>Recovered</option>
                          <option value="0" <?= (isset($_POST) && ($_POST['case_result'] ?? '') == 0) ? 'selected' : ''; ?>>Not Recovered</option>
                        </select>
                      </div>

                      <div class="col-2">
                        <select class="form-control" name="customer_city_location" id="customer_city_location" placeholder="Select Location">
                          <option value="">Select Location</option>
                          <?php foreach ($cities as $city) { ?>
                            <option value="<?= $city['id'] ?>" <?= (isset($_POST) && ($_POST['customer_city_location'] ?? '') == $city['id']) ? 'selected' : ''; ?>><?= $city['city_name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>

                    </div>

                    <div class="row mt25px res_mt10">
                      <div class="col-1 max_width100">
                        <button type="submit" class="btn btn-primary wid100">Search </button>
                      </div>
                      <div class="col-1 max_width100">
                        <button type="reset" class="btn btn-default wid100">Clear</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr class="color_blue_bg">
                        <th> <input type="checkbox" name="terms" class="" id="exampleCheck1"></th>
                        <th>Id</th>
                        <th>Serial #</th>
                        <th>Company Name</th>
                        <th>Status</th>
                        <th>Recovery </th>
                        <th>Estimate</th>
                        <th>Received Date</th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $case_status = [1 => 'Open', 2 => 'In Progress', 3 => 'Processed', 4 => 'Close'];
                      $case_status_color = [1 => 'success', 2 => 'warning', 3 => 'info', 4 => 'danger'];
                      $estimate_status = [0 => 'Pending', 1 => 'Approved', 2 => 'Reject'];
                      $estimate_status_color = [0 => 'warning', 1 => 'success', 2 => 'danger'];
                      $recovery_status = [0 => 'Not Recovered', 1 => 'Recovered'];
                      $recovery_status_color = [0 => 'secondary', 1 => 'success'];
                      if (isset($case_registers) && $case_registers != '')
                        foreach ($case_registers as $case_register) { ?>
                        <tr id="register_tr_no_filter">
                          <td>
                            <input type="checkbox" name="terms" class="" id="exampleCheck1">
                          </td>
                          <td><?= $case_register['id'] ?></td>
                          <td>
                            <?= $case_register['device_serial_number'] ?><small class="badge badge-success float-right">Inward </small>
                          </td>
                          <td><?= $case_register['company_name'] ?></td>
                          <td>
                            <!-- <small class="badge badge-<?= $case_status_color[$case_register['case_status']] ?>"><?= $case_status[$case_register['case_status']] ?></small> -->
                          </td>
                          <td>
                            <small class="badge badge-<?= ($recovery_status_color[$case_register['case_result']]) ?>"><?= ($recovery_status[$case_register['case_result']]) ?></small>
                          </td>
                          <td>
                            <small class="badge badge-<?= ($estimate_status_color[$case_register['estimate_approved_by_customer']]) ?>"><?= ($estimate_status[$case_register['estimate_approved_by_customer']]) ?></small>
                          </td>
                          <td>
                            <?= date('d M, Y h:m a', strtotime($case_register['case_received_date'])) ?>
                          </td>
                          <td>
                            <div class="input-group-prepend">
                              <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                              <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                  <a href="see_details.php<?= (isset($_GET['type'])) ? '?type=' . $_GET['type'] . '&' : '?' ?>id=<?= $case_register['id'] ?>"><i class='fa fa-search mr5'></i> See Details</a>
                                </li>
                                <li class="dropdown-item">
                                  <a href="create_inward.php<?= (isset($_GET['type'])) ? '?type=' . $_GET['type'] . '&' : '?' ?>id=<?= $case_register['id'] ?>"><i class="fa fa-pencil mr5"></i> Edit</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item">
                                  <a href="#" data-toggle="modal" data-target="#modal_send_estimate"><i class='fa fa-inr mr5'></i> Send Estimate</a>
                                </li>
                                <li class="dropdown-item">
                                  <a href="#" data-toggle="modal" data-target="#modal_add_storage_details"><i class='fa fa-cog mr5'></i> Add Storage Detail</a>
                                </li>
                                <li class="dropdown-item">
                                  <a href="#" data-toggle="modal" data-target="#modal-send-datatree"><i class='fa fa-cog mr5'></i> Send Data Tree</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item">
                                  <a href="#"><i class='fa fa-print mr5'></i> Print</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <!-- <li class="dropdown-item">
                                  <a href="#"><i class='fa fa-inbox mr5'></i> Move to Stock</a>
                                </li> -->
                                <li class="dropdown-item">
                                  <a href="#"><i class='fa fa-sign-out mr5'></i> Move to Outward</a>
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

            <div class="col-12">
              <div class="col-12">
                <button type="submit" class="btn btn-primary float-left mb35 res_mb25">Delete All</button>
              </div>

              <div class="col-md-12 pt30 bdr_top mb35 res_pt20 flex_row res_flex_column_new">
                <div class="col-md-8 res_padding0 ">
                  <h5 class="mb-3 res_fs22">Status Note:</h5>
                  <p><span class="badge badge-success width65 mr5">Open</span> Device in analysis stage and need to send cost estimatation.</p>
                  <p><span class="badge bg-warning width65 mr5">In Process</span> Estimation details is send to client, waiting for client approval.</p>
                  <p><span class="badge badge-primary width65 mr5">Processed</span> Client approved and process next step of data recovery and send data tree.</p>
                  <p><span class="badge badge-danger width65 mr5">Close</span> Final stage of Device, no action required.</p>
                </div>

                <div class="col-md-4 res_mt10 res_padding0 ">
                  <h5 class="mb-3 res_fs22">Register Status :</h5>
                  <p><span class="badge badge-success width65 mr5">Inward</span> Device in Inward Register.</p>
                  <p><span class="badge badge-secondary width65 mr5">Outward </span> Device in Outward Register.</p>

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

    function deleteCustomer(delete_id) {
      $.ajax({
        type: "POST",
        url: "../../controllers/RegisterController.php",
        data: {
          delete_id: delete_id,
        },
        success: function(response) {
          location.reload(true);
        }
      });
    }

    $(function() {
      $('#case_received_date').datetimepicker({
        format: 'L'
      });
      $('#case_return_date').datetimepicker({
        format: 'L'
      });
    })

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