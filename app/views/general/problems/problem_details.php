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
                <li class="breadcrumb-item"><a href="/app/views/dashboard.php">Home</a></li>
                <li class="breadcrumb-item "><a href="/app/views/general/problems/problems.html">Manage Problem Issue</a> </li>
                <li class="breadcrumb-item active"> Details #0001</li>
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
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="float-left">Details View (#0001)</h4>
                    </div>

                    <div class="card-body per_details pb35">
                      <h4 class="mb-3 view_title">Problem Title : Head problem HDD return with non availability of donor.</h4>
                      <p class="mb-1"><span>Problem Details:</span></p>
                      <p>We regret to inform you that despite our diligent efforts, we have been unable to locate a suitable donor HDD in the market. As a result, we kindly request your cooperation in collecting the HDD, as it is deemed unrecoverable. We apologize for any inconvenience caused If you have any further questions or require assistance, please don't hesitate to reach out.</p>
                      <p><span>Solution:</span></p>
                      <p></p>

                      <a href="problems.html" class="btn btn-primary "><i class="fa fa-angle-left"></i> Back To List</a>
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

  <script src="/public/plugins/jquery/jquery.min.js"></script>
  <script src="/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/public/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="/public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="/public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="/public/plugins/jszip/jszip.min.js"></script>
  <script src="/public/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="/public/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="/public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="/public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="/public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="/public/js/adminlte.min.js"></script>
  <script src="/public/js/demo.js"></script>
  <!-- Page specific script -->


  <script src="/public/plugins/select2/js/select2.full.min.js"></script>
  <script src="/public/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <script src="/public/plugins/moment/moment.min.js"></script>
  <script src="/public/plugins/inputmask/jquery.inputmask.min.js"></script>
  <script src="/public/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="/public/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="/public/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <script src="/public/plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <script src="/public/plugins/dropzone/min/dropzone.min.js"></script>

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