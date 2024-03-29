<?php

include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

$_SESSION['page'] = 'register.php';

$model = (new Model());
$where = '';
$case_status = [0 => '', 1 => 'open', 2 => 'inprogress', 3 => 'processed', 4 => 'close'];

$type = '';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  if ((isset($_REQUEST["type"]) && ($_REQUEST["type"] == 'inward' || $_REQUEST["type"] == 'outward'))) {
    $type = $_REQUEST["type"];
    $where .= " case_register_state=" . ($_REQUEST['type'] == 'outward' ? 2 : ($_REQUEST['type'] == 'inward' ? 1 : 3));
  }
  if (isset($_REQUEST['case_status']) && !empty($_REQUEST['case_status'])) {
    $_REQUEST['case_status'] = array_search($_REQUEST['case_status'], $case_status);
    $where .= " case_status=" . $_REQUEST['case_status'];
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $flag = 1;
  foreach ($_POST as $key => $value) {
    if ($value != '') {
      if ($flag && (isset($_POST['start_date']) && $_POST['end_date'] != '') && (isset($_POST['end_date']) && $_POST['end_date'] != '')) {
        $flag = 0;
        $where .= (($where == '') ? '' : ' AND ') . " case_received_date >=  '" . $_POST['start_date'] . " 00:00:00' AND case_received_date <= '" . $_POST['end_date'] . " 23:59:59' ";
      } else if ($key != 'start_date' && $key != 'end_date') {
        if ($key == 'id') {
          $where .= (($where == '') ? '' : ' AND ') . " cr.$key like '%" . $value . "%' ";
        } else {
          $where .= (($where == '') ? '' : ' AND ') . " $key like '%" . $value . "%' ";
        }
      }
    }
  }
}

if (isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'SuperAdmin') {
  $where .= (($where == '') ? '' : ' AND ') . " c.customer_city_location= " . $_SESSION['user_city'];
}
$join = ' LEFT JOIN customer as c on c.id=cr.customer_id ';
// 'c.customer_city_location as customer_city_id',

$recordsPerPage = $_REQUEST['perpage'] ?? 10;
$currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
$totalCount = $model->select('case_register as cr', 'cr.*,c.company_name,c.customer_name, c.customer_city_location,COUNT(*) AS total', $where, $join)[0]['total'];
$totalPages = ceil($totalCount / $recordsPerPage);

