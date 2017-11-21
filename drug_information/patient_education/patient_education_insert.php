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
            <?php include( '../../scripts/top_admin_fixed_sidenav.php'); ?>
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
                        <h3 class="white-text center">Insert Patient Education</h3>
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
                        <p>(For accurate drug image link, pull NDC from Drug_Properties database using autocomplete. Insert generic_name and brand_name in Generic Name and Brand Name field below from autocomplete)</p>
                        <hr class="style11">
                        <form id="drug_education_insert_form" method="POST">

                            <div class="input-field">
                                <input id="generic_name" name="generic_name" type="text" class="validate" autocomplete="off">
                                <label for="generic_name">Generic Name</label>
                            </div>
                            <div class="input-field">
                                <input id="brand_name" name="brand_name" type="text" class="validate">
                                <label for="brand_name" data-error="wrong" data-success="right">Brand Name</label>
                            </div>


                            <div class="input-field">
                                <p>Need to configure editor to upload images to folder.</p>
                                <p>Drug Class</p>
                                <textarea id="drug_class" name="drug_class" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Drug Used For</p>
                                <textarea id="used_for" name="used_for" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Drug Dosage</p>
                                <textarea id="drug_dosage" name="drug_dosage" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>How To Take</p>
                                <textarea id="how_to_take" name="how_to_take" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Side Effects</p>
                                <textarea id="side_effects" name="side_effects" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Precautions</p>
                                <textarea id="precautions" name="precautions" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Contraindications</p>
                                <textarea id="contraindications" name="contraindications" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Drug Interactions</p>
                                <textarea id="drug_interactions" name="drug_interactions" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Pregnancy</p>
                                <textarea id="pregnancy" name="pregnancy" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Breast Feeding</p>
                                <textarea id="breast_feeding" name="breast_feeding" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Drug Storage</p>
                                <textarea id="drug_storage" name="drug_storage" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Overdose</p>
                                <textarea id="overdose" name="overdose" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Missed Dose</p>
                                <textarea id="missed_dose" name="missed_dose" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Drug FAQ</p>
                                <textarea id="drug_faq" name="drug_faq" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Drug Video</p>
                                <textarea id="drug_video" name="drug_video" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Drug Resources</p>
                                <textarea id="drug_resources" name="drug_resources" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <div class="input-field">
                                <p>Pharmacist's Take</p>
                                <textarea id="pharmacists_take" name="pharmacists_take" class="froalaTextarea"></textarea>
                            </div>
                            <br>

                            <p>&nbsp;</p>
                            <p class="center-align">
                                <button class="btn waves-effect waves-light blue" type="submit" name="action">Insert
                                    <i class="material-icons right">send</i>
                                </button>
                            </p>
                            <p>&nbsp;</p>
                            <p>Message for developer:</p>
                            <ul>
                                <li>1. On Submit, insert form data into patient_education_information table</li>
                                <li>2. After insert Go to patient_education_list, ORDER Descending</li>
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

    <script src="../../../js/jquery.blockUI.js">
    </script> 
    <script src="../../../js/admin_main.js">
    </script>
    <script>
        $(function() {
            var name_auto_data = {};
            var name_entire_data = {};
            var server_url = "../../server/admin_interface.php";
            load_data();
            $('.froalaTextarea').froalaEditor({
                imageUploadURL: '/admin/images/uploads/'
            });
            function load_data() {
              var data = {'flag': 'drug_education_insert_auto'};
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
                        name_auto_data[ res['ndc_data'][i]['generic_name'] ] = null;
                        name_entire_data[ res['ndc_data'][i]['generic_name'] ] = {'brand': res['ndc_data'][i]['brand_name']};
                    }
                    autoNameInit();
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
            function autoNameInit(){
              $('#generic_name').autocomplete({
                data: name_auto_data,
                onAutocomplete: function(txt) {
                  if (name_entire_data[txt] != undefined){
                    $('#brand_name').val(name_entire_data[txt]['brand']).focus();
                  }
                  else{
                    $('#brand_name').val("").focus();
                  }
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