<?php
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
}
$_SESSION['page'] = 'change_password.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ni-Ki Data Recovery Services</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- DataTables -->

  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">

  <link rel="stylesheet" href="dist/css/test.css">

  <link rel="stylesheet" href="dist/css/main.css">

  <script src="https://kit.fontawesome.com/016e38d5fa.js" crossorigin="anonymous"></script>



</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light ml0">
      <!-- Left navbar links -->
      <ul class="navbar-nav">

        <li class="nav-item d-sm-inline-block">
          <a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php" class="nav-link ">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto mr5">
        <button type="button" class="btn btn-primary float-left mr10">My Account <i class='fa fa-user ml5'></i></button>
        <button type="button" class="btn btn-primary float-left mr10">Log Out <i class='fa fa-sign-out ml5'></i></button>
      </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ml0 pt30 all_center">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-md-12">
              <h1>Change Password</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>




      <!-- Main content -->
      <section class="content">
        <div class="container-fluid col-md-6">
          <div class="row">

            <div class="col-md-12">
              <div class="card">

                <div class="card-body">

                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Current Password">
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="New Password">
                      </div>
                    </div>


                    <div class="col-12">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Repeat Password">
                      </div>
                    </div>



                    <div class="col-12 mt25px res_mt10">
                      <div class="form-group res_mb0">
                        <button type="" class="btn btn-success mr10">Change Password</button>
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


    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->




  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="dist/js/demo.js"></script>
  <!-- Page specific script -->


  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <script src="plugins/dropzone/min/dropzone.min.js"></script>




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




  <script type="text/javascript">
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
  </script>

</body>

</html>