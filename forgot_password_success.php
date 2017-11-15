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
    <link href="../css/additional.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/form-materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    <header>   
      <!----------------Hero------------------- -->   
      <div class="section no-pad-bot lime minHeight100" id="index-banner">
        <div class="container">
          <div class="row">
            <div class="col s12 m3">
              <p>&nbsp;
              </p>
            </div>
            <div class="col s12 m6">&nbsp;
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
    <div class="section">
        <div class="container">
            <div class="row center">
                <div class="col s12 m3">&nbsp;</div>
                <div class="col s12 m6 center">
                    <div class="maxwidth600">
                        <div class="ovalBorderRightLime">
                            <span class="lime-text font32">Changed password successfully!</span><br>

                        </div>
                        <div align="right">
                            <img src="../../images/pharm/female/pharm-amanda-lime.svg" alt="Pharmacist" width="120"/>
                        </div>
                        <p>&nbsp;</p>
                        <p class="redBorderAll centerText redfontLarge">Please Note:</p>
                        <hr class="hrgreen">
                        <p class="redBorderAll centerText" style="color: #006600">
                            An email was sent to your address for the new password. <br/>
                            Please check your email.
                        </p>

                        <p>&nbsp;</p>
                        <div class="clearboth divider1"></div>
                        <p class="centerText">
                            <a href="admin_login.php" data-inline="true" class="linkGreenBorder fontLarge">Continue</a>
                        </p>
                        <div class="clearboth"></div>
                    </div>
                </div>
                <div class="col s12 m3"> 
                    &nbsp;
                </div>
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