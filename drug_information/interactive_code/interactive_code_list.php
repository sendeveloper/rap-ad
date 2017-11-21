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
                        <h3 class="white-text center">List Codes</h3>
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
                                <input type="text" id="code-input" name="code-input" class="autocomplete">
                                <label for="code-input">Search</label>


                                <!--------Show search results in details page---------- -->

                            </div>

                            <p>&nbsp;</p>
                        </div>

                        <table class="highlight responsive-table bordered centered interactive_code_list">
                            <thead>
                                <tr>
                                    <th>Interactive Code</th>
                                    <th>Patient's First Name</th>
                                    <th>Date Of Birth</th>
                                    <th>Cell Phone</th>
                                    <th>Drug NDC</th>
                                    <th>Ready?</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- <tr>
                                    <td>Repeat</td>
                                    <td>Repeat</td>
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
    <div id="deleteInteractiveModal" class="modal">
      <div class="modal-content">
          <h4 style="color: red;">Do you really want to delete this drug property?</h4>
          <p>Interactive Code: <b id="code"></b></p>
          <p>Patient's First Name: <b id="first_name"></b></p>
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
        var code_auto_data = {};
        var server_url = "../../server/admin_interface.php";
        load_data();
        function load_data() {
          var data = {'flag': 'interactive_code_list_auto'};
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
                for (var i=0; i<res['code_data'].length; i++) {
                    code_auto_data[ res['code_data'][i]['code'] ] = null;
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
          $('#code-input').autocomplete({
            data: code_auto_data,
            onAutocomplete: function(txt) {
                $('.autocomplete-content').html("");
                load_list_data(txt);
            },
            limit: 20
          })
        }
        $('#code-input').keyup(function(e) {
            var code = e.which;
            if(code==13)e.preventDefault();
            if(code==32||code==13||code==188||code==186){
                load_list_data($(this).val());
            }
        })
        function load_list_data(filter) {
          var data = {'flag': 'interactive_code_list', 'filter': filter};
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
          var obj = $('.interactive_code_list tbody');
          var html = "";
          for (var i=0;i<data.length;i++)
          {
            html += '<tr attr-id="' + data[i]['interactive_code_id'] + '"> \
                <td>' + data[i]['interactive_code'] + '</td> \
                <td>' + data[i]['patient_first_name'] + '</td> \
                <td>' + data[i]['date_of_birth'] + '</td> \
                <td>' + data[i]['patient_cellphone'] + '</td> \
                <td>' + data[i]['ndc1'] + '</td> \
                <td>' + data[i]['prescription_ready'] + '</td> \
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