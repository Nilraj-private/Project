<?php

include('../template/head.php');
require("../../models/model.php");

use app\models\Model;

$_SESSION['page'] = 'register.php' . (isset($_GET['type']) ? '?type=' . $_GET['type'] : '');

$model = (new Model());
$customers = $model->select("customer");
$manufacturers = $model->select("device_manufacturer");
$cities = $model->select("city_location");
$action_history = $model->select("action_history", '*', ' case_register_id=' . $_GET['id']);

if (isset($_GET['id'])) {
  $join = ' LEFT JOIN customer as c on c.id=cr.customer_id LEFT JOIN device_manufacturer as m on m.id=cr.device_maker_id LEFT JOIN city_location cl on cl.id=c.customer_city_location ';
  $register = $model->select('case_register as cr', 'cr.*,c.company_name,c.customer_name,c.customer_primary_email_id,c.customer_mobile_no1,c.customer_mobile_no2,c.office_phone, c.office_addressline, c.customer_city_location, m.manufacturer_name, cl.city_name', ' cr.id=' . $_GET['id'], $join)[0];
}

$case_register_state = [1 => 'Inward', 2 => 'Outward', 3 => 'Register'];
$case_register_state_color = [1 => 'success', 2 => 'danger', 3 => 'warning'];
$case_status = [0 => '', 1 => 'Open', 2 => 'In Progress', 3 => 'Processed', 4 => 'Close'];
$case_status_color = [0 => '', 1 => 'success', 2 => 'warning', 3 => 'info', 4 => 'danger'];
$estimate_status = [0 => 'Pending', 1 => 'Approved', 2 => 'Reject'];
$estimate_status_color = [0 => 'warning', 1 => 'success', 2 => 'danger'];
$recovery_status = [0 => 'Not Recovered', 1 => 'Recovered'];
$recovery_status_color = [0 => 'secondary', 1 => 'success'];
?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include('../template/header.php') ?>

    <!-- Main Sidebar Container -->
    <?php include('../template/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <section class="content-header mob_view">
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
            <div class="col-sm-6 pc_view">
              <div class="date_strip no_strip">
                <h1><?= date('M d, Y') ?></h1>
                <p><?= date('H:i:s A') ?></p>
              </div>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php">Home</a></li>
                <li class="breadcrumb-item "><a href="register.php?type=inward"> Register</a> </li>
                <li class="breadcrumb-item active"> Inward</li>
                <li class="breadcrumb-item active"> Details #<?= $register['id'] ?></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- modal -->
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
                  <div class="col-12">
                    <div class="form-group">
                      <label>Estimate Amount</label>
                      <input type="text" class="form-control" name="estimate_amount" id="estimate_amount" placeholder="Enter Amount">
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label>Estimation Details</label>
                      <textarea class="form-control" rows="3" name="customer_details" id="customer_details" placeholder="Enter Customer Update Details"></textarea>
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
                <input type="hidden" name="type" id="type" value="">
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
                      <button type="button" class="btn btn-success mr10" onclick="moveToOwtward();">Save</button>
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
              <div class="row res_flex_column">
                <div class="col-md-8 max_width100">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="float-left">Inward Details (#<?= $register['id'] ?>)</h4>
                      <div class="float-right">
                        <a type="button" href="register.php?type=inward" class="btn btn-primary "><i class="fa fa-angle-left"></i> Back</a>
                        <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                        <ul class="dropdown-menu">
                          <li class="dropdown-item">
                            <a href="create_inward.php?id=<?= $register['id'] ?>"><i class="fa fa-pencil mr5"></i> Edit</a>
                          </li>
                          <li class="dropdown-divider"></li>
                          <li class="dropdown-item">
                            <a href="#" onclick="sendEstimateModal('<?= $register['id'] ?>','<?= $register['customer_id'] ?>','<?= $register['estimate_amount'] ?>','<?= $register['customer_remarks'] ?>','<?= $register['estimate_approved_by_customer'] ?>')" style="pointer:cursor"><i class='fa fa-inr mr5'></i> Send Estimate</a>
                          </li>
                          <li class="dropdown-item">
                            <a href="#" onclick="addStorageDetailModal('<?= $register['id'] ?>','<?= $register['sd_hddno'] ?>','<?= $register['sd_size'] ?>','<?= $register['sd_remarks'] ?>','<?= $register['case_result'] ?>')"><i class='fa fa-cog mr5'></i> Add Storage Detail</a>
                          </li>
                          <!-- <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#modal-send-datatree"><i class='fa fa-cog mr5'></i> Send Data Tree</a></li> -->
                          <li class="dropdown-divider"></li>
                          <li class="dropdown-item">
                            <a href="#" onclick="moveToOwtwardModal(<?= $register['id'] ?>)"><i class='fa fa-sign-out mr5'></i> Move to Outward</a>
                          </li>
                          <!-- <li class="dropdown-divider"></li> -->
                          <li class="dropdown-item">
                            <a href="javascript:void(0);" onclick="javascript:window.open('print_inward.php?id=<?= $register['id'] ?>&customer_id=<?= $register['customer_id'] ?>&city_id=<?= $register['customer_city_location'] ?>', '_Details', 'width=750, height=500, scrollbars=1, resizable=1');" style="pointer:cursor"><i class='fa fa-print mr5'></i> Print</a>

                          </li>
                        </ul>
                      </div>
                    </div>

                    <div class="card-body per_details" style="margin:2px">
                      <p><span>Serial No</span> <span class="span_dot">:</span> <?= $register['device_serial_number'] ?></p>
                      <p><span>Internal SR#</span> <span class="span_dot">:</span><?= $register['device_internal_serial_number'] ?></p>
                      <p><span>Device Mfg</span> <span class="span_dot">:</span> <?= $register['manufacturer_name'] ?></p>
                      <p><span>Device Model</span> <span class="span_dot">:</span><?= $register['device_model'] ?></p>
                      <p><span>Device Type</span> <span class="span_dot">:</span><?= $register['device_type'] ?></p>
                      <p><span>Device Size</span> <span class="span_dot">:</span><?= $register['device_size'] ?></p>
                      <p><span>Device Firmware</span> <span class="span_dot">:</span><?= $register['device_firmware'] ?></p>
                      <p><span>Device MLC</span> <span class="span_dot">:</span><?= $register['device_mlc'] ?></p>
                      <p><span class="res_tl">Files and Directories to be Recovered </span> <span class="span_dot">:</span> <b class="res_width50 res_tl"><?= $register['files_to_recover'] ?></b></p>
                    </div>
                  </div>

                  <div class="mt30">
                    <div class="col-md-12 padding0">
                      <div class="card card-success">
                        <div class="card-header see_bg">
                          <h3 class="card-title res_width90">Storage Details (This Will Be Remove After Few Days.)</h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                          </div>
                        </div>

                        <div class="card-body">
                          <?php if ($register['sd_hddno'] == NULL) { ?>
                            <div class="card card-outline card-danger">
                              <div class="card-header">
                                <p class="box_txt">Data Storage Details not found!</p>
                              </div>
                            </div>
                          <?php } else { ?>
                            <p><span><b>HDD Number</b></span> <span class="span_dot">:</span> <?= $register['sd_hddno'] ?>
                              <br><span><b>Storage Size</b></span> <span class="span_dot">:</span> <?= $register['sd_size'] ?>
                              <br><span><b>Storage Remarks</b></span> <span class="span_dot">:</span> <?= $register['sd_remarks'] ?>
                            </p>
                          <?php } ?>

                          <div class="flex_center">
                            <button type="button" class="btn btn-primary mr10" onclick="addStorageDetailModal('<?= $register['id'] ?>','<?= $register['sd_hddno'] ?>','<?= $register['sd_size'] ?>','<?= $register['sd_remarks'] ?>','<?= $register['case_result'] ?>')" title="Update Storage Details"> Update Storage Details</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="mt30">
                    <div class="col-md-12 padding0">
                      <div class="card card-success">
                        <div class="card-header see_bg">
                          <h3 class="card-title">Action History</h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                          </div>
                        </div>

                        <div class="card-body">
                          <?php
                          if (gettype($action_history) == 'boolean') {
                          ?>
                            <div class="card card-outline card-danger">
                              <div class="card-header">
                                <p class="box_txt">There is no action taken on Device, Record Action for Device.
                                </p>
                              </div>
                            </div>
                            <?php } else {
                            foreach ($action_history as $each) { ?>
                              <p>
                                <b class="mr10"><?= $each['action_title'] ?></b>
                                <span class="badge badge-secondary width65 mr5"><?= $each['visibility_type'] ?> </span>
                                <br>
                                <?= $each['action_description'] ?>
                              </p>
                              <div class="space_betwwen">
                                <span class="gray_color "><i class="fa fa-clock-o"></i> <?= date('d M, Y h:m a ', strtotime($each['action_dt'])) ?></span>
                                <button type="button" onclick="deleteActionHistory(<?= $each['id'] ?>)" class="btn btn-danger  "><i class='fa fa-trash-o'></i> Delete</button>
                              </div>
                              <hr>
                          <?php }
                          } ?>
                          <div class="col-md-12 mt30 padding0">
                            <div class="card card-success">
                              <div class="card-header see_bg">
                                <h3 class="card-title">Add Action History</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool bdr_none" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <form id="add_sction_history_form">
                                <div class="card-body res_col_form">
                                  <div class="row res_mb20">
                                    <input type="hidden" name="case_register_id" id="case_register_id" value="<?= $_GET['id'] ?? 0 ?>">
                                    <input type="hidden" name="visibility_type" id="visibility_type" value="PRIVATE">
                                    <div class="col-4">
                                      <input type="text" name="action_title" id="action_title" class="form-control" placeholder="Action Title" required>
                                      <div class="errorMessage" id="action_title_error" style="display:none"></div>
                                    </div>
                                    <div class="col-4">
                                      <div class="input-group date" id="action_dt" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="action_dt" id="action_dt_input" data-target="#action_dt" placeholder="Action Date">
                                        <div class="input-group-append" data-target="#action_dt" data-toggle="datetimepicker">
                                          <div class="input-group-text">
                                            <i class="fa fa-calendar calendar_code"></i>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- <div class="col-4">
                                    <select class="form-control" placeholder="Visibility Type">
                                      <option value="">Visibility Type</option>
                                      <option value="PUBLIC">Public</option>
                                      <option value="PRIVATE">Private</option>
                                    </select>
                                  </div> -->

                                    <div class="col-12 mt25px res_mt0"><textarea class="form-control" name="action_description" id="action_description" rows="3" placeholder="Action Description"></textarea></div>
                                  </div>

                                  <div class="row mt25px res_mt10">
                                    <div class="col-2 new_col"><button type="button" class="btn btn-primary" onclick="addActionHistory()">Save </button> </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 res_padding0 res_mt15 res_mb30 max_width100">
                  <div class="col-md-12 mb-4">
                    <div class="card card-success">
                      <div class="card-header see_bg">
                        <h3 class="card-title">Customer Details</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>

                      <div class="card-body">
                        <h4><?= $register['company_name'] ?></h4>
                        <p class="mb0">
                          <i class="fa fa-user mr8"></i><?= $register['customer_name']; ?><br>
                          <i class="fa fa-envelope fs14 mr8"></i><?= $register['customer_primary_email_id'] ?><br>
                          <i class="fa fa-mobile mr8"></i><?= $register['customer_mobile_no1'] ?><br>
                          <?php if ($register['customer_mobile_no2'] != '') { ?>
                            <i class="fa fa-mobile mr8"></i><?= $register['customer_mobile_no2'] ?><br>
                          <?php } ?>
                          <?php if ($register['office_phone'] != '') { ?>
                            <i class="fa fa-phone mr8"></i><?= $register['office_phone'] ?><br>
                          <?php } ?>
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 mb-4 res_mt5">
                    <div class="card card-success">
                      <div class="card-header see_bg">
                        <h3 class="card-title">Customer Address
                        </h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>

                      <div class="card-body">
                        <p>
                          <b class="mr8">Location :</b><?= $register['city_name'] ?>
                          <br>
                          <b class="mr8">Office Address :</b><?= $register['office_addressline'] ?>
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 mb-4 res_mt5">
                    <div class="card card-success">
                      <div class="card-header see_bg">
                        <h3 class="card-title">Estimation Details</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <?php if ($register['estimate_amount'] != '') { ?>
                          <p><strong>Estimate Amount</strong> <?= $register['estimate_amount'] ?></p>
                          <p><strong>Estimate Status</strong>
                            <span class="badge badge-<?= $estimate_status_color[$register['case_result']] ?>"><?= $estimate_status[$register['case_result']] ?></span>
                          </p>
                          <p><strong>Estimation Details</strong><br><?= $register['customer_remarks'] ?></p>
                        <?php } else { ?>
                          <div class="card card-outline card-danger">
                            <div class="card-header">
                              <p class="box_txt">Still Estimation Process is Pending, Plz Send Estimate Now</p>
                            </div>
                          </div>
                        <?php } ?>
                        <div class="flex_center">
                          <button type="button" class="btn btn-primary mr10" onclick="sendEstimateModal('<?= $register['id'] ?>','<?= $register['customer_id'] ?>','<?= $register['estimate_amount'] ?>','<?= $register['customer_remarks'] ?>','<?= $register['estimate_approved_by_customer'] ?>')" title="Send Estimate"> Send Estimate</button>
                          <!-- <button type="button" class="btn btn-primary " title="Send Data Tree"><i class='fa fa-file'></i> Send File</button> -->
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 res_mb5">
                    <div class="card card-success">
                      <div class="card-header see_bg">
                        <h3 class="card-title">Device Details</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>

                      <div class="card-body device_info">
                        <p><span>Device Received on</span><?= date('d M, Y h:m a  ', strtotime($register['case_received_date'])) ?>
                          <hr>
                          <span>Device Returned on</span><?= date('d M, Y h:m a  ', strtotime($register['case_return_date'])) ?>
                          <hr>
                          <span>Device Status</span> <span class="badge badge-<?= $case_status_color[$register['case_status']] ?> width100px"><?= $case_status[$register['case_status']] ?></span>
                          <hr>
                          <span>Device State</span> <span class="badge badge-<?= $case_register_state_color[$register['case_register_state']] ?> width100px"><?= $case_register_state[$register['case_register_state']] ?></span>
                          <hr>
                          <span>Data Recovery Status</span> <span class="badge badge-<?= $recovery_status_color[$register['case_result']] ?> width100px"><?= $recovery_status[$register['case_result']] ?></span>
                        </p>
                      </div>
                    </div>
                  </div>
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
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/js/adminlte.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/js/demo.js"></script>
  <!-- Page specific script -->

  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/moment/moment.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/plugins/toastr/toastr.min.js"></script>

  <script>
    $(document).ready(function() {
      if ("<?= isset($_SESSION['success_message']) ? 1 : 0 ?>" == 1) {
        toastr.success("<?= $_SESSION['success_message'] ?? '' ?>")
        var unnset = "<?php unset($_SESSION['success_message']); ?>"
      } else if ("<?= isset($_SESSION['error_message']) ? 1 : 0 ?>" == 1) {
        toastr.error("<?= $_SESSION['error_message'] ?? '' ?>")
        var unnset = "<?php unset($_SESSION['error_message']); ?>"
      }
    })

    $('#deliver_through_courier').change(function() {
      if ($('#deliver_through_courier:checked').val() == 'on') {
        $('#courier_details').removeAttr('style');
      } else {
        $('#courier_details').attr('style', 'display: none;');
      }
    });

    function moveToOwtwardModal(inward_register_id) {
      $('#inward_register_id_outward').val(inward_register_id);
      $('#modal_move_to_outward').modal();
    }

    function sendEstimateModal(inward_register_id, customer_id, estimate_amount, customer_details, approval_status) {
      $('#customer_id').val(customer_id);
      $('#inward_register_id').val(inward_register_id);
      $('#estimate_amount').val(estimate_amount);
      $('#customer_details').val(customer_details);
      $('#customer_estimate_status option[value="' + approval_status + '"]').prop('selected', true);
      $('#modal_send_estimate').modal();
    }

    function sendEstimate() {
      formData = $('#send_estimate_form').serializeArray();
      $.ajax({
        url: '../../controllers/EmailController.php',
        type: 'POST',
        data: {
          formData: formData,
          event_name: 'send_estimate',
          send_email: $('input[name="send_email"]:checked').val(),
          customer_id: $('#customer_id').val(),
          inward_register_id: $('#inward_register_id').val()
        },
        success: function(response) {
          window.location.href = "<?= $_SESSION['url_path'] ?>/app/views/register/see_details.php" + "<?= isset($_GET['id']) ? '?id=' . $_GET['id'] : '' ?>";
        },
      });
    }

    function addStorageDetailModal(inward_register_id, sd_hddno, sd_size, sd_remarks, recovery_status) {
      $('#inward_register_id_storage').val(inward_register_id);
      $('#sd_hddno').val(sd_hddno);
      $('#sd_size').val(sd_size);
      $('#sd_remarks').val(sd_remarks);
      console.log((recovery_status == 0) ? 'false' : 'true');
      if (recovery_status == 0) {
        $('#case_result').removeAttr('checked');
      } else {
        $('#case_result').attr('checked', 'true');
      }
      $('#modal_add_storage_details').modal();
    }

    function moveToOwtward() {
      formData = $('#move_to_outward_form').serializeArray();
      $.ajax({
        url: '../../controllers/EmailController.php',
        type: 'POST',
        data: {
          formData: formData,
          inward_register_id: $('#inward_register_id_outward').val(),
          event_name: 'move_to_owtward'
        },
        success: function(response) {
          location.reload(true);
        },
      });
    }

    function addStorageDetail() {
      formData = $('#add_storage_detail_form').serializeArray();
      $.ajax({
        url: '../../controllers/RegisterController.php',
        type: 'POST',
        data: {
          formData: formData,
          event_name: 'add_storage_detail',
          inward_register_id: $('#inward_register_id').val()
        },
        success: function(response) {
          window.location.href = "<?= $_SESSION['url_path'] ?>/app/views/register/see_details.php" + "<?= isset($_GET['id']) ? '?id=' . $_GET['id'] : '' ?>";
        },
      });
    }

    function addActionHistory() {
      if ($('#action_title').val() == "") {
        $('#action_title_error').removeAttr('style').attr('style', "color:red;").html('Action title is required.');
        return false;
      } else {
        $('#action_title_error').hide();
      }

      formData = $('#add_sction_history_form').serializeArray();
      $.ajax({
        url: '../../controllers/RegisterController.php',
        type: 'POST',
        data: {
          formData: formData,
          event_name: 'add_action_history',
        },
        success: function(response) {
          window.location.href = "<?= $_SESSION['url_path'] ?>/app/views/register/see_details.php" + "<?= isset($_GET['id']) ? '?id=' . $_GET['id'] : '' ?>";
        },
      });
    }

    function deleteActionHistory(delete_id) {
      if (confirm('Are you sure you want to delete?'))
        $.ajax({
          type: "POST",
          url: "../../controllers/RegisterController.php",
          data: {
            table_name: 'action_history',
            delete_id: delete_id
          },
          success: function(response) {
            location.reload(true);
          }
        });
    }
    $(function() {
      $("#action_dt").datetimepicker("format", 'Y-MM-DD hh:mm:ss a');
      if ("<?= isset($_POST) && ($_POST['action_dt'] ?? '') ?>") {
        $("#action_dt").datetimepicker("defaultDate", new Date("<?= $_POST['action_dt'] ?? '' ?>"));
      }
    });
  </script>
</body>

</html>