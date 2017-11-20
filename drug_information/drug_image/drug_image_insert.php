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
    <!--FROALA EDITOR -->
    <!-- Include Editor font.  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style.  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />

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
                        <h3 class="white-text center">Insert Drug Image</h3>
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
                    <div class="col s12 m3">
                        &nbsp;
                    </div>

                    <div class="col s12 m6">
                        <p>(For accurate drug image link, pull NDC from Drug_Properties database using autocomplete. Insert generic_name in Generic Name field below from autocomplete)</p>
                        <hr class="style11">
                        <form id="drug_image_insert_form" method="POST">
                            <div class="input-field">
                                <input type="text" id="ndc-input" name="ndc-input" class="validate" autocomplete="off">
                                <label for="autocomplete-input">NDC</label>
                            </div>

                            <div class="input-field">
                                <input id="generic_name" name="generic_name" type="text" class="validate">
                                <label for="generic_name" data-error="wrong" data-success="right">Drug Generic Name</label>
                            </div>

                            <div class="input-field">
                                <input id="drug_imprint_side_1" name="drug_imprint_side_1" type="text" class="validate">
                                <label for="drug_imprint_side_1" data-error="wrong" data-success="right">Drug Imprint Side 1</label>
                            </div>
                            <div class="input-field">
                                <input id="drug_imprint_side_2" name="drug_imprint_side_2" type="text" class="validate">
                                <label for="drug_imprint_side_2" data-error="wrong" data-success="right">Drug Imprint Side 2</label>
                            </div>

                            <div class="input-field">

                                <select class="icons" id="drug_color" name="drug_color">
                                    <option value="" disabled selected><span class="red">Choose Drug Color</span></option>
                                </select>
                                <label>Drug Color</label>
                            </div>


                            <div class="input-field">

                                <select class="icons" id="drug_shape" name="drug_shape">
                                    <option value="" disabled selected><span class="red">Choose Drug Shape</span>
                                    </option>
                                </select>
                                <label>Drug Shape</label>
                            </div>


                            <div class="input-field">
                                <p>Need to configure editor to upload images to folder.</p>
                                <p>Drug Image Description</p>
                                <textarea id="drug_image_desc" name="drug_image_desc"></textarea>
                            </div>
                            <br>


                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Drug Image File</span>
                                    <input type="file" multiple id="upload_image" name="upload_image">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Upload one or more images">
                                </div>
                            </div>



                            <p>&nbsp;</p>
                            <p class="center-align">
                                <button class="btn waves-effect waves-light red" type="submit" name="action">Insert
                                    <i class="material-icons right">send</i>
                                </button>
                            </p>
                            <p>&nbsp;</p>
                            <p>Message for developer:</p>
                            <ul>
                                <li>1. On Submit, insert form data into drug_image table</li>
                                <li>2. After insert Go to drug_image_list, ORDER Descending</li>
                            </ul>
                        </form>
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

    <!--  <footer class="page-footer blue">
    <?php /*?><?php include("../scripts/footer.php"); ?><?php */?>
  </footer> -->


    <!--  Scripts -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="../../../js/materialize.js"></script>
    <script src="../../../mobiscroll/js/mobiscroll.custom-3.0.0.min.js"></script>
    <script src="../../../js/init.js"></script>
    <script src="../../../js/interactive-rx.js"></script>

    <!--FROALA EDITOR -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

    <!-- Include Editor JS files.  -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.1/js/froala_editor.pkgd.min.js">
    </script>
    <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
    <!-- Initialize the editor.  -->
    <script src="../../../js/jquery.blockUI.js">
    </script> 
    <script src="../../../js/admin_main.js">
    </script>
    <script>
        $(function() {
            var ndc_auto_data = {};
            var ndc_entire_data = {};
            var server_url = "../../server/admin_interface.php";
            load_data();
            $('#drug_image_desc').froalaEditor({
                imageUploadURL: '/admin/images/uploads/'
            })
            function load_data() {
              var data = {'flag': 'drug_image_insert_auto'};
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
                    var color_html = "";
                    var shape_html = "";
                    for (var i=0; i<res['ndc_data'].length; i++) {
                        ndc_auto_data[ res['ndc_data'][i]['ndc'] ] = null;
                        ndc_entire_data[ res['ndc_data'][i]['ndc'] ] = res['ndc_data'][i]['generic_name'];
                    }
                    color_html = '<option value="" disabled selected><span class="red">Choose Drug Color</span></option>';
                    for (i=0;i<res['color_data'].length; i++) {
                        color_html += '<option value="' + res['color_data'][i]['drug_color_id'] + '" data-icon="' + res['color_data'][i]['drug_color_image_file'] + '" >' + res['color_data'][i]['drug_color'] + '</option>';
                    }

                    $('#drug_color').html(color_html);
                    $('#drug_color').material_select();
                    shape_html = '<option value="" disabled selected><span class="red">Choose Drug Shape</span></option>';
                    for (i=0;i<res['color_data'].length; i++) {
                        shape_html += '<option value="' + res['shape_data'][i]['drug_shape_id'] + '" data-icon="' + res['shape_data'][i]['drug_shape_image_file'] + '" >' + res['shape_data'][i]['drug_shape'] + '</option>';
                    }
                    $('#drug_shape').html(shape_html);
                    $('#drug_shape').material_select();
                    autoNdcInit();
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
                  if (ndc_entire_data[txt] != undefined)
                    $('#generic_name').val(ndc_entire_data[txt]);
                  else
                    $('#generic_name').val("");
                  $('#generic_name').focus();
                },
                limit: 20
              })
            }
        });
    </script>
    <!--Start of Tawk.to Script -->
    <?php include( "../../../scripts/tawkto.php"); ?>
    <!--End of Tawk.to Script -->

</body>

</html>