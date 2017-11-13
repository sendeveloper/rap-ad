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
<h3 class="white-text center">Update Drug Image</h3>
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
      
    <div class="col s12 m6"> 
   
    <hr class="style11">
   <form>	
   <div class="input-field">
          <input type="text" id="autocomplete-input" class="autocomplete">
          <label for="autocomplete-input">NDC</label>
   </div>

<div class="input-field">
          <input id="update_generic_name" type="text" class="validate">
          <label for="update_generic_name" data-error="wrong" data-success="right">Drug Generic Name</label>
 </div>
 	
<div class="input-field">
          <input id="update_drug_imprint_side_1" type="text" class="validate">
          <label for="update_drug_imprint_side_1" data-error="wrong" data-success="right">Drug Imprint Side 1</label>
 </div> 	
<div class="input-field">
          <input id="update_drug_imprint_side_2" type="text" class="validate">
          <label for="update_drug_imprint_side_2" data-error="wrong" data-success="right">Drug Imprint Side 2</label>
 </div>
 
<div class="input-field">
   
    <select class="icons">
      <option value="" disabled selected><span class="red">Choose Drug Color</span></option>
      <!----Use Dynamic select from Drug Color table in databse. Show both color name and image in select field------->
      <option value="1" class="left circle">Option 1</option>
      
      <option value="2" class="left circle">Option 2</option>
      <hr class="hrgreen">
      <option value="3" class="left circle">Option 3</option>
    </select>
    <label>Drug Color</label>
  </div>
  
   
<div class="input-field">
   
    <select class="icons">
      <option value="" disabled selected><span class="red">Choose Drug Shape</span></option>
      <!----Use Dynamic select from Drug Shape table in databse. Show both shape name and image in select field------->
      <option value="1" class="left circle">Option 1</option>
      
      <option value="2" class="left circle">Option 2</option>
      <hr class="hrgreen">
      <option value="3" class="left circle">Option 3</option>
    </select>
    <label>Drug Shape</label>
  </div>


<div class="input-field">
        <p>Need to configure editor to upload images to folder.</p>
         <p>Drug Image Description</p>
          <textarea id="update_drug_image_desc"></textarea>
</div><br>
 

<div class="file-field input-field">
      <div class="btn">
        <span>Drug Image File</span>
        <input type="file" multiple>
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
  	<li>1. On Submit, update form data in drug_image table</li>
  	<li>2. After update Go to drug_image_detail</li>
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
				$('#update_drug_image_desc').froalaEditor({
  
}		
				) 
				});
				

				</script>
				 

  
<!--Start of Tawk.to Script-->
<?php include("../../../scripts/tawkto.php"); ?>
<!--End of Tawk.to Script-->

  </body>
</html>
