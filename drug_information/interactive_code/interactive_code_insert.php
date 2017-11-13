<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Pharmacy services at Red Apple Interactive Pharmacy, Roswell, GA 30076</title>

  <!-- CSS  --> 
  <link rel="stylesheet" href="../../../css/home.css" type="text/css" />
  <link rel="stylesheet" href="../../../css/speech_bubble.css" type="text/css" />
  <link rel="stylesheet" href="../../../mobiscroll/css/mobiscroll.custom-3.0.0.min.css" type="text/css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../../../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../../../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../../../css/form-materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <!--FROALA EDITOR-->
   <!-- Include Editor font. -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
 
    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../../../froala_editor_2.7.1/css/plugins/image.min.css">

</head>



<body>

<header>

<!---------Navigation 1--------->
  <nav class="white z-depth-3" role="navigation">
    <?php include('../../scripts/top_admin_sidenav.php'); ?>
  </nav>
  <!---------End Navigation 1--------->    

   
  <!--------------FABs------------------>  
 <div class="hide-on-small-and-down">
 <?php include("../../../scripts/fab.php"); ?>
  </div>    
 <div class="hide-on-med-and-up">
 <?php include("../../../scripts/fab-small-menu.php"); ?>
  </div>
 
 
  
 <!----------------Hero---------------------> 
  <div class="section no-pad-bot blue minHeight100" id="index-banner">
<div class="container">
<div class="row">
<div class="col s12 m3">
<p>&nbsp;</p>
</div>
<div class="col s12 m6">
<h3 class="white-text center">Generate Code</h3>
<p>&nbsp;</p>
</div>
<div class="col s12 m3">
<p>&nbsp;</p>
</div>
</div>
</div>
</div>
    
 <!----------------End Hero--------------------->
</header>  
   
  
<!------------------------Container---------------------->

<main>
  
<div class="section">
   <div class="container">
    
      <div class="row center">
    <div class="col s12 m3">
     &nbsp;
     </div>
      
    <div class="col s12 m6 card-panel"> 
   <p class="red-text">All fields required. Code will be sent to patient's cell phone number.</p>
   <hr class="hrblue">
   <form>	

<div class="input-field">
          <input id="patient_first_name" type="text" class="validate">
          <label for="patient_first_name" data-error="wrong" data-success="right">Patient First Name</label>
 </div><br>
      
       <div class="row center">
    <div class="col s12 m6">
    
<div class="input-field">
          <input id="date_of_birth" type="text" class="datepicker">
          <label for="date_of_birth" data-error="wrong" data-success="right">Date Of Birth</label>
 </div> <br><br>
    
<div class="input-field">
        <!------Use autocomplete from ndc field in drug_properties table------>
          <input type="text" id="autocomplete-input" class="autocomplete">
          <label for="autocomplete-input">Drug NDC Number</label>
          <p>Add more NDC number fields with plus sign</p>
   </div>
     </div>	
    <div class="col s12 m1">

     </div>	
    <div class="col s12 m5">
    
<div class="input-field">
          <input id="patient_cellphone" type="tel" class="validate">
          <label for="patient_cellphone" data-error="wrong" data-success="right">Cell Phone Number</label>
 </div> <br><br>
       
   <div class="switch">
    <label><span class="font24 orange-text">Prescription Ready? </span><br>
      NO
      <input type="checkbox">
      <span class="lever"></span>
      YES
    </label>
  </div>
     </div>	
     </div>	

   <p>&nbsp;</p>
   <p>&nbsp;</p>
   <p class="center-align">
   <button class="btn waves-effect waves-light red" type="submit" name="action">Insert
    <i class="material-icons right">send</i>
  </button>
  </p>
  <p>&nbsp;</p>
  <p>Message for developer:</p>
  <ul>
  	<li></li>
  	<li>1. On Submit, Generate Interactive code</li>
  	<li>2. Text Code to patient_cellphone number</li>
  	<li>3. Insert Code plus data into interactive_code table</li>
  	<li>2. After insert Go to interactive_code_list, ORDER Descending</li>
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
<!--Text-->    
</div>

<div class="col s12 m3">
<!--Text-->
</div>
<div class="col s12 m3">
<!--Text-->
</div>
</div>
</div>
 </div> 

  
  
 </main> 

<!--  <footer class="page-footer blue">
    <?php /*?><?php include("../scripts/footer.php"); ?><?php */?>
  </footer>-->


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../../../js/materialize.js"></script>
  <script src="../../../mobiscroll/js/mobiscroll.custom-3.0.0.min.js"></script>
  <script src="../../../js/init.js"></script>
  <script src="../../../js/interactive-rx.js"></script>
 
  <!--FROALA EDITOR-->  
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
 
    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.1/js/froala_editor.pkgd.min.js">
				</script>
				<script src="../../../froala_editor_2.7.1/js/plugins/image.min.js"></script>
 
    <!-- Initialize the editor. -->
    <script> 
				$(function() { 
				$('#drug_image_desc').froalaEditor({
  
}		
				) 
				});
				</script>
				
				
				 

  
<!--Start of Tawk.to Script-->
<?php include("../../../scripts/tawkto.php"); ?>
<!--End of Tawk.to Script-->

  </body>
</html>
