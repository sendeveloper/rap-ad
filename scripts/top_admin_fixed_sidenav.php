<style>
  header, main, footer {
    padding-left: 300px;
  }
  @media only screen and (max-width : 992px) {
    header, main, footer {
      padding-left: 0;
    }
  }
</style>
<div class="nav-wrapper container">
  <link href="/admin/p7tmm/p7TMM01.css" rel="stylesheet" type="text/css" media="all">
  <script type="text/javascript" src="/admin/p7tmm/p7TMMscripts.js">
  </script>
  <!-----Icon and Slogan -->
  <a href="#">
    <span class="hide-on-small-only">
      <img id="appicon" width="40" style="vertical-align: middle; margin-bottom:10px; margin-right:10px;" src="/images/logo/red-apple-pharmacy-short-500.png" alt="Red apple pharmacy logo">
    </span>
    <span class="pink-text text-accent-3">Red Apple Interactive Pharmacy
    </span>
  </a>  
  <!--Top links--------- -->  
  <ul class="right hide-on-med-and-down">
    <?php        
      if ((isset($admin_logged_in) && $admin_logged_in==FALSE) || !isset($admin_logged_in))        
      {      
    ?>        
    <li>
      <a href="admin_register.php" class="waves-effect waves-red btn-flat">
        <span class="blue-text text-lighten-2 font12">Create Account
        </span>
      </a>
    </li>        
    <li>
      <a href="admin_login.php" class="waves-effect waves-red btn-flat">
        <span class="red-text text-lighten-2 font12">Login
        </span>
      </a>
    </li>      
    <?php        
      }        
      else          
        echo '<li>
          <a href="admin_logout.php" class="waves-effect waves-red btn-flat">
            <span class="red-text text-lighten-2 font12">Logout
            </span>
          </a>
        </li>';      
    ?>

    <li>
      <a href="#redapple-map">
        <i class="material-icons grey-text text-lighten-2">place
        </i>
      </a>
    </li>
    <li>
      <a href="#">
        <i class="material-icons grey-text text-lighten-2">local_phone
        </i>
      </a>
    </li>
    <li>
      <a href="#">
        <i class="material-icons grey-text text-lighten-2">local_pharmacy
        </i>
      </a>
    </li>
    <li>
      <a href="#">
        <i class="material-icons grey-text text-lighten-2">local_see
        </i>
      </a>
    </li>
  </ul>
  <!--Start fixed Side Nav -->     
  <ul id="nav-mobile" class="side-nav fixed">
    <!--Top Image -->
    <li>
      <div class="userView">
        <div class="background">
          <!--width=300 ht=176 -->
          <img src="/images/objects/pharmacy-interior.jpg" alt="Pharmacy" width="300" height="176">
        </div>
      </div>
    </li>
    <div id="p7TMM_1" class="p7TMM01">
      <ul class="p7TMM">
        <li>
          <a href="#">Drug Information
          </a>
          <div>
            <ul>
              <li>
                <a href="#">Drug Color
                </a>
                <div>
                  <ul>
                    <li>
                      <a href="/admin/drug_information/drug_color/drug_color_insert.php">Insert Color
                      </a>
                    </li>
                    <li>
                      <a href="/admin/drug_information/drug_color/drug_color_list.php">List Colors
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#">Drug Shape
                </a>
                <div>
                  <ul>
                    <li>
                      <a href="/admin/drug_information/drug_shape/drug_shape_insert.php">Insert Shape
                      </a>
                    </li>
                    <li>
                      <a href="/admin/drug_information/drug_shape/drug_shape_list.php">List Shapes
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#">Drug Image
                </a>
                <div>
                  <ul>
                    <li>
                      <a href="/admin/drug_information/drug_image/drug_image_insert.php">Insert Image
                      </a>
                    </li>
                    <li>
                      <a href="/admin/drug_information/drug_image/drug_image_list.php">List Images
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#">Drug Properties
                </a>
                <div>
                  <ul>
                    <li>
                      <a href="/admin/drug_information/drug_properties/drug_properties_insert.php">Insert Drug Properties
                      </a>
                    </li>
                    <li>
                      <a href="/admin/drug_information/drug_properties/drug_properties_list.php">List Drug Properties
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#">Interactive Code
                </a>
                <div>
                  <ul>
                    <li>
                      <a href="/admin/drug_information/interactive_code/interactive_code_insert.php">Insert Interactive Code
                      </a>
                    </li>
                    <li>
                      <a href="/admin/drug_information/interactive_code/interactive_code_list.php">List Interactive Codes
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#">Patient Education
                </a>
                <div>
                  <ul>
                    <li>
                      <a href="/admin/drug_information/patient_education/patient_education_insert.php">Insert Patient Education
                      </a>
                    </li>
                    <li>
                      <a href="/admin/drug_information/patient_education/patient_education_list.php">List Patient Education Info
                      </a>
                    </li>
                  </ul>
                </div>
              </li>              
            </ul>
          </div>
        </li>
        <script type="text/javascript">
          <!--
            P7_TMMop('p7TMM_1',1,0,0,3,1,1,0,0,-1,150);
          // -->
        </script>
        <p>&nbsp;
        </p>     
      </ul>  
    </div> 
  </ul>
  <!--End UL Side Nav----- -->  
  <a href="#" data-activates="nav-mobile" class="button-collapse pink-text left-align show-on-large">
    <i class="material-icons">menu
    </i>
  </a>
  <!--End Side Nav----- -->  
</div>
