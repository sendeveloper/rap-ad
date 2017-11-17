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
    <main>
      <div class="section">
        <div class="container">
          <div class="row center">       
            <div class="col s12 m3">
            </div>        
            <div class="col s12 m6 maxwidth600 center">         
              <div class="card-panel z-depth-3 hoverable">            
                <img class="responsive-img" src="../../images/objects/smiley-plus.svg" width="100" height="auto" alt="Smiley face with add sign">
                <br>            
                <form id="register_form" method="post">             
                  <div class="row">               
                    <div class="input-field col s12 l6"> 
                      <i class="material-icons prefix">account_circle
                      </i> 
                      <input id="first_name" type="text" class="validate" name="first_name"> 
                      <label for="first_name" data-error="wrong" data-success="right">First Name
                      </label> 
                    </div>                
                    <div class="input-field col s12 l6"> 
                      <i class="material-icons prefix">account_circle
                      </i> 
                      <input id="last_name" type="text" class="validate" name="last_name"> 
                      <label for="last_name" data-error="wrong" data-success="right">Last Name
                      </label> 
                    </div>              
                  </div>              
                  <div class="row">               
                    <div class="input-field col s12 l6"> 
                      <i class="material-icons prefix">email
                      </i> 
                      <input id="email" type="email" class="validate" name="email"> 
                      <label for="email" data-error="wrong" data-success="right">Email
                      </label> 
                    </div>                
                    <div class="input-field col s12 l6"> 
                      <i class="material-icons prefix">email
                      </i> 
                      <input id="confirm_email" type="email" class="validate" name="confirm_email"> 
                      <label for="confirm_email" data-error="wrong" data-success="right">Confirm Email
                      </label> 
                    </div>              
                  </div>              
                  <div class="row">               
                    <div class="input-field col s12 l6"> 
                      <i class="material-icons prefix">lock
                      </i> 
                      <input id="password" type="password" class="validate" name="password"> 
                      <label for="password" data-error="wrong" data-success="right">Choose Password
                      </label> 
                    </div>
                    <div class="input-field col s12 l6"> 
                      <i class="material-icons prefix hide-on-small-and-down" style="left: 5px;">accessibility</i>
                      <select class="icons" class="validate" name="user_level" id="user_level">
                          <option value="" disabled selected><span class="blue">Please Choose</span></option>
                          <option value="Top">Top</option>
                          <option value="Pharmacist">Pharmacist</option>
                          <option value="Student">Student</option>
                          <option value="Employee">Employee</option>
                      </select>
                      <label for="user_level" data-error="wrong" data-success="right">User level:</label>
                    </div>     
                  </div>              
                  <div class="row">               
                    <div class="input-field col s12">                 
                      <p> 
                        <input type="checkbox" id="agree_to_policy" name="agree"> 
                        <label for="agree_to_policy">
                          <span class="red-text">I agree to the Terms of use/privacy policy of Red Apple Interactive Pharmacy
                          </span>
                        </label> 
                      </p>                
                    </div>              
                  </div>              
                  <div class="row">               
                    <p>&nbsp;
                    </p>                
                    <p class="center-align"> 
                      <button class="btn waves-effect waves-light red" type="submit" name="action">Submit                                        
                        <i class="material-icons right">send
                        </i>                                        
                      </button>
                      <br> 
                      <br> 
                      <a href="admin_login.php" class="waves-effect waves-light btn-flat amber-text text-accent-3">Registered already
                      </a> 
                    </p>              
                  </div>            
                </form>         
              </div>        
            </div>        
            <div class="col s12 m3">&nbsp;
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
