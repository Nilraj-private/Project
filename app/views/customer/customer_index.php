<?php

include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

$_SESSION['page'] = 'customer_index.php';

$model = (new Model());
$join = " left join city_location as cl on cl.id=c.customer_city_location ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $where = '';
  foreach ($_POST as $key => $value) {
    if ($value != '')
      $where .= (($where == '') ? '' : ' AND ') . " $key LIKE '%" . $value . "%' ";
  }
  $customers = $model->select('customer as c', ' c.*,cl.city_name ', $where, $join);
} else {
  $customers = $model->select('customer as c', ' c.*,cl.city_name ', '', $join);
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
            <div class="col-sm-6 res_width65">
              <h1> Customer Managment </h1>
            </div>
            <div class="col-sm-6 res_width35">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Customer</a> </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- modal -->
      <div class="modal fade" id="modal_sms">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Type Your Message</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <label>No of Selected Record: <span id="selected-record-no"></span></label>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label>Your Message</label>
                    <textarea class="form-control" id="sms_message_text" name="message" rows="3" placeholder="Enter Your Message"></textarea>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <button id="submitBulkSms" type="button" class="btn btn-primary"><i class="fa fa-envelope"></i> Send message</button>
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
                  <h3 class="float-left res_mt5 res_fs22">Search Customer </h3>
                  <a type="button" class="btn btn-primary float-right" href="<?= $_SESSION['url_path'] ?>/app/views/customer/customer_form.php"><i class="fa fa-plus"></i> Add Customer</a>
                </div>
                <form method="post" action="customer_index.php">
                  <div class="card-body res_col_form">
                    <div class="row">
                      <div class="col-2">
                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name" value="<?= (isset($_POST) ? ($_POST['company_name'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name" value="<?= (isset($_POST) ? ($_POST['customer_name'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="email" class="form-control" name="customer_primary_email_id" id="customer_primary_email_id" placeholder="Email Id" value="<?= (isset($_POST) ? ($_POST['customer_primary_email_id'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="tel" class="form-control" name="customer_mobile_no1" id="customer_mobile_no1" placeholder="Mobile No." value="<?= (isset($_POST) ? ($_POST['customer_mobile_no1'] ?? '') : '') ?>">
                      </div>

                      <div class="col-2">
                        <select class="form-control" name="customer_city_location" id="customer_city_location" placeholder="Select City">
                          <option value="">Select City</option>
                          <?php foreach ($cities as $city) { ?>
                            <option value="<?= $city['id'] ?>" <?= (isset($_POST) && ($_POST['customer_city_location'] ?? '') == $city['id']) ? 'selected' : ''; ?>><?= $city['city_name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="col-1 max_width100 res_mt10">
                        <button type="submit" class="btn btn-primary wid100">Search </button>
                      </div>
                      <div class="col-1 max_width100 res_mt10">
                        <a class="btn btn-default wid100" href="<?= $_SESSION['url_path'] ?>/app/views/customer/customer_index.php">Clear</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr class="color_blue_bg">
                        <th> <input type="checkbox" class="select-all"></th>
                        <th>SI No</th>
                        <th>Company Name</th>
                        <th>Customer Name</th>
                        <th>Primary Email</th>
                        <th>Contact No.</th>
                        <th>Office Address</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $counter = 0;
                      if (isset($customers) && $customers != '') foreach ($customers as $customer) {
                        $user = $model->select("user", "*", "id = " . $customer['user_id'])[0] ?? '';
                      ?>
                        <tr id="tr_with_no_filter">
                          <td>
                            <input type="checkbox" name="id[]" id="id_<?= $counter++; ?>" value="<?= $customer['id'] ?>">
                          </td>
                          <td><?= $customer['id'] ?></td>
                          <td><?= $customer['company_name'] ?></td>
                          <td><?= $customer['customer_name'] ?></td>
                          <td><?= $customer['customer_primary_email_id'] ?></td>
                          <td><?= $customer['customer_mobile_no1']   ?></td>
                          <td><?= $customer['office_addressline'] ?></td>
                          <td><?= $customer['city_name'] ?></td>
                          <td><small class="badge badge-<?= ($user['is_active'] ?? 0 == 0) ? 'danger' : 'success' ?>"><?= ($user['is_active'] ?? 0 == 0) ? 'Block' : 'Active' ?></small></td>
                          <td>
                            <div class="input-group-prepend">
                              <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                              <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                  <a href="customer_form.php?id=<?= $customer['id'] ?>"><i class="fa fa-pencil mr5"></i> Edit Customer</a>
                                </li>
                                <li class="dropdown-item">
                                  <a onclick="viewCustomerInward(<?= $customer['id'] ?>)" style="cursor: pointer;color: #007bff;"><i class='fa fa-inbox mr5'></i> View Inward</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item">
                                  <a href="#"><i class='fa fa-user mr5'></i> Reset Password</a>
                                </li>
                                <li class="dropdown-item">
                                  <a type="button" onclick="deleteCustomer(<?= $customer['id'] ?>,'<?= $customer['customer_primary_email_id'] ?>')" style="cursor: pointer;color: #007bff;"><i class='fa fa-trash-o mr5'></i> Delete Customer</a>
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

            <div class="container-fluid mb35">
              <button type="button" id="send_sms" class="btn btn-primary float-left mb35 res_mb25"><i class="fa fa-envelope"></i> Send SMS</button>
            </div>
          </div>
        </div>
      </section>
      <!-- <form method="POST" id="view_inward_form" action="../register/register.php">
        <input type="hidden" name=""
      </form> -->
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
    $('.select-all').click(function() {
      if ($('.select-all:checked')[0]) {
        $('input[name="id[]"]').attr('checked', true);
      } else {
        $('input[name="id[]"]').attr('checked', false);
      }
    });

    $('#send_sms').click(function(e) {
      var total = $('input[name="id[]"]:checked').length;
      var atLeastOneIsChecked = total > 0;

      if (!atLeastOneIsChecked) {
        alert('Please select atleast one customer');
      } else {
        $("#selected-record-no").html(total);
        $('#modal_sms').modal();
      }
    });
    $("#submitBulkSms").click(function() {
      var text_message = $("#sms_message_text").val();
      if (text_message != "") {

        var checkedValues = $('input[name="id[]"]:checked').map(function() {
          return this.value;
        }).get();

        $.ajax({
          url: "SendBulkSMS",
          data: {
            userid: checkedValues,
            message: text_message
          },
          method: 'POST',
        }).done(function() {
          $(this).addClass("done");
          alert('Message Successfully Send');
          $('#SendSmsModal').modal('hide');
        });
      } else {
        alert("Plz... Enter Message.");
      }
    });
    $(document).ready(function() {
      if ("<?= isset($_SESSION['success_message']) ? 1 : 0 ?>" == 1) {
        toastr.success("<?= $_SESSION['success_message'] ?? '' ?>")
        var unnset = "<?php unset($_SESSION['success_message']); ?>"
      }
    })

    function viewCustomerInward(customer_id) {

    }

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