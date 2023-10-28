<?php
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login.php");
}
$_SESSION['page'] = 'problems.php';

?>
<?php include('../../template/head.php') ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include('../../template/header.php') ?>

    <!-- Main Sidebar Container -->
    <?php include('../../template/sidebar.php') ?>

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
                  <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Add</button>
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