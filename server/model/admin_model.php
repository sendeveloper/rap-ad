<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
	require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
	require_once(dirname(__FILE__)."/../config.php");

class AdminModel{
  	private $table_name;
  	public function __construct()
    {
    	$this->table_name = "admin_users";
    }
    public function check_email($email)
   	{
   		global $mysqli;
   		$ret = FALSE;
   		$email = $mysqli->escape_string($email);
   		$sql = "SELECT * FROM {$this->table_name} where admin_email='$email'";
   		if ($result = $mysqli->query($sql)) {
   			if ($result->num_rows>0)
   				$ret = TRUE;
			 $result->close();
		  }
		  return $ret;
   	}
    public function login($login_data)
  	{
  		global $mysqli;
  		$ret_id = -1;
     		$data = $login_data;
     		$email = $data['login_email'];
     		$return_code = array('result' => 'fail', 'msg' => "Server error");
     		foreach($data as &$each)
     		{
     			$each = $mysqli->escape_string($each);
     		}
     		try{
     			$sql = "SELECT * FROM {$this->table_name} WHERE admin_email='$email'";
     			$pass = $this->encrypt_password($data['login_password']);
     			if ($result = $mysqli->query($sql)) {
  	   			if ($result->num_rows>0)
  	   			{
  	   				$row = $result->fetch_assoc();
  	   				if ($pass == $row['admin_password'])
  	   				{
  		   				if ($row['admin_email_verified'] == "Yes")
  		   				{
  		   					$return_code['result'] = 'success';
  	   						$return_code['msg'] = 'You have successfully logged in';
  	   						$return_code['url'] = 'index.php';

  	   						$login_data = array();
  	   						$login_data['admin_id'] = $row['admin_user_id'];
  	   						$login_data['first_name'] = $row['admin_first_name'];
  	   						$login_data['email'] = $row['admin_email'];
                  $login_data['user_level'] = $row['admin_user_level'];
  	   						$_SESSION['admin1234'] = $login_data;
  	   					}
  	   					else
  	   						$return_code['msg'] = 'Your email is not activated yet. Please check your email.';
  	   				}
  	   				else
  	   					$return_code['msg'] = 'Wrong password or email';
  	   			}
  	   			else
  	   				$return_code['msg'] = 'Wrong password or email';
  	   			
  	   		}
  	   	}catch(Exception $e)
  		{
  			$return_code['msg'] = 'Wrong password or email';
  		}
  		return $return_code;
  	}
   	public function register($reg_data)
   	{
   		global $mysqli;
   		$ret_id = -1;
   		$data = $reg_data;
   		$token = $this->token_generate();
   		foreach($data as &$each)
   		{
   			$each = $mysqli->escape_string($each);
   		}
   		$data['password'] = $this->encrypt_password($data['password']);
   		$sql = "INSERT INTO {$this->table_name} (admin_first_name, admin_last_name, admin_email, admin_confirm_email, admin_password, admin_token, admin_email_verified, admin_user_level) ";
   		$sql .= " VALUES ('{$data['first_name']}', '{$data['last_name']}', '{$data['email']}',
   			'{$data['confirm_email']}', '{$data['password']}', '{$token}', 'No', '{$data['user_level']}')";
  		$mysqli->query($sql);
  		$ret_id = $mysqli->insert_id;
  		
  		if ($ret_id != -1)
  			return $token;
  		else
  			return "";
   	}
   	public function forgot_pass($forgot_data)
  	{
  		global $mysqli;
  		$return_code = array();
  		$new_pass = $this->generate_pass();
  		$return_code['password'] = $new_pass;
  		$new_pass = $this->encrypt_password($new_pass);
  		$update_sql = "UPDATE {$this->table_name} SET admin_password='{$new_pass}' WHERE admin_email='{$forgot_data['forgot_email']}'";
  		$mysqli->query($update_sql);
  		$return_code['result'] = 'success';
  		$return_code['msg'] = 'You have successfully updated the password';
  		
  		
  		return $return_code;
  	}
   	public function confirm_email($email, $key)
    {
    	global $mysqli;
        $return_code = array('result' => 'fail', 'msg' => "Permission denied");
        try{
        	$sql = "SELECT * FROM {$this->table_name} WHERE admin_email='$email' and admin_token='$key'";
        	if ($result = $mysqli->query($sql)) {
	   			if ($result->num_rows>0)
	   			{
	   				$row = $result->fetch_assoc();
	   				if ($row['admin_email_verified'] == "No")
	   				{
						$update_sql = "UPDATE {$this->table_name} SET admin_email_verified='Yes' WHERE admin_email='$email'";
	   					$mysqli->query($update_sql);
	   					$return_code['result'] = 'success';
	   					$return_code['msg'] = 'You have successfully verified your email';
	   				}
	   				else
	   					$return_code['msg'] = "You have already verified your email";
	   			}
				
			}
        }
        catch(Exception $e)
       	{

       	}
       	return $return_code;
  	}
  	protected function generate_pass($length = 8)
  	{
  		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  	    $count = mb_strlen($chars);

  	    for ($i = 0, $result = ''; $i < $length; $i++) {
  	        $index = rand(0, $count - 1);
  	        $result .= mb_substr($chars, $index, 1);
  	    }

  	    return $result;
  	}
  	protected function encrypt_password($original)
  	{
  		// return $original;
  		return md5($original);
  	}
   	protected function token_generate()
   	{
   		return md5(uniqid(rand(), true));
   	}
}
?>