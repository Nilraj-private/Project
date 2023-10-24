<?php
if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
}
$_SESSION['page'] = 'user_index.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ni-Ki Data Recovery Services</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../../public/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../../public/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../public/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css?v=1.0.1" />
  <link rel="stylesheet" href="../../../public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../../../public/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../../../public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="../../../public/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../../public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../../../public/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="../../../public/plugins/bs-stepper/css/bs-stepper.min.css">
  <link rel="stylesheet" href="../../../public/plugins/dropzone/min/dropzone.min.css">
  <link rel="stylesheet" href="../../../public/css/main.css">
  <script src="https://kit.fontawesome.com/016e38d5fa.js" crossorigin="anonymous"></script>



</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-sm-inline-block">
          <a href="index.html" class="nav-link res_home">Home</a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto mr5">
        <button type="button" class="btn btn-primary float-left mr10">Sign Out <i class='fa fa-sign-out ml5'></i></button>
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php include '../template/sidebar.html' ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="date_strip">
              <h1>
                <?=
                date('M d, YYYY');
                ?>
              </h1>
              <p>14:45:50 PM</p>
            </div>
          </div>
        </div>
      </section>
      <!-- Content Header (Page header) -->
      <section class="content-header res_mb5 res_pt2">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6 res_width50">
              <h1>Employee List</h1>
            </div>
            <div class="col-sm-6 res_width50">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">User</a> </li>
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
              <div class="card">
                <div class="card-header">
                  <h3 class="float-left res_mt5 res_fs22">Search Employee</h3>
                  <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Add User</button>
                </div>
                <div class="card-body res_col_form">
                  <div class="row">
                    <div class="col-2"><input type="text" class="form-control" placeholder="Employee Name"></div>
                    <div class="col-2">
                      <select class="form-control" placeholder="Select Location">
                        <option>Select Location</option>
                        <option value="1">Vadodara</option>
                        <option value="2">Ahmedabad</option>
                        <option value="3">Rajkot</option>
                        <option value="4">Surat</option>
                        <option value="7">Halol</option>
                        <option value="8">Dahod</option>
                        <option value="9">Bhavnagar</option>
                        <option value="10">Porbandar</option>
                        <option value="11">Navsari</option>
                        <option value="12">Silvassa</option>
                        <option value="13">Vapi</option>
                        <option value="14">Vyara</option>
                        <option value="15">Surendranagar</option>
                        <option value="16">Mehsana</option>
                        <option value="17">Anand</option>
                        <option value="18">Jamnagar</option>
                        <option value="19">Bharuch</option>
                        <option value="20">Botad</option>
                        <option value="21">Nadiad</option>
                        <option value="22">Kalol</option>
                        <option value="23">Anjar-Kutch</option>
                        <option value="24">Ankleshwar</option>
                        <option value="25">Godhra</option>
                        <option value="26">Bodeli</option>
                        <option value="27">London</option>
                        <option value="28">Mahisagar</option>
                        <option value="30">Mahuva</option>
                        <option value="31">Balashinor</option>
                        <option value="32">Junagadh</option>
                        <option value="33">Gandhidham</option>
                        <option value="34">Amreli</option>
                        <option value="35">Borsad</option>
                        <option value="36">Chottaudepur</option>
                        <option value="37">Mundra-Kutch</option>
                        <option value="38">Valsad</option>
                        <option value="39">Panchmahal</option>
                        <option value="40">Alirajpur</option>
                        <option value="41">Daman</option>
                        <option value="42">Mandvi-Kachchh</option>
                        <option value="43">Sabarkantha</option>
                        <option value="44">Gandhinagar</option>
                        <option value="46">Vadodara-DEALER</option>
                        <option value="47">Rajkot-DEALERS</option>
                        <option value="48">Bhopal</option>
                        <option value="49">Mumbai</option>
                        <option value="50">Gandhidham-Kutch</option>
                        <option value="51">Limkheda</option>
                        <option value="52">Dhrangadhra</option>
                        <option value="53">Ahmedabad-DEALER</option>
                        <option value="54">Bhachau-Kutch</option>
                        <option value="57">Mahemdabad-DEALER</option>
                        <option value="58">Mahemdabad</option>
                        <option value="59">Tirupati</option>
                        <option value="60">Gondal</option>
                        <option value="61">Banaskatha</option>
                        <option value="63">Bilimora</option>
                        <option value="64">Morbi</option>
                        <option value="65">Dhansura</option>
                        <option value="67">Kheda</option>
                        <option value="68">Pondicherry</option>
                        <option value="69">Veraval</option>
                        <option value="70">Delhi</option>
                        <option value="71">Udaipur</option>
                        <option value="72">Aravalli</option>
                        <option value="74">Prachi - Saurastra</option>
                        <option value="77">Nizamabad</option>
                        <option value="79">Bhuj Kutch</option>
                        <option value="81">Khambhat</option>
                        <option value="82">Gir Somnath</option>
                        <option value="83">Bangalore</option>
                        <option value="85">Uttarakhand</option>
                        <option value="86">Barmer</option>
                        <option value="87">Dwarka</option>
                        <option value="88">Rajasthan</option>
                        <option value="89">Guna</option>
                        <option value="90">Agra</option>
                        <option value="91">Dakor</option>
                        <option value="92">Shehra</option>
                        <option value="93">Vallabh Vidyanagar</option>
                        <option value="94">Ujjain(MP)</option>
                        <option value="95">Pune</option>
                        <option value="96">Satna</option>
                        <option value="97">Gandhidham-DEALER</option>
                        <option value="98">Anand-Dealer</option>
                        <option value="99">Dholka</option>
                        <option value="100">Palanpur</option>
                        <option value="101">Haryana</option>
                        <option value="102">Himmatnagar</option>
                        <option value="104">Madhya Pradesh</option>
                        <option value="106">Narmada</option>
                        <option value="107">Una</option>
                        <option value="108">Bharuch-Dealer</option>
                        <option value="109">Godhra Dealar</option>
                        <option value="110">Surat - DEALER</option>
                        <option value="112">Anand - DEALERS</option>
                        <option value="113">Jamnagar-Dealer</option>
                        <option value="114">Kalol - Dealer</option>
                        <option value="115">Petlad</option>
                        <option value="116">Daboi</option>
                        <option value="117">Dahod - Delears</option>
                        <option value="119">Dwarka Dealer</option>
                        <option value="120">Jamnagar-DEALER</option>
                        <option value="121">Baska-Halol</option>
                        <option value="122">Daman Dealer</option>
                        <option value="123">Arvalli</option>
                        <option value="124">Kheda Delear</option>
                        <option value="125">Kalol Delear</option>
                      </select>
                    </div>
                    <div class="col-1 max_width100 res_mt10"><button type="submit" class="btn btn-primary wid100" onclick="stepper.next()">Search </button> </div>
                    <div class="col-1 max_width100 res_mt10"><button type="reset" class="btn btn-default wid100">Clear</button></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 mb-3">
              <div class="card mb35">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr class="color_blue_bg">
                        <th>SI No</th>
                        <th>Employee Name</th>
                        <th>Email Address</th>
                        <th>Mobile No.</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Rajkot-DEALERS</td>
                        <td>rajkot@recoveryourdata.co.in</td>
                        <td>9876543210</td>
                        <td>Rajkot-DEALERS </td>
                        <td><small class="badge badge-danger">Block</small></td>
                        <td>
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a>
                              </li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-user mr5'></i> Reset Password</a>
                              </li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete User</a>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Rajkot</td>
                        <td>nikidatarecovery2@gmail.com</td>
                        <td>9876543210</td>
                        <td>Rajkot </td>
                        <td><small class="badge badge-danger">Block</small></td>
                        <td>
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a>
                              </li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-user mr5'></i> Reset Password</a>
                              </li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete User</a>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Surat Office</td>
                        <td>surat@recoveryourdata.co.in</td>
                        <td>9876543210</td>
                        <td>Surat </td>
                        <td><small class="badge badge-danger">Block</small></td>
                        <td>
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a>
                              </li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-user mr5'></i> Reset Password</a>
                              </li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete User</a>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Bharuch</td>
                        <td>nikidatarecovery7@gmail.com</td>
                        <td>9876543210</td>
                        <td>Bharuch </td>
                        <td><small class="badge badge-danger">Block</small></td>
                        <td>
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a>
                              </li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-user mr5'></i> Reset Password</a>
                              </li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete User</a>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Daboi </td>
                        <td>nikidatarecovery3@gmail.com</td>
                        <td>9876543210</td>
                        <td>Daboi </td>
                        <td><small class="badge badge-danger">Block</small></td>
                        <td>
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="#"><i class="fa fa-pencil mr5"></i> Edit Details</a>
                              </li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-user mr5'></i> Reset Password</a>
                              </li>
                              <li class="dropdown-item"><a href="#"><i class='fa fa-trash-o mr5'></i> Delete User</a>
                              </li>
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


  <script src="../../../public/plugins/jquery/jquery.min.js"></script>
  <script src="../../../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../../public/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../../public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../../public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../../public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../../public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../../public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../../public/plugins/jszip/jszip.min.js"></script>
  <script src="../../../public/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../../public/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../../public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../../public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../../public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="../../../public/js/adminlte.min.js"></script>
  <script src="../../../public/js/demo.js"></script>
  <!-- Page specific script -->

  <script src="../../../public/plugins/select2/js/select2.full.min.js"></script>
  <script src="../../../public/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <script src="../../../public/plugins/moment/moment.min.js"></script>
  <script src="../../../public/plugins/inputmask/jquery.inputmask.min.js"></script>
  <script src="../../../public/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="../../../public/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="../../../public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="../../../public/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <script src="../../../public/plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <script src="../../../public/plugins/dropzone/min/dropzone.min.js"></script>


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