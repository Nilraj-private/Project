<?php

include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

$_SESSION['page'] = 'customer_index.php';

$model = (new Model());
$where = '';

if (isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'SuperAdmin') {
  $where = ' customer_city_location=' . $_SESSION['user_city'];
}
$join = " left join city_location as cl on cl.id=c.customer_city_location ";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach ($_POST as $key => $value) {
    if ($value != '')
      $where .= ($where == '') ? " $key LIKE '%" . $value . "%' " : " AND $key LIKE '%" . $value . "%' ";
  }
}
$recordsPerPage = 10;
$currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
$totalCount = $model->select('customer as c', ' c.*,cl.city_name,COUNT(1) AS total', $where, $join)[0]['total'];
$totalPages = ceil($totalCount / $recordsPerPage);

$customers = $model->select('customer as c', ' c.*,cl.city_name ', $where, $join, [], 10, (($currentPage * $recordsPerPage) - 10));

$templates = $model->select('templates');

$cities = $model->select('city_location');
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
                          <td><?= $customer['customer_mobile_no1'] ?></td>
                          <td><?= $customer['office_addressline'] ?></td>
                          <td><?= $customer['city_name'] ?></td>
                          <td><small class="badge badge-<?= ($user['is_active'] ?? 0 == 0) ? 'danger' : 'success' ?>"><?= ($user['is_active'] ?? 0 == 0) ? 'Block' : 'Active' ?></small></td>
                          <td>
                            <div class="input-group-prepend">
                              <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                              <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                  <!-- <a href="javascript:void(0);" onclick="sendMessageModal('<?= $customer['company_name'] ?>', <?= $customer['customer_mobile_no1'] ?>)"><i class="fa fa-pencil mr5"></i> Send Message</a> -->
                                </li>
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
                  <div class="row">
                    <div class="col-6">
                      Total Pages: <?= $totalPages ?>
                    </div>
                    <div class="col-6">
                      <div class="paginator float-right">
                        <ul class="pagination mb-1">
                          <li class="paginate_button page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                            <a href="<?= '?page=' . ($currentPage - 1) ?>" class="page-link">
                              Previous
                            </a>
                          </li>
                          <?php if ($totalPages < 11) {
                            for ($i = 1; $i <= $totalPages; $i++) {
                          ?>
                              <li class="paginate_button page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                <a href="<?= '?page=' . $i ?>" class="page-link">
                                  <?= $i ?>
                                </a>
                              </li>
                              <?php }
                          } else {
                            for ($i = 1; $i < $totalPages; $i++) {
                              if ($i >= ($currentPage - 3) && $i < $currentPage) {
                              ?>
                                <li class="paginate_button page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                  <a href="<?= '?page=' . $i ?>" class="page-link">
                                    <?= $i ?>
                                  </a>
                                </li>
                          <?php }
                            }
                          }
                          ?>
                          <li class="paginate_button page-item active">
                            <a href="<?= '?page=' . $currentPage ?>" class="page-link">
                              <?= $currentPage ?>
                            </a>
                          </li>
                          <?php for ($i = 1; $i < $totalPages; $i++) {
                            if ($i <= ($currentPage + 3) && $i > $currentPage) { ?>
                              <li class="paginate_button page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                <a href="<?= '?page=' . $i ?>" class="page-link">
                                  <?= $i ?>
                                </a>
                              </li>
                          <?php
                            }
                          } ?>
                          <li class="paginate_button page-item <?= ($currentPage == $totalPages) ? 'disabled' : '' ?>">
                            <a href="<?= '?page=' . ($currentPage + 1) ?>" class="page-link">
                              Next
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
  <form id="viewCustomerInward" action="../register/register.php?type=inward" method="post">
    <input type="hidden" name="customer_id" id="customer_id" value="">
  </form>

  <div class="modal fade" id="modal_send_message">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Send Message</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="send_estimate_form">
          <div class="modal-body">
            <div class="row">
              <input type="hidden" name="send_message_customer_name" id="send_message_customer_name" value="">
              <input type="hidden" name="send_message_customer_mobile_no" id="send_message_customer_mobile_no" value="">

              <div class="col-12">
                <div class="form-group">
                  <label>Messages Template</label>
                  <select class="form-control" name="send_message_template_name" id="send_message_template_name">
                    <?php foreach ($templates as $template) { ?>
                      <option value="<?= $template['template_name_slug'] ?>"><?= $template['template_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col-6">
                <button type="button" class="btn btn-success mr10" onclick="sendMessage();">Save</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

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
    // function sendMessageModal(customer_name, customer_mobile_no) {
    //   $('#send_message_customer_name').val(customer_name);
    //   $('#send_message_customer_mobile_no').val(customer_mobile_no);
    //   $('#modal_send_message').modal();
    // }

    // function sendMessage() {
    //   $.ajax({
    //     type: "POST",
    //     url: "../../controllers/whatsAppAPIController.php",
    //     data: {
    //       event_name: 'send_message',
    //       customer_name: $('#send_message_customer_name').val(),
    //       template_name: $('#send_message_template_name').find(":selected").val(),
    //       customer_mobile_no: $('#send_message_customer_mobile_no').val()
    //     },
    //     success: function(response) {
    //       console.log(response)
    //       if (response.result) {
    //         location.reload(true);
    //       }
    //     }
    //   });
    // }
    $('.select-all').click(function() {
      if ($('.select-all:checked')[0]) {
        $('input[name="id[]"]').attr('checked', true);
      } else {
        $('input[name="id[]"]').attr('checked', false);
      }
    });

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

    function viewCustomerInward(customer_id) {
      $('#customer_id').val(customer_id);
      document.getElementById('viewCustomerInward').submit();
    }

    function deleteCustomer(delete_id, customer_primary_email_id) {
      if (confirm('Are you sure you want to delete customer?'))
        $.ajax({
          type: "POST",
          url: "../../controllers/CustomerController.php",
          data: {
            delete_id: delete_id,
            primary_email_id: customer_primary_email_id
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
        "bPaginate": false,
        "info": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>