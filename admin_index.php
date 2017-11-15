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
      <!---------Navigation 1------- -->
      <nav class="white z-depth-3" role="navigation">
        <?php include('scripts/top_admin_fixed_sidenav.php'); ?>
      </nav>
      <!---------End Navigation 1------- -->    
      <!--------------FABs---------------- -->  
      <div class="hide-on-small-and-down">
        <?php include("../scripts/fab.php"); ?>
      </div>    
      <div class="hide-on-med-and-up">
        <?php include("../scripts/fab-small-menu.php"); ?>
      </div>
      <!----------------Hero------------------- --> 
      <div class="section no-pad-bot blue minHeight100" id="index-banner">
        <div class="container">
          <div class="row">
            <div class="col s12 m3">
              <p>&nbsp;
              </p>
            </div>
            <div class="col s12 m6">
              <h3 class="white-text center">Admin Index
              </h3>
              <p>&nbsp;
              </p>
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
    <main>
      <div class="section">
        <div class="container">
          <div class="row center">
            <div class="col s12 m3">
              &nbsp;
            </div>
            <div class="col s12 m3"> 
              &nbsp;
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
    <!--Start of Tawk.to Script -->
    <?php include("../scripts/tawkto.php"); ?>
    <!--End of Tawk.to Script -->
  </body>
</html>
