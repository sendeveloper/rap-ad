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
                        <h3 class="white-text center">List Patient Education</h3>
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

                <div class="row center">
                    <!--    <div class="col s12 m1">
     &nbsp;
     </div> -->



                    <div class="col s12 m10">
                        <div class="center-align maxwidth400">
                            <div class="input-field">
                                <i class="material-icons prefix">search</i>
                                <input type="text" id="ndc-input" name="ndc-input" class="" autocomplete="off">
                                <label for="ndc-input">Search</label>


                                <!--------Show search results in details page---------- -->

                            </div>

                            <p>&nbsp;</p>
                        </div>

                        <table class="highlight responsive-table bordered centered drug_education_list">
                            <thead>
                                <tr>
                                    <th>Drug NDC</th>
                                    <th>Generic Name</th>
                                    <th>Brand Name</th>
                                    <th>Used For</th>
                                    <th>Drug Class</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- <tr>
                                    <td>Repeat</td>
                                    <td>Repeat</td>
                                    <td>Repeat</td>
                                    <td>Repeat</td>
                                    <td>Repeat</td>
                                    <td>

                                        <a class="waves-effect waves-grey btn-flat green-text"><i class="material-icons left">edit</i></a>
                                        <a class="waves-effect waves-grey btn-flat red-text"><i class="material-icons left">delete</i></a>
                                        <a class="waves-effect waves-grey btn-flat red-text"><i class="material-icons left">visibility</i></a>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>

                    </div>



                    <!--      
    <div class="col s12 m1"> 
    &nbsp;
    </div> -->


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
    <div id="deleteEducationModal" class="modal">
      <div class="modal-content">
          <h4 style="color: red;">Do you really want to delete this drug property?</h4>
          <p>NDC: <b id="dlg_drug_ndc"></b></p>
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
        var ndc_auto_data = {};
        var server_url = "../../server/admin_interface.php";
        load_data();
        function load_data() {
          var data = {'flag': 'drug_education_list_auto'};
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
                for (var i=0; i<res['ndc_data'].length; i++) {
                    ndc_auto_data[ res['ndc_data'][i]['ndc'] ] = null;
                }
                autoNdcInit();
                load_list_data('');
              }
              else
              {
                var msg = '<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-1" class="ui-dialog-title">' +(res['msg'] || '&nbsp;')+ '</span><button id="btnCloseBlockUI" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="close"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">close</span></button></div>';
                $.blockUI({ message: msg});
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
              $.unblockUI();
            }
          })
        }
        function autoNdcInit(){
          $('#ndc-input').autocomplete({
            data: ndc_auto_data,
            onAutocomplete: function(txt) {
                $('.autocomplete-content').html("");
                load_list_data(txt);
            },
            limit: 20
          })
        }
        $('#ndc-input').keyup(function(e) {
            var code = e.which;
            if(code==13)e.preventDefault();
            if(code==32||code==13||code==188||code==186){
                load_list_data($(this).val());
            }
        })
        function load_list_data(filter) {
          var data = {'flag': 'drug_education_list', 'filter': filter};
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
                generatePage(res['data']);
              }
              else
              {
                var msg = '<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-1" class="ui-dialog-title">' +(res['msg'] || '&nbsp;')+ '</span><button id="btnCloseBlockUI" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="close"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">close</span></button></div>';
                $.blockUI({ message: msg});
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
              $.unblockUI();
            }
          })
        }
        function generatePage(data)
        {
          var obj = $('.drug_education_list tbody');
          var html = "";
          console.log(data);
          for (var i=0;i<data.length;i++)
          {
            var used_for, drug_class;
            used_for = data[i]['used_for'].length > 15 ? data[i]['used_for'].substring(0,15) + '...' : data[i]['used_for'];
            drug_class = data[i]['drug_class'].length > 15 ? data[i]['drug_class'].substring(0,15) + '...' : data[i]['drug_class'];
            html += '<tr attr-id="' + data[i]['patient_drug_information_id'] + '"> \
                <td>' + data[i]['ndc'] + '</td> \
                <td>' + data[i]['generic_name'] + '</td> \
                <td>' + data[i]['brand_name'] + '</td> \
                <td>' + used_for + '</td> \
                <td>' + drug_class + '</td> \
                <td> \
                    <p> \
                        <a class="waves-effect waves-grey btn-flat green-text edit"><i class="material-icons left">edit</i></a> \
                        <a class="waves-effect waves-grey btn-flat red-text delete"><i class="material-icons left">delete</i></a> \
                        <a class="waves-effect waves-grey btn-flat red-text visible"><i class="material-icons left">visibility</i></a> \
                    </p> \
                </td> \
            </tr>';
          }
          obj.html(html);
        }
      })
    </script>
    <!--Start of Tawk.to Script -->
    <?php include( "../../../scripts/tawkto.php"); ?>
    <!--End of Tawk.to Script -->

</body>

</html>
