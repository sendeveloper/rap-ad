<?php 
	include_once "server/controller/admin.php";
	$reg_admin=new ADMIN();
	$return_code=array();
	$return_code[ 'result']=null;
	if(empty($_GET['email']) || empty($_GET['key']))
	{ 
		$return_code[ 'result']='error' ; 
		$return_code[ 'msg']='We are missing variables. Please double check your email.' ; 
	}
	if($return_code[ 'result'] !='error' )
	{ 
		$email=$_GET['email']; 
		$key=$_GET['key']; 
		$return_code=$reg_admin->confirm_email($email, $key);
	}
	if ($return_code['result'] == 'success')
	{ 
		echo "<p>{$return_code['msg']}</p>"; 
		echo '<script type="text/javascript">
			    setTimeout(function() {
			        document.location.href = "admin_register_confirmation.php";
			    }, 5000)
			</script>';
	}
	else{ 
		echo "
			<p>".$return_code['msg']."</p>"; echo '
			<script type="text/javascript">
			    setTimeout(function() {
			        document.location.href = "admin_register_failed.php";
			    }, 5000);
			</script>';
	}
?>