$case_registers = $model->select('case_register as cr', 'cr.*,c.company_name,c.customer_name, c.customer_city_location', $where, $join, [], $recordsPerPage, (($currentPage * $recordsPerPage) - $recordsPerPage));
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
            <form id="send_estimate_form">
              <div class="modal-body">
                <div class="row">
                  <input type="hidden" name="inward_register_id" id="inward_register_id" value="">
                  <input type="hidden" name="customer_id" id="customer_id" value="">
                  <input type="hidden" name="type" id="type" value="<?= (isset($_REQUEST['type']) ? $_REQUEST['type'] : '') ?>">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Estimate Amount</label>
                      <input type="text" class="form-control" name="estimate_amount" id="estimate_amount" placeholder="Enter Amount">
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label>Estimation Details</label>
                      <textarea class="form-control" rows="3" name="customer_remarks" id="customer_remarks" placeholder="Enter Customer Update Details"></textarea>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label>Estimate Approved By Customer</label>
                      <select class="form-control" name="customer_estimate_status" id="customer_estimate_status">
                        <option value="0">Pending</option>
                        <option value="1">Approved</option>
                        <option value="2">Rejected</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-12 mb-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="send_email" id="send_email">
                      <label class="form-check-label" for="exampleCheck1">Send Email</label>
                    </div>
                  </div>

                  <div class="col-6">
                    <button type="button" class="btn btn-success mr10" onclick="sendEstimate();">Save</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal_send_data_tree">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Send Data Tree File</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="data_tree_form" enctype="multipart/form-data">
                <input type="hidden" name="inward_register_id" id="inward_register_id_data_tree" value="">
                <input type="hidden" name="type" id="type" value="<?= (isset($_REQUEST['type']) ? $_REQUEST['type'] : '') ?>">
                <input type="hidden" name="event_name" id="event_name" value="send_data_tree">
                <div class="row">
                  <div class="col-12 mb-3">
                    <div class="custom-file ">
                      <input type="file" class="form-control" name="dataTreeFile" id="dataTreeFile">
                    </div>
                  </div>

                  <div class="col-12 mb-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="case_result" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Is Data Recovered</label>
                    </div>
                  </div>

                  <div class="col-12 mb-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="send_email" id="send_email">
                      <label class="form-check-label" for="send_email">Send Email</label>
                    </div>
                  </div>

                  <div class="col-6">
                    <button type="button" class="btn btn-success mr10" onclick="sendDataTree();">Save</button>
                  </div>
                </div>
              </form>
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
            <form id="add_storage_detail_form">
              <div class="modal-body">
                <input type="hidden" name="inward_register_id_storage" id="inward_register_id_storage" value="">
                <input type="hidden" name="type" id="type" value="<?= (isset($_REQUEST['type']) ? $_REQUEST['type'] : '') ?>">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>HDD Numer</label>
                      <input type="text" name="sd_hddno" id="sd_hddno" class="form-control" placeholder="Enter Storage HDD Number">
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label>Storage Size</label>
                      <input type="text" name="sd_size" id="sd_size" class="form-control" placeholder="Enter Storage Data Size. i.e. 205GB">
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label>Storage Remarks</label>
                      <textarea class="form-control" name="sd_remarks" id="sd_remarks" rows="3" placeholder="Enter Remarks"></textarea>
                    </div>
                  </div>

                  <div class="col-12 mb-3">
                    <div class="form-check">
                      <input type="checkbox" name="case_result" id="case_result" class="form-check-input" id="DataRecovered">
                      <label class="form-check-label" for="exampleCheck1">Is Data Recovered</label>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <button type="button" class="btn btn-success mr10" onclick="addStorageDetail();">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal_move_to_outward">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Move to Outward</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="move_to_outward_form">
              <div class="modal-body">
                <input type="hidden" name="inward_register_id_outward" id="inward_register_id_outward" value="">
                <input type="hidden" name="type" id="type" value="<?= (isset($_REQUEST['type']) ? $_REQUEST['type'] : '') ?>">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Outward Note</label>
                      <textarea class="form-control" name="outward_remarks" id="outward_remarks" rows="3" placeholder="Outward Remarks"></textarea>
                    </div>
                  </div>

                  <div class="col-12 mb-3">
                    <div class="form-check">
                      <input type="checkbox" name="deliver_through_courier" id="deliver_through_courier" class="form-check-input">
                      <label class="form-check-label" for="deliver_through_courier">Deliver through courier</label>
                    </div>
                  </div>

                  <div class="col-12" id="courier_details" style="display: none;">
                    <div class="form-group">
                      <label>Courier Name</label>
                      <input type="text" class="form-control" name="courier_name" id="courier_name" placeholder="Courier Service Name">
                    </div>

                    <div class="form-group">
                      <label>Docket Number</label>
                      <input type="text" class="form-control" name="courier_dock_number" id="courier_dock_number" placeholder="Courier Docket Number">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <button type="button" class="btn btn-success mr10" onclick="moveToOutward();">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
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
                  <a type="button" class="btn btn-primary float-right" href="<?= $_SESSION['url_path'] ?>/app/views/register/create_inward.php<?= isset($_REQUEST['type']) ? '?type=' . $_REQUEST['type'] : '' ?>">Create Inward</a>
                </div>
                <form method="post" action="register.php<?= isset($_REQUEST['type']) ? '?type=' . $_REQUEST['type'] : '' ?>">
                  <div class="card-body res_col_form">
                    <div class="row">
                      <div class="col-2">
                        <select class="form-control" name="case_register_state" id="case_register_state" placeholder="All Register">
                          <option value="">All Register</option>
                          <option value="1" <?= (($_REQUEST['type'] ?? '') == 'inward') ? 'selected' : ''; ?>>Inward</option>
                          <option value="2" <?= (($_REQUEST['type'] ?? '') == 'outward') ? 'selected' : ''; ?>>Outward</option>
                        </select>
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="id" id="id" placeholder="Inward Id" value="<?= (isset($_POST) ? ($_POST['id'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="device_serial_number" id="device_serial_number" placeholder="Serial #" value="<?= (isset($_POST) ? ($_POST['device_serial_number'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="device_model" id="device_model" placeholder="Model No." value="<?= (isset($_POST) ? ($_POST['device_model'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name" value="<?= (isset($_POST) ? ($_POST['company_name'] ?? '') : '') ?>">
                      </div>
                      <div class="col-2">
                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name" value="<?= (isset($_POST) ? ($_POST['customer_name'] ?? '') : '') ?>">
                      </div>
                    </div>
                    <div class="row mt25px res_mt0">
                      <div class="col-2">
                        <div class="input-group date" id="start_date" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="start_date" id="start_date_input" data-target="#start_date" placeholder="Start Date">
                          <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                            <div class="input-group-text">
                              <i class="fa fa-calendar calendar_code"></i>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-2">
                        <div class="input-group date" id="end_date" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="end_date" id="end_date_input" data-target="#end_date" placeholder="End Date">
                          <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
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
                          <option value="1" <?= (isset($_REQUEST) && ($_REQUEST['case_status'] ?? '') == 1) ? 'selected' : ''; ?>>Open</option>
                          <option value="2" <?= (isset($_REQUEST) && ($_REQUEST['case_status'] ?? '') == 2) ? 'selected' : ''; ?>>Inprocess</option>
                          <option value="3" <?= (isset($_REQUEST) && ($_REQUEST['case_status'] ?? '') == 3) ? 'selected' : ''; ?>>Processed</option>
                          <option value="4" <?= (isset($_REQUEST) && ($_REQUEST['case_status'] ?? '') == 4) ? 'selected' : ''; ?>>Close</option>
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
                        <select class="form-control" name="customer_city_id" id="customer_city_id" placeholder="Select Location">
                          <option value="">Select Location</option>
                          <?php foreach ($cities as $city) { ?>
                            <option value="<?= $city['id'] ?>" <?= (isset($_POST) && ($_POST['customer_city_id'] ?? '') == $city['id']) ? 'selected' : ''; ?>><?= $city['city_name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>

                    </div>

                    <div class="row mt25px res_mt10">
                      <div class="col-1 max_width100">
                        <button type="submit" class="btn btn-primary wid100">Search </button>
                      </div>
                      <div class="col-1 max_width100">
                        <a class="btn btn-default wid100" href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php<?= (isset($_REQUEST['type']) ? '?type=' . $_REQUEST['type'] : '') ?>">Clear</a>
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
                        <th> <input type="checkbox" class="select-all"></th>
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
                      $counter = 0;
                      $case_register_state = [1 => 'Inward', 2 => 'Outward', 3 => 'Register'];
                      $case_register_state_color = [1 => 'success', 2 => 'danger', 3 => 'warning'];
                      $case_status = [0 => '', 1 => 'Open', 2 => 'In Progress', 3 => 'Processed', 4 => 'Close'];
                      $case_status_color = [0 => '', 1 => 'success', 2 => 'warning', 3 => 'info', 4 => 'danger'];
                      $estimate_status = [0 => 'Pending', 1 => 'Approved', 2 => 'Reject'];
                      $estimate_status_color = [0 => 'warning', 1 => 'success', 2 => 'danger'];
                      $recovery_status = [0 => 'Not Recovered', 1 => 'Recovered'];
                      $recovery_status_color = [0 => 'secondary', 1 => 'success'];
                      if (isset($case_registers) && $case_registers != '')
                        foreach ($case_registers as $case_register) { ?>
                        <tr id="register_tr_no_filter">
                          <td>
                            <input type="checkbox" name="id[]" id="id_<?= $counter++; ?>" value="<?= $case_register['id'] ?>">
                          </td>
                          <td><?= $case_register['id'] ?></td>
                          <td>
                            <?= $case_register['device_serial_number'] ?><small class="badge badge-<?= $case_register_state_color[$case_register['case_register_state']] ?> float-right"><?= $case_register_state[$case_register['case_register_state']] ?></small>
                          </td>
                          <td><?= $case_register['company_name'] ?></td>
                          <td>
                            <small class="badge badge-<?= $case_status_color[$case_register['case_status']] ?>"><?= $case_status[$case_register['case_status']] ?></small>
                          </td>
                          <td>
                            <small class="badge badge-<?= ($recovery_status_color[$case_register['case_result']]) ?>"><?= ($recovery_status[$case_register['case_result']]) ?></small>
                          </td>
                          <td>
                            <small class="badge badge-<?= ($estimate_status_color[$case_register['estimate_approved_by_customer']]) ?>"><?= ($estimate_status[$case_register['estimate_approved_by_customer']]) ?></small>
                          </td>
                          <td>
                            <?= date('d M, Y h:m a', strtotime(($case_register['case_received_date'] != '0000-00-00 00:00:00' ? $case_register['case_received_date'] : ''))) ?>
                          </td>
                          <td>
                            <div class="input-group-prepend">
                              <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                              <ul class="dropdown-menu">
                                <?php if ($case_register_state[$case_register['case_register_state']] !== 'Outward') { ?>
                                  <li class="dropdown-item">
                                    <a href="see_details.php<?= (isset($_REQUEST['type'])) ? '?type=' . $_REQUEST['type'] . '&' : '?' ?>id=<?= $case_register['id'] ?>"><i class='fa fa-search mr5'></i> See Details</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a href="create_inward.php<?= (isset($_REQUEST['type'])) ? '?type=' . $_REQUEST['type'] . '&' : '?' ?>id=<?= $case_register['id'] ?>"><i class="fa fa-pencil mr5"></i> Edit</a>
                                  </li>
                                  <li class="dropdown-divider"></li>
                                  <li class="dropdown-item">
                                    <a href="#" onclick='sendEstimateModal("<?= $case_register["id"] ?>","<?= $case_register["customer_id"] ?>","<?= $case_register["estimate_amount"] ?>",<?= json_encode($case_register["customer_remarks"]) ?>,"<?= $case_register["estimate_approved_by_customer"] ?>")' style="pointer:cursor"><i class='fa fa-inr mr5'></i> Send Estimate</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a href="#" onclick='addStorageDetailModal("<?= $case_register["id"] ?>","<?= $case_register["sd_hddno"] ?>","<?= $case_register["sd_size"] ?>",<?= json_encode($case_register["sd_remarks"]) ?>,"<?= $case_register["case_result"] ?>")'><i class='fa fa-cog mr5'></i> Add Storage Detail</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a href="#" onclick="sendDataTreeModal('<?= $case_register['id'] ?>')"><i class='fa fa-cog mr5'></i> Send Data Tree</a>
                                  </li>
                                  <li class="dropdown-divider"></li>
                                  <li class="dropdown-item">
                                    <a href="javascript:void(0);" onclick="javascript:window.open('print_inward.php?id=<?= $case_register['id'] ?>&customer_id=<?= $case_register['customer_id'] ?>&city_id=<?= $case_register['customer_city_location'] ?>', '_Details', 'width=750, height=500, scrollbars=1, resizable=1');" style="pointer:cursor"><i class='fa fa-print mr5'></i> Print</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a href="#" onclick="moveToOutwardModal(<?= $case_register['id'] ?>)"><i class='fa fa-sign-out mr5'></i> Move to Outward</a>
                                  </li>
                                <?php } else { ?>
                                  <li class="dropdown-item">
                                    <a href="see_details.php<?= (isset($_REQUEST['type'])) ? '?type=' . $_REQUEST['type'] . '&' : '?' ?>id=<?= $case_register['id'] ?>"><i class='fa fa-search mr5'></i> See Details</a>
                                  </li>
                                <?php } ?>
                              </ul>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                  <div class="row">
                    <div class="col-6">
                      View <select id="pageSize">
                        <option value="10" <?= ($recordsPerPage == 10) ? 'selected' : '' ?>>10</option>
                        <option value="20" <?= ($recordsPerPage == 20) ? 'selected' : '' ?>>20</option>
                        <option value="50" <?= ($recordsPerPage == 50) ? 'selected' : '' ?>>50</option>
                        <option value="100" <?= ($recordsPerPage == 100) ? 'selected' : '' ?>>100</option>
                        <option value="<?= $totalCount ?>" <?= ($recordsPerPage == $totalCount) ? 'selected' : '' ?>>All</option>
                      </select> Per Page
                    </div>
                    <div class="col-6">
                      <div class="paginator float-right">
                        <ul class="pagination mb-1">
                          <li class="paginate_button page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                            <a href="<?= '?page=' . ($currentPage - 1) . (isset($_REQUEST['perpage']) ? '&perpage=' . $_REQUEST['perpage'] : '') ?>" class="page-link">
                              Previous
                            </a>
                          </li>
                          <?php if ($totalPages < 11) {
                            for ($i = 1; $i <= $totalPages; $i++) {
                          ?>
                              <li class="paginate_button page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                <a href="<?= '?page=' . $i . (isset($_REQUEST['perpage']) ? '&perpage=' . $_REQUEST['perpage'] : '') ?>" class="page-link">
                                  <?= $i ?>
                                </a>
                              </li>
                              <?php }
                          } else {
                            for ($i = 1; $i < $totalPages; $i++) {
                              if ($i >= ($currentPage - 3) && $i < $currentPage) {
                              ?>
                                <li class="paginate_button page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                  <a href="<?= '?page=' . $i . (isset($_REQUEST['perpage']) ? '&perpage=' . $_REQUEST['perpage'] : '') ?>" class="page-link">
                                    <?= $i ?>
                                  </a>
                                </li>
                            <?php }
                            }
                            ?>
                            <li class="paginate_button page-item active">
                              <a href="<?= '?page=' . $currentPage . (isset($_REQUEST['perpage']) ? '&perpage=' . $_REQUEST['perpage'] : '') ?>" class="page-link">
                                <?= $currentPage ?>
                              </a>
                            </li>
                            <?php for ($i = 1; $i < $totalPages; $i++) {
                              if ($i <= ($currentPage + 3) && $i > $currentPage) { ?>
                                <li class="paginate_button page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                  <a href="<?= '?page=' . $i . (isset($_REQUEST['perpage']) ? '&perpage=' . $_REQUEST['perpage'] : '') ?>" class="page-link">
                                    <?= $i ?>
                                  </a>
                                </li>
                          <?php
                              }
                            }
                          } ?>
                          <li class="paginate_button page-item <?= ($currentPage == $totalPages) ? 'disabled' : '' ?>">
                            <a href="<?= '?page=' . ($currentPage + 1) . (isset($_REQUEST['perpage']) ? '&perpage=' . $_REQUEST['perpage'] : '') ?>" class="page-link">
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

            <div class="col-12">
              <div class="col-12">
                <button id="delete_button" class="btn btn-danger float-left mb35 res_mb25">Delete All</button>
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

      <a id="back-to-top" href="javascript:void(0)" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top"><i class="fas fa-chevron-up"></i></a>
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
    
    var page_overlay = jQuery('<div id="overlay"> </div>');

    function showOverlay() {
      $('body').attr('id', 'overlay');
    }

    function hideOverlay() {
      $('body').removeAttr('id');
    }
    
    $('#pageSize').change(function() {
      var perpage = $(this).val();
      if (window.location.href.split("?").length > 1) {
        if (window.location.href.split("?")[1].search('perpage') == -1) {
          window.location.href = window.location.href + '&perpage=' + perpage;
        } else {
          var url = window.location.href.split("?")[0] + '?';
          $.each(window.location.href.split("?")[1].split("&"), function(key, val) {
            if (val.search('perpage') == -1) {
              (key == 0) ? (url += val) : (url += '&' + val);
            } else {
              (key == 0) ? (url += 'perpage=' + perpage) : (url += '&perpage=' + perpage);
            }
          })
          window.location.href = url;
        }
      } else {
        window.location.href = window.location.href + '?perpage=' + perpage;
      }
    });

    function sendEstimateModal(inward_register_id, customer_id, estimate_amount, customer_remarks, approval_status) {
      $('#customer_id').val(customer_id);
      $('#inward_register_id').val(inward_register_id);
      $('#estimate_amount').val(estimate_amount);
      $('#customer_remarks').val(customer_remarks);
      $('#customer_estimate_status option[value="' + approval_status + '"]').prop('selected', true);
      $('#modal_send_estimate').modal();
    }

    function addStorageDetailModal(inward_register_id, sd_hddno, sd_size, sd_remarks, recovery_status) {
      $('#inward_register_id_storage').val(inward_register_id);
      $('#sd_hddno').val(sd_hddno);
      $('#sd_size').val(sd_size);
      $('#sd_remarks').val(sd_remarks);

      if (recovery_status == 0) {
        $('#case_result').removeAttr('checked');
      } else {
        $('#case_result').attr('checked', 'true');
      }
      $('#modal_add_storage_details').modal();
    }

    $('#deliver_through_courier').change(function() {
      if ($('#deliver_through_courier:checked').val() == 'on') {
        $('#courier_details').removeAttr('style');
      } else {
        $('#courier_details').attr('style', 'display: none;');
      }
    });

    $('.select-all').click(function() {
      if ($('.select-all:checked')[0]) {
        $('input[name="id[]"]').attr('checked', true);
      } else {
        $('input[name="id[]"]').attr('checked', false);
      }
    });
    $('#delete_button').click(function(e) {
      var total = $('input[name="id[]"]:checked').length;
      var delete_ids = $("input[name='id[]:checked:checked']").map(function() {
        return $(this).val();
      }).get();

      var atLeastOneIsChecked = total > 0;
      if (!atLeastOneIsChecked) {
        alert('Please select atleast one case.');
      } else {
        // $.ajax({
        //   type: "POST",
        //   url: "../../controllers/RegisterController.php",
        //   data: {
        //     delete_id: delete_id,
        //   },
        //   success: function(response) {
        //     location.reload(true);
        //   }
        // });
      }
    });

    function moveToOutwardModal(inward_register_id) {
      $('#inward_register_id_outward').val(inward_register_id);
      $('#modal_move_to_outward').modal();
    }

    function sendDataTreeModal(inward_register_id) {
      $('#inward_register_id_data_tree').val(inward_register_id);
      $('#modal_send_data_tree').modal();
    }

    $("input[type='file']").on("change", function() {
      if (this.files[0].size > 15728640) {
        alert("Please upload file less than 15MB. Thanks!!");
        $(this).val('');
      }
    });

    function sendDataTree() {
      $(showOverlay);
      var formData = new FormData($('#data_tree_form')[0]);

      $.ajax({
        url: '../../controllers/EmailController.php', // PHP script to handle the file upload
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          $(hideOverlay);
          window.location.href = "<?= $_SESSION['url_path'] ?>/app/views/register/register.php" + "<?= isset($_REQUEST['type']) ? '?type=' . $_REQUEST['type'] : '' ?>";
        }
      });
    }

    function sendEstimate() {
      formData = $('#send_estimate_form').serializeArray();
      var case_status = 0;
      if ($('#customer_estimate_status').val() == '1') {
        case_status = 1;
      }
      $(showOverlay);
      $.ajax({
        url: '../../controllers/EmailController.php',
        type: 'POST',
        data: {
          formData: formData,
          event_name: 'send_estimate',
          send_email: $('input[name="send_email"]:checked').val(),
          customer_id: $('#customer_id').val(),
          inward_register_id: $('#inward_register_id').val(),
          case_status: case_status
        },
        success: function(response) {
          $(hideOverlay);
          window.location.href = "<?= $_SESSION['url_path'] ?>/app/views/register/register.php" + "<?= isset($_REQUEST['type']) ? '?type=' . $_REQUEST['type'] : '' ?>";
        },
      });
    }

    function addStorageDetail() {
      formData = $('#add_storage_detail_form').serializeArray();
      $(showOverlay);
      $.ajax({
        url: '../../controllers/RegisterController.php',
        type: 'POST',
        data: {
          formData: formData,
          event_name: 'add_storage_detail',
          inward_register_id: $('#inward_register_id_storage').val()
        },
        success: function(response) {
          $(hideOverlay);
          window.location.href = "<?= $_SESSION['url_path'] ?>/app/views/register/register.php" + "<?= isset($_REQUEST['type']) ? '?type=' . $_REQUEST['type'] : '' ?>";
        },
      });
    }

    function moveToOutward() {
      formData = $('#move_to_outward_form').serializeArray();
      $(showOverlay);
      $.ajax({
        url: '../../controllers/EmailController.php',
        type: 'POST',
        data: {
          formData: formData,
          inward_register_id: $('#inward_register_id_outward').val(),
          event_name: 'move_to_outward'
        },
        success: function(response) {
          $(hideOverlay);
          window.location.href = "<?= $_SESSION['url_path'] ?>/app/views/register/register.php" + "<?= isset($_REQUEST['type']) ? '?type=' . $_REQUEST['type'] : '' ?>";
        },
      });
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

    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "bPaginate": false,
        "info": false,
        "buttons": "<?= (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'SuperAdmin') ?>" ? ["copy", "csv", "excel", "pdf", "print", "colvis"] : []
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $(function() {
      $("#start_date").datetimepicker("format", 'Y-MM-DD');
      $("#end_date").datetimepicker("format", 'Y-MM-DD');
      if ("<?= isset($_POST) && ($_POST['start_date'] ?? '') ?>") {
        $("#start_date").datetimepicker("defaultDate", new Date("<?= $_POST['start_date'] ?? '' ?>"));
      }
      if ("<?= isset($_POST) && ($_POST['end_date'] ?? '') ?>") {
        $("#end_date").datetimepicker("defaultDate", new Date("<?= $_POST['end_date'] ?? '' ?>"));
      }
    });
  </script>
</body>

</html>