<?php
  include_once("../../server/controller/admin.php");
  $admin = new ADMIN;
  $admin_logged_in = FALSE;
  if ($admin->is_logged_in()){
    $admin_logged_in = TRUE;
  }
  else
    $admin->redirect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>Pharmacy services at Red Apple Interactive Pharmacy, Roswell, GA 30076</title>

    <!-- CSS   -->
    <link rel="stylesheet" href="../../../css/home.css" type="text/css" />
    <link rel="stylesheet" href="../../../css/speech_bubble.css" type="text/css" />
    <link rel="stylesheet" href="../../../mobiscroll/css/mobiscroll.custom-3.0.0.min.css" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../../../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../../../css/additional.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../../../css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../../../css/form-materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <style>
        h3 {
            font-size: 32px;
            font-weight: 400;
        }
        h4 {
            font-size: 18px;
            font-weight: bolder;
        }
        .btn-flat {
            padding: 0 1rem;
        }
    </style>

</head>



<body>

    <header>

        <!---------Navigation 1------- -->
        <nav class="white z-depth-3" role="navigation">
            <?php include( '../../scripts/top_admin_sidenav.php'); ?>
        </nav>
        <!---------End Navigation 1------- -->


        <!--------------FABs---------------- -->
        <div class="hide-on-small-and-down">
            <?php include( "../../../scripts/fab.php"); ?>
        </div>
        <div class="hide-on-med-and-up">
            <?php include( "../../../scripts/fab-small-menu.php"); ?>
        </div>



        <!----------------Hero------------------- -->
        <div class="section no-pad-bot blue minHeight100" id="index-banner">
            <div class="container">
                <div class="row">
                    <div class="col s12 m3">
                        <p>&nbsp;</p>
                    </div>
                    <div class="col s12 m6">
                        <h3 class="white-text center">Patient Education Details</h3>
                        <p>&nbsp;</p>
                    </div>
                    <div class="col s12 m3">
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>

        <!----------------End Hero------------------- -->
    </header>


    <!------------------------Container-------------------- -->

    <main>

        <div class="section">
            <div class="container">

                <div class="row">
                    <div class="col s12 m3">
                        &nbsp;
                    </div>
                    <?php
                        $id = isset($_GET['q']) ? $_GET['q'] : -1;
                    ?>
                    <div class="col s12 m6">
                        <input type="hidden" id="drug_id" value="<?php echo $id ?>" />
                        <div class="card-panel yellow">
                            <h4>Generic Name:</h4>
                            <hr class="style1">
                            <p id="generic_name"></p>
                        </div>
                        <div class="card-panel orange">
                            <h4 class="white-text">Brand Name:</h4>
                            <p id="brand_name"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Drug Class:</h4>
                            <p id="drug_class"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Used For:</h4>
                            <p id="used_for"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Dosage:</h4>
                            <p id="drug_dosage"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>How To Take:</h4>
                            <p id="how_to_take"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Side Effects:</h4>
                            <p id="side_effects"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Precautions:</h4>
                            <p id="precautions"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Contraindications:</h4>
                            <p id="contraindications"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Drug Interactions:</h4>
                            <p id="drug_interactions"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Pregnancy:</h4>
                            <p id="pregnancy"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Breast Feeding:</h4>
                            <p id="breast_feeding"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Storage:</h4>
                            <p id="drug_storage"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Overdose:</h4>
                            <p id="overdose"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Missed Dose:</h4>
                            <p id="missed_dose"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Drug FAQ:</h4>
                            <p id="drug_faq"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Video:</h4>
                            <p id="drug_video"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Resources:</h4>
                            <p id="drug_resources"></p>
                            <hr class="style1">
                        </div>
                        <div class="card-panel">
                            <h4>Pharmacist's Take:</h4>
                            <p id="pharmacists_take"></p>
                            <hr class="style1">
                        </div>

                        <p class="center-align">
                            <a class="waves-effect waves-grey btn-flat green-text detail_edit"><i class="material-icons left">edit</i>Update</a>
                            <a class="waves-effect waves-grey btn-flat red-text detail_list"><i class="material-icons left">list</i>List</a>
                            <a class="waves-effect waves-grey btn-flat red-text detail_delete"><i class="material-icons left">delete</i>Delete</a>
                            <!-----------------------Show Delete Warning Popup Before Deleting-------- -->
                        </p>

                    </div>
                    <div class="col s12 m3">
                        &nbsp;
                    </div>


                </div>
            </div>
        </div>
        <div class="section grey lighten-4">
            <div class="container">
                <div class="row">

                    <div class="col s12 m6">
                        <!--Text -->
                    </div>

                    <div class="col s12 m3">
                        <!--Text -->
                    </div>
                    <div class="col s12 m3">
                        <!--Text -->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="deleteEducationDetailModal" class="modal">
      <div class="modal-content">
          <h4 style="color: red;">Do you really want to delete this drug property?</h4>
          <p>Generic name: <b id="dlg_drug_generic"></b></p>
          <p>Brand name: <b id="dlg_drug_brand"></b></p>
      </div>
      <div class="modal-footer">
          <a href="#" class=" modal-action modal-close waves-effect waves-green btn-flat">No</a>
          <a href="#" class=" modal-action waves-effect waves-green btn-flat modal-delete">Yes</a>
      </div>
    </div>
    <!--  <footer class="page-footer blue">
    <?php /*?><?php include("../scripts/footer.php"); ?><?php */?>
  </footer> -->
    <!--  Scripts -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="../../../js/materialize.js"></script>
    <script src="../../../mobiscroll/js/mobiscroll.custom-3.0.0.min.js"></script>
    <script src="../../../js/init.js"></script>
    <script src="../../../js/interactive-rx.js"></script>
    <script src="../../../js/jquery.blockUI.js"></script>
    <script src="../../../js/admin_main.js"></script>
    <script>
      $(document).ready(function() {
        var server_url = "../../server/admin_interface.php";
        load_data();
        function load_data() {
          var id = $('#drug_id').val();
          var data = {'flag': 'drug_education_one', 'id': id};
          $.ajax({
            type : 'POST',
            dataType: 'json',
            url  : server_url,
            data : data,
            beforeSend: function(){
              $.blockUI({ message: '<h1><img src="../../../images/icon/loading.gif" /> Just a moment...</h1>' });
            },
            success :function(res)
            {
              $.unblockUI();
              if (res['code'] == '200'){
                if (res['data']['patient_drug_information_id'] == undefined)
                {
                  var msg = '<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-1" class="ui-dialog-title">' + 'The data is not existed' + '</span><button id="btnCloseBlockUI" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="close"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">close</span></button></div>';
                  $('button[type="submit"]').remove();
                  $.blockUI({ message: msg});
                }
                else
                {
                  $.each(res['data'], function(key, value) {
                    $('#' + key).html(value);  
                  })
                }
              }
              else
              {
                var msg = '<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-1" class="ui-dialog-title">' +(res['msg'] || '&nbsp;')+ '</span><button id="btnCloseBlockUI" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="close"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">close</span></button></div>';
                $('button[type="submit"]').remove();
                $.blockUI({ message: msg});
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
              $.unblockUI();
            }
          })
        }
        $('.detail_edit').on('click', function() {
          var id = $('#drug_id').val();
          document.location.href = "patient_education_update.php?q=" + id;
        })
        $('.detail_list').on('click', function() {
          document.location.href = "patient_education_list.php";
        })
        $('.detail_delete').on('click', function() {
          var id = $('#drug_id').val();
          var data = {'flag': 'drug_education_one', 'id': id};
          $.ajax({
            type : 'POST',
            dataType: 'json',
            url  : server_url,
            data : data,
            beforeSend: function(){
              $.blockUI({ message: '<h1><img src="../../../images/icon/loading.gif" /> Just a moment...</h1>' });
            },
            success :function(res)
            {
              $.unblockUI();
              if (res['code'] == '200'){
                $('#deleteEducationDetailModal').attr('attr-id', id);
                $('#deleteEducationDetailModal #dlg_drug_generic').html(res['data']['generic_name']);
                $('#deleteEducationDetailModal #dlg_drug_brand').html(res['data']['brand_name']);
                $('#deleteEducationDetailModal').modal('open');
              }
              else
              {
                var msg = '<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-1" class="ui-dialog-title">' +(res['msg'] || '&nbsp;')+ '</span><button id="refreshBtnCloseBlockUI" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="close"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">close</span></button></div>';
                $.blockUI({ message: msg});
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
              $.unblockUI();
            }
          })
        })
        $('#deleteEducationDetailModal').on('click', '.modal-delete', function(e) {
          var id = $('#deleteEducationDetailModal').attr('attr-id');
          var data = {'flag': 'drug_education_delete', 'id': id};
          $.ajax({
            type : 'POST',
            dataType: 'json',
            url  : server_url,
            data : data,
            beforeSend: function(){
              $.blockUI({ message: '<h1><img src="../../../images/icon/loading.gif" /> Just a moment...</h1>' });
            },
            success :function(res)
            {
              $.unblockUI();
              if (res['code'] == '200'){
                document.location.href = "patient_education_list.php";
              }
              else
              {
                var msg = '<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-1" class="ui-dialog-title">' +(res['msg'] || '&nbsp;')+ '</span><button id="refreshBtnCloseBlockUI" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="close"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">close</span></button></div>';
                $.blockUI({ message: msg});
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
              $.unblockUI();
            }
          })
        })
      });
    </script>
    <!--Start of Tawk.to Script -->
    <?php include( "../../../scripts/tawkto.php"); ?>
    <!--End of Tawk.to Script -->
</body>
</html>