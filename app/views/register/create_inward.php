<?php
require("../../models/model.php");

use app\models\Model;

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
}
$_SESSION['page'] = 'create_inward.php';

$model = (new Model());
$customers = $model->select("customer");
?>
<?php include('../template/head.php') ?>
<!-- <link rel="stylesheet" href="/public/css/test.css"> -->

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
            <div class="col-sm-6 res_width50">
              <h1>Take New Inward</h1>
            </div>
            <div class="col-sm-6 res_width50">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/app/views/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active"> Register</a> </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid ">
          <form id="create_inward">
            <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-body res_col_form">
                    <div class="row">
                      <div class="col-2">
                        <h4 class="float-left">Select Client :</h4>
                      </div>
                      <div class="col-6">
                        <select class="form-control" name="customer_id" id="customer_id">
                          <option value="">Select Client</option>
                          <?php foreach ($customers as $customer) { ?>
                            <option value="<?= $customer['id'] ?>"><?= $customer['customer_name'] ?></option>
                          <?php } ?>
                        </select>
                        <!-- <input class="lh30" name="customer_id" id="CaseRegister_customer_id" type="search" /> -->
                        <div class="errorMessage" id="CaseRegister_customer_id_em_" style="display:none"></div>
                      </div>

                      <div class="col-2 res_mt10 new_col">
                        <button type="button" class="btn btn-primary wid100" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i> Add Customer </button>
                      </div>
                      <div class="col-2 res_mt10 new_col">
                        <button type="submit" class="btn btn-default wid100"><i class="fa fa-inbox"></i> Inward List</button>
                      </div>
                    </div>
                  </div>
                </div>
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
                    <form id="customer_form">
                      <div class="modal-body res_col_form">
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group">
                              <label>Company Name *</label>
                              <input type="text" class="form-control" name="" id="" placeholder="Company Name *" required>
                            </div>
                          </div>

                          <div class="col-6">
                            <div class="form-group">
                              <label>Customer Name *</label>
                              <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name *" required>
                            </div>
                          </div>

                          <div class="col-6">
                            <div class="form-group">
                              <label>Primary Email *</label>
                              <input type="text" class="form-control" name="customer_primary_email_id" id="customer_primary_email_id" placeholder="Primary Email *" required>
                            </div>
                          </div>

                          <div class="col-6">
                            <div class="form-group">
                              <label>Primary Mobile No.*</label>
                              <input type="text" class="form-control" name="customer_mobile_no1" id="customer_mobile_no1" placeholder="Primary Mobile No.*" required>
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
                                <option value="29">Amreli</option>
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
                                <option value="62">Narmada</option>
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
                                <option value="80">Bhuj Kutch</option>
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
                                <option value="105">Narmada</option>
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
                          </div>

                          <div class="col-6 res_mt10">
                            <div class="form-group">
                              <!-- <input class="submit btn btn-success" type="submit" name="yt0" value="Add"> -->
                              <button type="submit" class="btn btn-success">Add</button>
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
                          <input type="text" class="form-control" name="device_serial_number" id="device_serial_number" placeholder="Device Serial Number">
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Internal Serial Number</label>
                          <input type="text" class="form-control" name="device_internal_serial_number" id="device_internal_serial_number" placeholder="Device Internal Serial Number">
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Manufacturer</label>
                          <select class="form-control" name="manufacture_id" id="manufacture_id" placeholder="Device Manufacturer">
                            <option value="">Select Device Manufacturer</option>
                            <option value="1">Western Digital</option>
                            <option value="2">Seagate</option>
                            <option value="3">Toshiba</option>
                            <option value="4">Samsung</option>
                            <option value="6">Fujitsu</option>
                            <option value="7">Transcend</option>
                            <option value="8">Hitachi</option>
                            <option value="9">Maxtor</option>
                            <option value="10">Acer</option>
                            <option value="11">HP</option>
                            <option value="12">Dell</option>
                            <option value="13">Lenovo</option>
                            <option value="14">Sony</option>
                            <option value="15">Acer</option>
                            <option value="16">Buffalo</option>
                            <option value="17">Iomega</option>
                            <option value="18">Adata</option>
                            <option value="19">LG</option>
                            <option value="20">Verbatim</option>
                            <option value="21">Ultima</option>
                            <option value="22">intel</option>
                            <option value="23">Imation</option>
                            <option value="24">Excel Stor </option>
                            <option value="25">Kingstone</option>
                            <option value="26">Eluktronics</option>
                            <option value="27">Terabytegold</option>
                            <option value="28">Micron</option>
                            <option value="29">Simmtronics</option>
                            <option value="30">Mini Station</option>
                            <option value="31">Cavalry</option>
                            <option value="32">IBM</option>
                            <option value="33">LITE-ON</option>
                            <option value="34">Lacie</option>
                            <option value="35">NETGEAR</option>
                            <option value="36">Netgear</option>
                            <option value="37">Rock Mobile Disk</option>
                            <option value="38">Plextor</option>
                            <option value="39">Plextor</option>
                            <option value="40">Intel</option>
                            <option value="41">Sandisk</option>
                            <option value="42">Done</option>
                            <option value="43">RAID Server PC</option>
                            <option value="44">Gigabyte</option>
                            <option value="45">Gigabyte</option>
                            <option value="46">Gigabyte</option>
                            <option value="47">Matsunichi</option>
                            <option value="48">Magnetic Data Tech.</option>
                            <option value="49">PNY</option>
                            <option value="50">Union Memory</option>
                            <option value="51">G-Technology</option>
                            <option value="52">DAICHI</option>
                            <option value="53">SKhynix</option>
                            <option value="54">EVM</option>
                            <option value="55">Zebronics</option>
                            <option value="56">Consistent</option>
                            <option value="57">Asustor</option>
                            <option value="58">Crucial</option>
                            <option value="59">Nextron</option>
                            <option value="60">Dahua</option>
                            <option value="61">AD Net</option>
                            <option value="62">M.Skill</option>
                            <option value="63">Tech - Com</option>
                            <option value="64">Hikvision</option>
                            <option value="65">Lexar</option>
                            <option value="66">KIOXIA</option>
                            <option value="67">Xpg</option>
                            <option value="68">OCZ Technology</option>
                            <option value="69">Crucial</option>
                            <option value="70">Crucial</option>
                            <option value="71">Oscoo</option>
                            <option value="72">Geonix</option>
                            <option value="73">LAPCARE</option>
                            <option value="74">PNY</option>
                            <option value="75">DGNET</option>
                            <option value="76">AVER-TEK</option>
                            <option value="77">AVEK-TEK</option>
                            <option value="78">HAZE</option>
                            <option value="79">Speedstar</option>
                            <option value="80">Millennium</option>
                            <option value="82">Neo Forza</option>
                            <option value="83">Astrum</option>
                            <option value="84">Taiwan</option>
                            <option value="85">Aarvex</option>
                            <option value="86">HAZE</option>
                            <option value="87">Foresee</option>
                            <option value="88">BRYT</option>
                            <option value="89">Aarvex</option>
                            <option value="90">Marshal</option>
                            <option value="91">SP</option>
                            <option value="92">Irvin</option>
                            <option value="93">Aarvex</option>
                            <option value="94">smile</option>
                            <option value="95">Smile</option>
                            <option value="96">NVM</option>
                            <option value="97">Nextron</option>
                            <option value="98">Frontech</option>
                            <option value="99">Biwin</option>
                            <option value="100">Consistent</option>
                            <option value="101">Power X</option>
                            <option value="102">Vivetronic</option>
                            <option value="103">Idata</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Model</label>
                          <input type="text" class="form-control" name="device_model" id="device_model" placeholder="Device Model">
                        </div>
                      </div>
                    </div>

                    <div class="row mt25px res_mt0">
                      <div class="col-2">
                        <div class="form-group">
                          <label>Device Type</label>
                          <select class="form-control" name="device_type" id="device_type" placeholder="Select Device Type">
                            <option value="">Device Type</option>
                            <option value="DESKTOP">DESKTOP</option>
                            <option value="LAPTOP">LAPTOP</option>
                            <option value="USB WITH CABLE">USB WITH CABLE</option>
                            <option value="USB WITHOUT CABLE">USB WITHOUT CABLE</option>
                            <option value="USB WITH CABLE &amp; ADAPTER">USB WITH CABLE &amp; ADAPTER</option>
                            <option value="USB WITHOUT CABLE &amp; WITH ADAPTER">USB WITHOUT CABLE &amp; WITH ADAPTER
                            </option>
                            <option value="USB WITHOUT CABLE &amp; WITHOUT ADAPTER">USB WITHOUT CABLE &amp; WITHOUT
                              ADAPTER</option>
                            <option value="LAPTOP SSD SATA">LAPTOP SSD SATA</option>
                            <option value="NVME SSD">NVME SSD</option>
                            <option value="SSD USB WITH CABLE">SSD USB WITH CABLE</option>
                            <option value="SSD USB WITHOUT CABLE">SSD USB WITHOUT CABLE</option>
                            <option value="OTHER">OTHER</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-2">
                        <div class="form-group">
                          <label>Device Size</label>
                          <div>
                            <input type="text" class="form-control width64per float-left" name="device_size" id="device_size" placeholder="Device Size">
                            <select class="form-control width-36 float-left" placeholder="Select Device Size" name="device_size_unit" id="device_size_unit">
                              <option>TB</option>
                              <option>GB</option>
                              <option>MB</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-2">
                        <div class="form-group">
                          <label>Crash Type</label>
                          <select class="form-control" name="crash_type" id="crash_type" placeholder="Crash Type">
                            <option value="">Crash Type</option>
                            <option value="PHYSICAL">Physical</option>
                            <option value="LOGICAL">Logical</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Device Firmware</label>
                          <input type="text" class="form-control" name="device_firmware" id="device_firmware" placeholder="Firmware Number">
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Device MLC</label>
                          <input type="text" class="form-control" name="device_mlc" id="device_mlc" placeholder="Device MLC">
                        </div>
                      </div>
                    </div>

                    <div class="row mt25px res_mt0_991">
                      <div class="col-6">
                        <div class="form-group">
                          <label>Files and Directories to be recovered</label>
                          <textarea class="form-control" rows="2" name="customer_remarks" id="customer_remarks" placeholder="Enter Files to bis Recovered Details"></textarea>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="input-group date " id="reservationdate" data-target-input="nearest">
                          <label class="width-full">Device Received Date</label>
                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="case_received_date" id="case_received_date" placeholder="Device Received Date">
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt25px res_auto_btn res_mb12 ">
                      <button type="button" class="btn btn-success mr10" onClick="addInward(1);">Save & Add New </button>
                      <button type="button" class="btn btn-success mr10" onClick="addInward();">Save & Exit</button>
                      <a type="button" href="/app/views/register/register.php?type=<?= $_GET['type'] ?>" class="btn btn-danger">Cancel</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
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

  <script type="text/javascript">
    $(document).ready(function() {
      $("#customer_form").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serializeArray();
        $.ajax({
          type: "POST",
          url: "../../controllers/AddCustomerController.php",
          data: {
            formData: formData,
            id: "<?= $_GET['id'] ?? 0 ?>"
          },
          success: function(response) {
            window.location.href = "customer_index.php";
          }
        });
      });
    });

    function addInward(retry) {
      formData = $('#create_inward').serializeArray();
      console.log(formData);
      $.ajax({
        url: '../../controllers/RegisterController.php',
        type: 'POST',
        data: {
          formData: formData,
        },
        success: function(response) {
          // if (retry != 1)
            // window.location.href = "/app/views/register/register.php" + "<?= isset($_GET['type']) ? '?type=' + $_GET['type'] : '' ?>";
        },
      });
    }
  </script>

  <script>
    $(function() {
      $('#reservationdate').datetimepicker({
        format: 'L'
      });

    })
  </script>

  <!-- <script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function($) {
      // jQuery('#CaseRegister_customer_id').select2({
      //   'formatNoMatches': function() {
      //     return "No matches found";
      //   },
      //   'formatInputTooShort': function(input, min) {
      //     return "Please enter " + (min - input.length) + " more characters";
      //   },
      //   'formatInputTooLong': function(input, max) {
      //     return "Please enter " + (input.length - max) + " less characters";
      //   },
      //   'formatSelectionTooBig': function(limit) {
      //     return "You can only select " + limit + " items";
      //   },
      //   'formatLoadMore': function(pageNumber) {
      //     return "Loading more results...";
      //   },
      //   'formatSearching': function() {
      //     return "Searching...";
      //   },
      //   'placeholder': 'Search a Customer',
      //   'containerCssClass': '',
      //   'width': '100%',
      //   'minimumInputLength': 1,
      //   'ajax': {
      //     'url': '/office/customer/customer/ajaxCustomerData2',
      //     'dataType': 'json',
      //     'type': 'GET',
      //     'data': function(term, page) {
      //       return {
      //         q: term,
      //         page_limit: 10,
      //       };
      //     },
      //     'results': function(data, page) {
      //       return {
      //         results: data
      //       };
      //     }
      //   },
      //   'initSelection': function(element, callback) {
      //     // the input tag has a value attribute preloaded that points to a preselected repository id
      //     // this function resolves that id attribute to an object that select2 can render
      //     // using its formatResult renderer - that way the repository name is shown preselected
      //     var id = element.val();
      //     var text = element.data("option");
      //     data = {
      //       "id": id,
      //       "name": text,
      //       "customer_name": "",
      //       "customer_primary_email_id": "",
      //       "customer_mobile_no1": ""
      //     };
      //     callback(data);
      //   },
      //   'formatResult': function(data) {
      //     var markup = "<h4>" + data.name + " <small> (" + data.customer_name + ")</small></h4>";
      //     markup += "<p><b>E:</b>" + data.customer_primary_email_id + " |  <b>M:</b> " + data.customer_mobile_no1 + "</p>";
      //     return markup;
      //   },
      //   'formatSelection': function(data) {
      //     return data.name;
      //   }
      // });
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
      jQuery('#customer-form').yiiactiveform({
        'validateOnSubmit': true,
        'validateOnChange': true,
        'inputContainer': 'div.form-group',
        'errorCssClass': 'has-error',
        'successCssClass': 'has-success',
        'attributes': [{
          'id': 'CaseRegister_customer_id',
          'inputID': 'CaseRegister_customer_id',
          'errorID': 'CaseRegister_customer_id_em_',
          'model': 'CaseRegister',
          'name': 'customer_id',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) == '') {
              messages.push("Customer Id cannot be blank.");
            }


            if (jQuery.trim(value) != '') {

              if (!value.match(/^\s*[+-]?\d+\s*$/)) {
                messages.push("Customer Id must be an integer.");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_device_serial_number',
          'inputID': 'CaseRegister_device_serial_number',
          'errorID': 'CaseRegister_device_serial_number_em_',
          'model': 'CaseRegister',
          'name': 'device_serial_number',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) == '') {
              messages.push("Device Serial Number cannot be blank.");
            }


            if (jQuery.trim(value) != '') {

              if (value.length > 30) {
                messages.push("Device Serial Number is too long (maximum is 30 characters).");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_device_internal_serial_number',
          'inputID': 'CaseRegister_device_internal_serial_number',
          'errorID': 'CaseRegister_device_internal_serial_number_em_',
          'model': 'CaseRegister',
          'name': 'device_internal_serial_number',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) != '') {

              if (value.length > 20) {
                messages.push("Device Internal Serial Number is too long (maximum is 20 characters).");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_device_maker_id',
          'inputID': 'CaseRegister_device_maker_id',
          'errorID': 'CaseRegister_device_maker_id_em_',
          'model': 'CaseRegister',
          'name': 'device_maker_id',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) != '') {

              if (!value.match(/^\s*[+-]?\d+\s*$/)) {
                messages.push("Device Manufacturer must be an integer.");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_device_model',
          'inputID': 'CaseRegister_device_model',
          'errorID': 'CaseRegister_device_model_em_',
          'model': 'CaseRegister',
          'name': 'device_model',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) != '') {

              if (value.length > 25) {
                messages.push("Device Model is too long (maximum is 25 characters).");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_device_type',
          'inputID': 'CaseRegister_device_type',
          'errorID': 'CaseRegister_device_type_em_',
          'model': 'CaseRegister',
          'name': 'device_type',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) != '') {

              if (value.length > 50) {
                messages.push("Device Type is too long (maximum is 50 characters).");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_device_size',
          'inputID': 'CaseRegister_device_size',
          'errorID': 'CaseRegister_device_size_em_',
          'model': 'CaseRegister',
          'name': 'device_size',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) != '') {

              if (value.length > 10) {
                messages.push("Device Size is too long (maximum is 10 characters).");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_crash_type',
          'inputID': 'CaseRegister_crash_type',
          'errorID': 'CaseRegister_crash_type_em_',
          'model': 'CaseRegister',
          'name': 'crash_type',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) != '') {

              if (value.length > 10) {
                messages.push("Crash Type is too long (maximum is 10 characters).");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_device_firmware',
          'inputID': 'CaseRegister_device_firmware',
          'errorID': 'CaseRegister_device_firmware_em_',
          'model': 'CaseRegister',
          'name': 'device_firmware',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) != '') {

              if (value.length > 15) {
                messages.push("Device Firmware is too long (maximum is 15 characters).");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_device_mlc',
          'inputID': 'CaseRegister_device_mlc',
          'errorID': 'CaseRegister_device_mlc_em_',
          'model': 'CaseRegister',
          'name': 'device_mlc',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) != '') {

              if (value.length > 20) {
                messages.push("Device MLC is too long (maximum is 20 characters).");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_files_to_recover',
          'inputID': 'CaseRegister_files_to_recover',
          'errorID': 'CaseRegister_files_to_recover_em_',
          'model': 'CaseRegister',
          'name': 'files_to_recover',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) != '') {

              if (value.length > 2048) {
                messages.push("Files To Recover is too long (maximum is 2048 characters).");
              }

            }


            if (jQuery.trim(value) != '') {

              if (value.length > 512) {
                messages.push("Files To Recover is too long (maximum is 512 characters).");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_inward_remarks',
          'inputID': 'CaseRegister_inward_remarks',
          'errorID': 'CaseRegister_inward_remarks_em_',
          'model': 'CaseRegister',
          'name': 'inward_remarks',
          'enableAjaxValidation': false,
          'clientValidation': function(value, messages, attribute) {

            if (jQuery.trim(value) != '') {

              if (value.length > 2048) {
                messages.push("Inward Remarks is too long (maximum is 2048 characters).");
              }

            }

          },
          'summary': true
        }, {
          'id': 'CaseRegister_case_received_date',
          'inputID': 'CaseRegister_case_received_date',
          'errorID': 'CaseRegister_case_received_date_em_',
          'model': 'CaseRegister',
          'name': 'case_received_date',
          'enableAjaxValidation': false,
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }, {
          'summary': true
        }],
        'summaryID': 'customer-form_es_',
        'errorCss': 'error'
      });

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

</body>

</html>