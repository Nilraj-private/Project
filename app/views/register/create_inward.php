<?php

include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

$_SESSION['page'] = 'create_inward.php';

$model = (new Model());
$where = '';
if (isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'SuperAdmin') {
  $where = ' customer_city_location = ' . $_SESSION['user_city'];
}
$customers = $model->select("customer", '*', $where);
$manufacturers = $model->select("device_manufacturer");
$cities = $model->select("city_location");

if (isset($_REQUEST['id'])) {
  $join = ' left join customer as c on c.id=cr.customer_id ';
  $inward = $model->select('case_register as cr', 'cr.*, c.company_name', ' cr.id=' . $_REQUEST['id'], $join)[0];
}
?>
<style>
  #container {
    padding: 20px;
  }

  h2 {
    margin-bottom: 10px;
    font-size: 24px;
    font-weight: bold;
  }

  #overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2305px !important;
    /*change to YOUR page height*/
    background-color: #000;
    filter: alpha(opacity=50);
    -moz-opacity: 0.5;
    -khtml-opacity: 0.5;
    opacity: 0.5;
    z-index: 998;
  }

  #remove_overlay {
    position: relative;
    z-index: 1000;
  }
</style>

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
            <div class="col-sm-6 res_width50">
              <h1>Take New Inward</h1>
            </div>
            <div class="col-sm-6 res_width50">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active"> Register</a> </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid ">
          <form id="inward_form">
            <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-body res_col_form">
                    <div class="row">
                      <div class="col-2">
                        <h4 class="float-left">Select Client :</h4>
                      </div>
                      <div class="col-6">
                        <select class="form-control" name="customer_id" id="customer_id" required>
                          <option value="">Select Client</option>
                        </select>
                        <div class="errorMessage" id="customer_id_error" style="display:none"></div>
                      </div>

                      <div class="col-2 res_mt10 new_col">
                        <button type="button" class="btn btn-primary wid100" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i> Add Customer </button>
                      </div>
                      <div class="col-2 res_mt10 new_col">
                        <a type="button" href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php<?= (isset($_REQUEST['type'])) ? '?type=' . $_REQUEST['type'] : '' ?>" class="btn btn-default wid100"><i class="fa fa-inbox"></i> Inward List</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 mb-3">
                <div class="card  mb35">
                  <div class="card-header">
                    <h3 class="float-left">Inward Details :</h3>
                  </div>
                  <div class="card-body res_col_form">
                    <div class="row">
                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Serial Number</label>
                          <input type="text" class="form-control" name="device_serial_number" id="device_serial_number" placeholder="Device Serial Number" value="<?= $inward['device_serial_number'] ?? '' ?>">
                          <div class="errorMessage" id="device_serial_number_error" style="display:none"></div>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Internal Serial Number</label>
                          <input type="text" class="form-control" name="device_internal_serial_number" id="device_internal_serial_number" placeholder="Device Internal Serial Number" value="<?= $inward['device_internal_serial_number'] ?? '' ?>">
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Manufacturer</label>
                          <select class="form-control" name="device_maker_id" id="device_maker_id" placeholder="Device Manufacturer">
                            <option value="">Select Device Manufacturer</option>
                            <?php foreach ($manufacturers as $manufacturer) { ?>
                              <option value="<?= $manufacturer['id'] ?>" <?= (($inward['device_maker_id'] ?? '') == $manufacturer['id']) ? 'selected' : '' ?>><?= $manufacturer['manufacturer_name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Model</label>
                          <input type="text" class="form-control" name="device_model" id="device_model" placeholder="Device Model" value="<?= $inward['device_model'] ?? '' ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row mt25px res_mt0">
                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Type</label>
                          <select class="form-control" name="device_type" id="device_type" placeholder="Select Device Type">
                            <option value="">Device Type</option>
                            <option value="DESKTOP" <?= (($inward['device_type'] ?? '') == 'DESKTOP') ? 'selected' : '' ?>>DESKTOP</option>
                            <option value="LAPTOP" <?= (($inward['device_type'] ?? '') == 'LAPTOP') ? 'selected' : '' ?>>LAPTOP</option>
                            <option value="USB WITH CABLE" <?= (($inward['device_type'] ?? '') == 'USB WITH CABLE') ? 'selected' : '' ?>>USB WITH CABLE</option>
                            <option value="USB WITHOUT CABLE" <?= (($inward['device_type'] ?? '') == 'USB WITHOUT CABLE') ? 'selected' : '' ?>>USB WITHOUT CABLE</option>
                            <option value="USB WITH CABLE & ADAPTER" <?= (($inward['device_type'] ?? '') == '"USB WITH CABLE & ADAPTER') ? 'selected' : '' ?>>USB WITH CABLE & ADAPTER</option>
                            <option value="USB WITHOUT CABLE & WITH ADAPTER" <?= (($inward['device_type'] ?? '') == 'USB WITHOUT CABLE & WITH ADAPTER') ? 'selected' : '' ?>>USB WITHOUT CABLE & WITH ADAPTER
                            </option>
                            <option value="USB WITHOUT CABLE & WITHOUT ADAPTER" <?= (($inward['device_type'] ?? '') == 'USB WITHOUT CABLE & WITHOUT ADAPTER') ? 'selected' : '' ?>>USB WITHOUT CABLE & WITHOUT
                              ADAPTER</option>
                            <option value="LAPTOP SSD SATA" <?= (($inward['device_type'] ?? '') == 'LAPTOP SSD SATA') ? 'selected' : '' ?>>LAPTOP SSD SATA</option>
                            <option value="NVME SSD" <?= (($inward['device_type'] ?? '') == 'NVME SSD') ? 'selected' : '' ?>>NVME SSD</option>
                            <option value="SSD USB WITH CABLE" <?= (($inward['device_type'] ?? '') == 'SSD USB WITH CABLE') ? 'selected' : '' ?>>SSD USB WITH CABLE</option>
                            <option value="SSD USB WITHOUT CABLE" <?= (($inward['device_type'] ?? '') == 'SSD USB WITHOUT CABLE') ? 'selected' : '' ?>>SSD USB WITHOUT CABLE</option>
                            <option value="OTHER" <?= (($inward['device_type'] ?? '') == 'OTHER') ? 'selected' : '' ?>>OTHER</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Size</label>
                          <div>
                            <input type="hidden" name="device_size" id="device_size1" value="<?= (substr($inward['device_size'] ?? '', 0, -2)); ?>">
                            <input type="text" class="form-control width64per float-left" id="device_size2" placeholder="Device Size" value="<?= (substr($inward['device_size'] ?? '', 0, -2)); ?>">
                            <select class="form-control width-36 float-left" placeholder="Select Device Size" id="device_size_unit">
                              <option value="TB" <?= (strpos(($inward['device_size'] ?? ''), 'TB')) ? 'selected' : '' ?>>TB</option>
                              <option value="GB" <?= (strpos(($inward['device_size'] ?? ''), 'GB')) ? 'selected' : '' ?>>GB</option>
                              <option value="MB" <?= (strpos(($inward['device_size'] ?? ''), 'MB')) ? 'selected' : '' ?>>MB</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Crash Type</label>
                          <select class="form-control" name="crash_type" id="crash_type" placeholder="Crash Type">
                            <option value="">Crash Type</option>
                            <option value="PHYSICAL" <?= (($inward['crash_type'] ?? '') == 'PHYSICAL') ? 'selected' : '' ?>>Physical</option>
                            <option value="LOGICAL" <?= (($inward['crash_type'] ?? '') == 'LOGICAL') ? 'selected' : '' ?>>Logical</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Firmware</label>
                          <input type="text" class="form-control" name="device_firmware" id="device_firmware" placeholder="Firmware Number" value="<?= $inward['device_firmware'] ?? '' ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row mt25px res_mt0_991">
                      <div class="col-3">
                        <div class="form-group">
                          <label>Device MLC</label>
                          <input type="text" class="form-control" name="device_mlc" id="device_mlc" placeholder="Device MLC" value="<?= $inward['device_mlc'] ?? '' ?>">
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="input-group date " id="case_received_date" data-target-input="nearest">
                          <label class="width-full">Device Received Date</label>
                          <input type="text" class="form-control datetimepicker-input" data-target="#case_received_date" name="case_received_date" id="case_received_date" placeholder="Device Received Date">
                          <div class="input-group-append" data-target="#case_received_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>Files and Directories to be recovered</label>
                          <textarea class="form-control" rows="2" name="files_to_recover" id="files_to_recover" placeholder="Enter Files to be Recovered Details"><?= $inward['files_to_recover'] ?? '' ?></textarea>
                        </div>
                      </div>
                      <input type="hidden" name="case_register_state" value="1">
                      <input type="hidden" name="case_status" value="1">
                      <input type="hidden" name="estimate_approved_by_customer" value="0">
                    </div>
                    <?php if (!isset($inward)) { ?>
                      <div class="row mt25px res_mt0">
                        <div class="col-3">
                          <div class="form-group">
                            <label for="deliver_through_courier">Deliver through courier</label>
                            <input type="checkbox" name="deliver_through_courier" id="deliver_through_courier" class="form-control">
                          </div>
                        </div>

                        <div class="col-3 courier_details" style="display: none;">
                          <div class="form-group">
                            <label>Courier Name</label>
                            <input type="text" class="form-control" name="courier_name" id="courier_name" placeholder="Courier Service Name">
                          </div>
                        </div>

                        <div class="col-3 courier_details" style="display: none;">
                          <div class="form-group">
                            <label>Docket Number</label>
                            <input type="text" class="form-control" name="courier_dock_number" id="courier_dock_number" placeholder="Courier Docket Number">
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                    <div class="row mt25px res_auto_btn res_mb12 ">
                      <?php if (!isset($_REQUEST['id'])) { ?>
                        <button type="button" class="btn btn-success mr10" onClick="addInward(0);">Save & Add New </button>
                        <button type="button" class="btn btn-success mr10" onClick="addInward(1);">Save & Exit</button>
                      <?php } else { ?>
                        <button type="button" class="btn btn-success mr10" onClick="addInward(1);">Update</button>
                      <?php } ?>
                      <a type="button" href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php<?= (isset($_REQUEST['type'])) ? '?type=' . $_REQUEST['type'] : '' ?>" class="btn btn-danger">Cancel</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="modal fade" id="modal-lg">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="customer_form" method="POST" action="../../controllers/CustomerController.php">
                <div class="modal-body res_col_form">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Company Name *</label>
                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name *" required>
                        <div id="company_name_error" style="display:none;">Company Name cannot be blank.</div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label>Customer Name *</label>
                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name *" required>
                        <div id="customer_name_error" style="display:none;">Customer Name cannot be blank.</div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label>Primary Email *</label>
                        <input type="text" class="form-control" name="customer_primary_email_id" id="customer_primary_email_id" placeholder="Primary Email *" required>
                        <div id="customer_primary_email_id_error" style="display:none;">Primary Email cannot be blank.</div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label>Primary Mobile No.*</label>
                        <input type="text" class="form-control" name="customer_mobile_no1" id="customer_mobile_no1" placeholder="Primary Mobile No.*" required>
                        <div id="customer_mobile_no1_error" style="display:none;">Primary Mobile No. cannot be blank.</div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label>Office Phone</label>
                        <input type="text" class="form-control" name="office_phone" id="office_phone" placeholder="Office Phone">
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label>Customer Mobile No2</label>
                        <input type="text" class="form-control" name="customer_mobile_no2" id="customer_mobile_no2" placeholder="Customer Mobile No2">
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label>Office Address </label>
                        <textarea class="form-control" name="office_addressline" id="office_addressline" rows="3" placeholder="Office Address "></textarea>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label>Location</label>
                        <select class="form-control" name="customer_city_location" id="customer_city_location" placeholder="Select Location (City)">
                          <option value="">Select Location (City)</option>
                          <?php foreach ($cities as $city) { ?>
                            <option value="<?= $city['id'] ?>"><?= $city['city_name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <input type="hidden" name="user_id" value="<?= $user->id ?? 0 ?>">

                    <div class="col-6 res_mt10">
                      <div class="form-group">
                        <button type="submit" class="btn btn-success mr10">Add </button>
                        <a class="btn btn-danger" data-dismiss="modal">Cancel</a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <!-- <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div> -->
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

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
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/select2/js/select2.full.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/moment/moment.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/toastr/toastr.min.js"></script>

  <script>
    if ("<?= isset($inward) ?>") {
      var newOption = new Option("<?= ($inward['company_name'] ?? '') ?>", "<?= ($inward['customer_id'] ?? '') ?>", true, true);
      $('#customer_id').append(newOption).trigger('change');
    }
    $("#customer_id").select2({
      theme: 'bootstrap4',
      minimumInputLength: 3,
      ajax: {
        url: '../../controllers/CustomerController.php',
        dataType: 'json',
        type: "POST",
        quietMillis: 50,
        data: function(term) {
          return {
            token: "<?= $_SESSION['token'] ?>",
            term: term
          };
        },
        processResults: function(data) {
          var arr = []
          $.each(data, function(index, value) {
            arr.push({
              id: value.id,
              company_name: value.company_name,
              customer_name: value.customer_name,
              customer_primary_email_id: value.customer_primary_email_id,
              customer_mobile_no1: value.customer_mobile_no1,
              text: value.company_name,
            })
          })
          return {
            results: arr
          };
        }
      },
      templateResult: formatResult
    });

    function formatResult(result) {
      return $.parseHTML('<h4>' + result.company_name + ' <small> (' + result.customer_name + ')</small></h4><p><b>E:</b>' + result.customer_primary_email_id + ' |  <b>M:</b> ' + result.customer_mobile_no1 + '</p>');
    }

    $('#deliver_through_courier').change(function() {
      if ($('#deliver_through_courier:checked').val() == 'on') {
        $('.courier_details').removeAttr('style');
      } else {
        $('.courier_details').attr('style', 'display: none;');
      }
    });

    var page_overlay = jQuery('<div id="overlay"> </div>');

    function showOverlay() {
      page_overlay.appendTo(document.body);
    }

    function hideOverlay() {
      page_overlay.remove();
    }
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

    $("#customer_form").submit(function(e) {
      e.preventDefault();
      var formData = $(this).serializeArray();
      $.ajax({
        type: "POST",
        url: "../../controllers/CustomerController.php",
        data: {
          formData: formData,
        },
        success: function(response) {
          location.reload(true);
        }
      });
    });

    function addInward(retry) {
      var device_size = $('#device_size2').val() + $('#device_size_unit').val();
      $('#device_size1').val(device_size)
      var validation = true;
      if ($('#customer_id').val() == "") {
        $('#customer_id_error').removeAttr('style').attr('style', "color:red;").html('Customer is required.');
        validation = false;
      } else {
        $('#customer_id_error').hide();
      }

      if ($.trim($('#device_serial_number').val()) == '') {
        $('#device_serial_number_error').removeAttr('style').attr('style', "color:red;").html('Device serial number is required.');
        validation = false;
      } else {
        $('#device_serial_number_error').hide();
      }
      if (!validation) {
        return false;
      }
      formData = $('#inward_form').serializeArray();
      $(showOverlay);
      $.ajax({
        url: '../../controllers/RegisterController.php',
        type: 'POST',
        data: {
          formData: formData,
          id: "<?= $_REQUEST['id'] ?? 0 ?>",
          type: "<?= $_REQUEST['type'] ?? 0 ?>"
        },
        success: function(response) {
          $(hideOverlay);
          if (retry == 1) {
            window.location.href = "<?= $_SESSION['url_path'] ?>/app/views/register/register.php" + "<?= isset($_REQUEST['type']) ? '?type=' . $_REQUEST['type'] : '' ?>";
          } else {
            location.reload(true);
          }
        },
      });
    }
  </script>

  <!-- <script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function($) {
      jQuery('#CaseRegister_customer_id').select2({
        'formatNoMatches': function() {
          return "No matches found";
        },
        'formatInputTooShort': function(input, min) {
          return "Please enter " + (min - input.length) + " more characters";
        },
        'formatInputTooLong': function(input, max) {
          return "Please enter " + (input.length - max) + " less characters";
        },
        'formatSelectionTooBig': function(limit) {
          return "You can only select " + limit + " items";
        },
        'formatLoadMore': function(pageNumber) {
          return "Loading more results...";
        },
        'formatSearching': function() {
          return "Searching...";
        },
        'placeholder': 'Search a Customer',
        'containerCssClass': '',
        'width': '100%',
        'minimumInputLength': 1,
        'ajax': {
          'url': '/office/customer/customer/ajaxCustomerData2',
          'dataType': 'json',
          'type': 'GET',
          'data': function(term, page) {
            return {
              q: term,
              page_limit: 10,
            };
          },
          'results': function(data, page) {
            return {
              results: data
            };
          }
        },
        'initSelection': function(element, callback) {
          // the input tag has a value attribute preloaded that points to a preselected repository id
          // this function resolves that id attribute to an object that select2 can render
          // using its formatResult renderer - that way the repository name is shown preselected
          var id = element.val();
          var text = element.data("option");
          data = {
            "id": id,
            "name": text,
            "customer_name": "",
            "customer_primary_email_id": "",
            "customer_mobile_no1": ""
          };
          callback(data);
        },
        'formatResult': function(data) {
          var markup = "<h4>" + data.name + " <small> (" + data.customer_name + ")</small></h4>";
          markup += "<p><b>E:</b>" + data.customer_primary_email_id + " |  <b>M:</b> " + data.customer_mobile_no1 + "</p>";
          return markup;
        },
        'formatSelection': function(data) {
          return data.name;
        }
      });
      jQuery('#yw1').selectmenu({
        'delay': '300',
        'width': '60px',
        'icons': {
          'button': 'caret'
        }
      });
      var id = yw1;

      function updateValue() {
        ddValue = $('#yw1').val();
        tbValue = $('#yw1_tb').val();
        $('#yw1_hf').val(tbValue + ddValue);
      }
      $('#yw1').on('selectmenuchange', function(event, ui) {
        updateValue();
      });
      $('#yw1_tb').change(function() {
        updateValue();
      });
      $('#CaseRegister_case_received_date').datetimepicker({
        'format': 'd-m-Y H:i',
        'allowTimes': ['00:00', '00:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30', '04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30']
      });
      // jQuery('#customer-form').yiiactiveform({
      //   'validateOnSubmit': true,
      //   'validateOnChange': true,
      //   'inputContainer': 'div.form-group',
      //   'errorCssClass': 'has-error',
      //   'successCssClass': 'has-success',
      //   'attributes': [{
      //     'id': 'CaseRegister_customer_id',
      //     'inputID': 'CaseRegister_customer_id',
      //     'errorID': 'customer_id_error',
      //     'model': 'CaseRegister',
      //     'name': 'customer_id',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) == '') {
      //         messages.push("Customer Id cannot be blank.");
      //       }


      //       if (jQuery.trim(value) != '') {

      //         if (!value.match(/^\s*[+-]?\d+\s*$/)) {
      //           messages.push("Customer Id must be an integer.");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_device_serial_number',
      //     'inputID': 'CaseRegister_device_serial_number',
      //     'errorID': 'CaseRegister_device_serial_number_em_',
      //     'model': 'CaseRegister',
      //     'name': 'device_serial_number',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) == '') {
      //         messages.push("Device Serial Number cannot be blank.");
      //       }


      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 30) {
      //           messages.push("Device Serial Number is too long (maximum is 30 characters).");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_device_internal_serial_number',
      //     'inputID': 'CaseRegister_device_internal_serial_number',
      //     'errorID': 'CaseRegister_device_internal_serial_number_em_',
      //     'model': 'CaseRegister',
      //     'name': 'device_internal_serial_number',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 20) {
      //           messages.push("Device Internal Serial Number is too long (maximum is 20 characters).");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_device_maker_id',
      //     'inputID': 'CaseRegister_device_maker_id',
      //     'errorID': 'CaseRegister_device_maker_id_em_',
      //     'model': 'CaseRegister',
      //     'name': 'device_maker_id',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) != '') {

      //         if (!value.match(/^\s*[+-]?\d+\s*$/)) {
      //           messages.push("Device Manufacturer must be an integer.");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_device_model',
      //     'inputID': 'CaseRegister_device_model',
      //     'errorID': 'CaseRegister_device_model_em_',
      //     'model': 'CaseRegister',
      //     'name': 'device_model',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 25) {
      //           messages.push("Device Model is too long (maximum is 25 characters).");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_device_type',
      //     'inputID': 'CaseRegister_device_type',
      //     'errorID': 'CaseRegister_device_type_em_',
      //     'model': 'CaseRegister',
      //     'name': 'device_type',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 50) {
      //           messages.push("Device Type is too long (maximum is 50 characters).");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_device_size',
      //     'inputID': 'CaseRegister_device_size',
      //     'errorID': 'CaseRegister_device_size_em_',
      //     'model': 'CaseRegister',
      //     'name': 'device_size',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 10) {
      //           messages.push("Device Size is too long (maximum is 10 characters).");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_crash_type',
      //     'inputID': 'CaseRegister_crash_type',
      //     'errorID': 'CaseRegister_crash_type_em_',
      //     'model': 'CaseRegister',
      //     'name': 'crash_type',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 10) {
      //           messages.push("Crash Type is too long (maximum is 10 characters).");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_device_firmware',
      //     'inputID': 'CaseRegister_device_firmware',
      //     'errorID': 'CaseRegister_device_firmware_em_',
      //     'model': 'CaseRegister',
      //     'name': 'device_firmware',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 15) {
      //           messages.push("Device Firmware is too long (maximum is 15 characters).");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_device_mlc',
      //     'inputID': 'CaseRegister_device_mlc',
      //     'errorID': 'CaseRegister_device_mlc_em_',
      //     'model': 'CaseRegister',
      //     'name': 'device_mlc',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 20) {
      //           messages.push("Device MLC is too long (maximum is 20 characters).");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_files_to_recover',
      //     'inputID': 'CaseRegister_files_to_recover',
      //     'errorID': 'CaseRegister_files_to_recover_em_',
      //     'model': 'CaseRegister',
      //     'name': 'files_to_recover',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 2048) {
      //           messages.push("Files To Recover is too long (maximum is 2048 characters).");
      //         }

      //       }


      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 512) {
      //           messages.push("Files To Recover is too long (maximum is 512 characters).");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_inward_remarks',
      //     'inputID': 'CaseRegister_inward_remarks',
      //     'errorID': 'CaseRegister_inward_remarks_em_',
      //     'model': 'CaseRegister',
      //     'name': 'inward_remarks',
      //     'enableAjaxValidation': false,
      //     'clientValidation': function(value, messages, attribute) {

      //       if (jQuery.trim(value) != '') {

      //         if (value.length > 2048) {
      //           messages.push("Inward Remarks is too long (maximum is 2048 characters).");
      //         }

      //       }

      //     },
      //     'summary': true
      //   }, {
      //     'id': 'CaseRegister_case_received_date',
      //     'inputID': 'CaseRegister_case_received_date',
      //     'errorID': 'CaseRegister_case_received_date_em_',
      //     'model': 'CaseRegister',
      //     'name': 'case_received_date',
      //     'enableAjaxValidation': false,
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }, {
      //     'summary': true
      //   }],
      //   'summaryID': 'customer-form_es_',
      //   'errorCss': 'error'
      // });

      $('.fancybox-link').fancybox({
        'type': 'ajax',
        'padding': '0',
        'scrolling': 'no',
        'maxWidth': '70%'
      });

      $(".alert-success, .alert-error").animate({
        opacity: 1.0
      }, 10000).fadeOut("slow");
    });
  </script> -->

  <script>
    $(function() {
      $("#case_received_date").datetimepicker("format", 'Y-M-D h:m:s');
      $("#case_received_date").datetimepicker("defaultDate", new Date());
      if ("<?= isset($inward) && $inward['case_received_date'] ?>")
        $("#case_received_date").datetimepicker("defaultDate", new Date("<?= $inward['case_received_date'] ?? '' ?>"));
    })
  </script>
</body>

</html>