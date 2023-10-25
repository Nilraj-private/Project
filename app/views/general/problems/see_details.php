<?php
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login.php");
}
?>
<?php include('../../template/head.php') ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include('../../template/header.php') ?>

    <!-- Main Sidebar Container -->
    <?php include('../../template/sidebar.php') ?>

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
                <li class="breadcrumb-item "><a href="create_inward.html"> Register</a> </li>
                <li class="breadcrumb-item active"> Inward</li>
                <li class="breadcrumb-item active"> Details #19190</li>
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
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Estimate Amount</label>
                    <input type="text" class="form-control" placeholder="Enter Amount">
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
              <div class="row res_flex_column">
                <div class="col-md-8 max_width100">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="float-left">Inward Details (#19190)</h4>
                      <div class="float-right">
                        <button type="submit" class="btn btn-primary "><i class="fa fa-angle-left"></i> Back</button>
                        <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                        <ul class="dropdown-menu">
                          <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit</a></li>
                          <li class="dropdown-divider"></li>
                          <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#modal_send_estimate"><i class='fa fa-inr mr5'></i> Send Estimate</a></li>
                          <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#modal_add_storage_details"><i class='fa fa-cog mr5'></i> Add Storage Detail</a></li>
                          <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#modal-send-datatree"><i class='fa fa-cog mr5'></i> Send Data Tree</a></li>
                          <li class="dropdown-divider"></li>
                          <li class="dropdown-item"><a href="#"><i class='fa fa-sign-out mr5'></i> Move to Outward</a></li>
                          <li class="dropdown-item"><a href="#"><i class='fa fa-inbox mr5'></i> Move to Stock</a></li>
                          <li class="dropdown-divider"></li>
                          <li class="dropdown-item"><a href="#"><i class='fa fa-print mr5'></i> Print</a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="card-body per_details">
                      <p><span>Serial No</span> <span class="span_dot">:</span> WDEE0Q8Y</p>
                      <p><span>Internal SR#</span> <span class="span_dot">:</span> N/A</p>
                      <p><span>Device Mfg</span> <span class="span_dot">:</span> Seagate</p>
                      <p><span>Device Model</span> <span class="span_dot">:</span> ST1000LX015</p>
                      <p><span>Device Type</span> <span class="span_dot">:</span> LAPTOP</p>
                      <p><span>Device Size</span> <span class="span_dot">:</span> 1TB</p>
                      <p><span>Device Firmware</span> <span class="span_dot">:</span> SHM2</p>
                      <p><span>Device MLC</span> <span class="span_dot">:</span> N/A</p>
                      <p><span class="res_tl">Files and Directories to be Recovered </span> <span class="span_dot">:</span> <b class="res_width50 res_tl"> Hang Problem, 2 partition, Photos (IMP) & documents data recover</b></p>
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
                          <div class="card card-outline card-danger">
                            <div class="card-header">
                              <p class="box_txt">Data Storage Details not found!</p>
                            </div>
                          </div>

                          <div class="flex_center">
                            <button type="submit" class="btn btn-primary mr10" title="Update Storage Details"><i class='fa fa-inr'></i> Update Storage Details</button>
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
                          <p><b class="mr10">Information</b><span class="badge badge-secondary width65 mr5">Private </span></p>

                          <p class="mb-2 res_txt_justify res_ls02"> 1) Text will come here Text will come hereText will come hereText will come hereText will come hereText will come hereText will come hereText will come hereText will come here </p>

                          <p class="mb-2 res_txt_justify res_ls02"> 2) Text will come hereText will come hereText will come hereText will come hereText will come hereText will come hereText will come hereText will come hereText will come here</p>

                          <p class="mb-2 res_txt_justify res_ls02"> 3) Text will come hereText will come hereText will come hereText will come hereText will come hereText will come hereText will come hereText will come hereText will come here</p>

                          <div class="space_betwwen">
                            <span class="gray_color "><i class="fa fa-clock-o"></i> 04 Oct, 2023 01:25 pm</span>
                            <button type="submit" class="btn btn-primary "><i class='fa fa-trash-o'></i> Delete</button>
                          </div>

                          <div class="col-md-12 mt30 padding0">
                            <div class="card card-success">
                              <div class="card-header see_bg">
                                <h3 class="card-title">Add Action History</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool bdr_none" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                </div>
                              </div>

                              <div class="card-body res_col_form">
                                <div class="row res_mb20">
                                  <div class="col-4"><input type="text" class="form-control" placeholder="Action Title"></div>
                                  <div class="col-4">
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                      <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Action Date">
                                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar calendar_code"></i></div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-4">
                                    <select class="form-control" placeholder="Visibility Type">
                                      <option value="">Visibility Type</option>
                                      <option value="PUBLIC">Public</option>
                                      <option value="PRIVATE">Private</option>
                                    </select>
                                  </div>

                                  <div class="col-12 mt25px res_mt0"><textarea class="form-control" rows="3" placeholder="Action Description"></textarea></div>
                                </div>

                                <div class="row mt25px res_mt10">
                                  <div class="col-2 new_col"><button type="submit" class="btn btn-primary wid100" onclick="stepper.next()">Save </button> </div>
                                </div>
                              </div>
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
                        <h4>Shezad Contractor</h4>
                        <p class="mb0">
                          <i class="fa fa-user mr8"></i> Mr. Shezad Contractor<br>
                          <i class="fa fa-envelope fs14 mr8"></i> shezad.pinks@gmail.com<br>
                          <i class="fa fa-mobile mr8"></i> 9898289268<br>
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
                        <p><b class="mr8">Location :</b> Vadodara-DEALER </p>
                        <p class="mb0"><b class="mr8">Office Address :</b> Shop No. 5, Rajeshwar Plaza, B/h, Harni Police Station, Vadodara </p>
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
                        <div class="card card-outline card-danger">
                          <div class="card-header">
                            <p class="box_txt">Still Estimation Process is Pending, Plz Send Estimate Now</p>
                          </div>
                        </div>

                        <p><b>Estimation Details</b></p>
                        <div class="flex_center">
                          <button type="submit" class="btn btn-primary mr10" title="Send Estimate"><i class='fa fa-inr'></i> Send Estimate</button>
                          <button type="submit" class="btn btn-primary " title="Send Data Tree"><i class='fa fa-file'></i> Send File</button>
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
                        <p><span>Device Received on</span> 05 Oct, 2023 01:01 pm</p>
                        <p><span>Device Status</span> <span class="badge badge-success width100px">Open</span></p>
                        <p><span>Device State</span> <span class="badge badge-success width100px">Inward</span></p>
                        <p class="mb0"><span>Data Recovery Status</span> <span class="badge not-recovered width100px">Not Recovered</span></p>
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

  <script src="<?= $_SESSION['url_path'] ?>/public//jquery/jquery.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//datatables/jquery.dataTables.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//jszip/jszip.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//pdfmake/pdfmake.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//pdfmake/vfs_fonts.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/js/adminlte.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public/js/demo.js"></script>
  <!-- Page specific script -->


  <script src="<?= $_SESSION['url_path'] ?>/public//select2/js/select2.full.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//moment/moment.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//inputmask/jquery.inputmask.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//daterangepicker/daterangepicker.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//bs-stepper/js/bs-stepper.min.js"></script>
  <script src="<?= $_SESSION['url_path'] ?>/public//dropzone/min/dropzone.min.js"></script>




  <script>
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

  <script>
    $(function() {
      $('.select2').select2()
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
      })
      $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
      })
      $('[data-mask]').inputmask()
      $('#reservationdate').datetimepicker({
        format: 'L'
      });

      $('#reservationdatetime').datetimepicker({
        icons: {
          time: 'far fa-clock'
        }
      });
      $('#reservation').daterangepicker()
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })

      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function(start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      $('.duallistbox').bootstrapDualListbox()
      $('.my-colorpicker1').colorpicker()
      $('.my-colorpicker2').colorpicker()
      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      })

      $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })

    })
    document.addEventListener('DOMContentLoaded', function() {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    Dropzone.autoDiscover = false

    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, {
      url: "/target-url",
      thumbnailWidth: 80,
      thumbnailHeight: 80,
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      autoQueue: false,
      previewsContainer: "#previews",
      clickable: ".fileinput-button"
    })

    myDropzone.on("addedfile", function(file) {
      file.previewElement.querySelector(".start").onclick = function() {
        myDropzone.enqueueFile(file)
      }
    })

    myDropzone.on("totaluploadprogress", function(progress) {
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function(file) {
      document.querySelector("#total-progress").style.opacity = "1"
      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    myDropzone.on("queuecomplete", function(progress) {
      document.querySelector("#total-progress").style.opacity = "0"
    })

    document.querySelector("#actions .start").onclick = function() {
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
      myDropzone.removeAllFiles(true)
    }
  </script>
</body>

</html>