<?php 
  include_once( "server/controller/admin.php" );
  $admin = new ADMIN;
  $admin_logged_in = FALSE;
  if ( $admin->is_logged_in() ) 
  { 
    $admin_logged_in = TRUE;  
    $admin->redirect();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Pharmacy services at Red Apple Interactive Pharmacy, Roswell, GA 30076
    </title>
    <!-- CSS   --> 
    <link rel="stylesheet" href="../css/home.css" type="text/css" />
    <link rel="stylesheet" href="../css/speech_bubble.css" type="text/css" />
    <link rel="stylesheet" href="../mobiscroll/css/mobiscroll.custom-3.0.0.min.css" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/form-materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    <header>
      <!----------------Hero------------------- --> 
      <div class="section no-pad-bot blue minHeight100" id="index-banner">
        <div class="container">
          <div class="row">
            <div class="col s12 m3">
              <p>&nbsp;
              </p>
            </div>
            <div class="col s12 m6">
              &nbsp;
            </div>
            <div class="col s12 m3">
              <p>&nbsp;
              </p>
            </div>
          </div>
        </div>
      </div>
      <!----------------End Hero------------------- -->
    </header>  
    <!------------------------Container-------------------- -->
    <div class="section no-pad-bot blue minHeight300">
        <div class="container">
            <div class="row">
                <div class="col s12 m3">&nbsp;</div>
                <div class="col s12 m6 center">
                    <p>&nbsp;</p>
                    <div class="maxwidth450 paddingSides">
                        <div class="card sticky-action hoverable">
                            <div class="card-content">
                                <div class="ovalBorderRightOrange"><span class="orange-text font18">Please confirm your registration.</span>
                                    <br> </div>
                                <div align="right"><img src="../../images/pharm/female/pharm-amanda-orange.svg" alt="Pharmacist Amanda" width="90" />
                                </div>
                                <p>&nbsp;</p>
                                <p class="font14 left-align"> A confirmation link was sent to the email address used for this registration. Use the link to verify your email address.</p>
                                <p class="font14 left-align">Can't find the email? <span class="orange-text">Please check the spam folder.</span>
                                </p>
                                <p>&nbsp;</p>
                                <p class="center-align"> <a href="admin_login.php" class="waves-effect waves-light btn-flat orange-text">Continue</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m3"> &nbsp; </div>
            </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>
    </div>
    <!--  Scripts -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js">
    </script>
    <script src="../js/materialize.js">
    </script>
    <script src="../mobiscroll/js/mobiscroll.custom-3.0.0.min.js">
    </script>
    <script src="../js/init.js">
    </script>
    <script src="../js/interactive-rx.js">
    </script>
    <script src="../../js/jquery.blockUI.js">
    </script> 
    <script src="../../js/admin_main.js">
    </script>
    <!--Start of Tawk.to Script -->
    <?php include("../scripts/tawkto.php"); ?>
    <!--End of Tawk.to Script -->
  </body>
</html>