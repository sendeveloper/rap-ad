<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
	require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
	require_once(dirname(__FILE__)."/../config.php");

class UserModel{
	private $table_name;
	public function __construct()
    {
    	$this->table_name = "rap_users";
    }
    public function check_email($email)
   	{
   		global $mysqli;
   		$ret = FALSE;
   		$email = $mysqli->escape_string($email);
   		$sql = "SELECT * FROM {$this->table_name} where email='$email'";
   		if ($result = $mysqli->query($sql)) {
   			if ($result->num_rows>0)
   				$ret = TRUE;
			$result->close();
		}
		return $ret;
   	}
  //  	public function setup_profile($user_id)
  //  	{
  //  		global $mysqli;
  //  		$update_sql = "UPDATE {$this->table_name} SET profile_setup='Yes' WHERE user_id='{$user_id}'";
		// $mysqli->query($update_sql);
		// $mysqli->close();
		// return TRUE;
  //  	}
   	protected function calculate_age($birthdate)
   	{
   		if ($birthdate != NULL)
   		{
   			$birthdate = explode("-", $birthdate);
			$age = (date("md", date("U", mktime(0, 0, 0, $birthdate[1], $birthdate[2], $birthdate[0]))) > date("md")
			? ((date("Y") - $birthdate[0]) - 1)
			: (date("Y") - $birthdate[0]));
			return $age;
   		}
   		else
   			return "";
   	}
   	public function get_full_info($email)
   	{
   		global $mysqli;
   		$ret = FALSE;
   		$sql = "SELECT *, 
   						count(rap_user_insurance_info.user_id) as user_insurance_count, 
   						count(rap_patient_options.user_id) as user_patient_count,
   						count(rap_user_dependent.user_id) as user_dependent_count,
   						count(rap_doctor.user_id) as user_doctor_count
   					FROM {$this->table_name} 
   					LEFT JOIN rap_user_address ON rap_users.user_id=rap_user_address.user_id 
   					LEFT JOIN rap_user_insurance_info ON rap_users.user_id=rap_user_insurance_info.user_id 
   					LEFT JOIN rap_patient_options ON rap_users.user_id=rap_patient_options.user_id 
   					LEFT JOIN rap_user_dependent ON rap_users.user_id=rap_user_dependent.user_id 
   					LEFT JOIN rap_doctor ON rap_users.user_id=rap_doctor.user_id 
   					WHERE email='$email'";
   		if ($result = $mysqli->query($sql)) {
   			if ($result->num_rows>0)
   			{
   				$row = $result->fetch_assoc();
   				$row['fullname'] = $row['first_name'] . " " . $row['last_name'];
   				$row['age'] = $this->calculate_age($row['birthdate']);
   				if ($row['street'] != '')
   					$row['full_address'] = $row['city'] . ", " . $row['state'] . " " . $row['zip_code'];
   				else
   					$row['full_address'] = "";
   				// $effective_date = date("F j, Y", strtotime($row['effective_date']));
   				$effective_date = date("Y-m-d", strtotime($row['effective_date']));
                $row['effective_date'] = $effective_date;

                $date = date("Y-m-d", strtotime($row['dependent_birthdate']));
                $row['dependent_birthdate'] = $date;

   				unset($row['password']);
   				unset($row['token']);
   				return $row;
   			}
			$result->close();
		}
		return NULL;
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
   			$sql = "SELECT * FROM {$this->table_name} WHERE email='$email'";
   			$pass = $this->encrypt_password($data['login_password']);
   			if ($result = $mysqli->query($sql)) {
	   			if ($result->num_rows>0)
	   			{
	   				$row = $result->fetch_assoc();
	   				if ($pass == $row['password'])
	   				{
		   				if ($row['email_verified'] == "Yes")
		   				{
		   					$return_code['result'] = 'success';
	   						$return_code['msg'] = 'You have successfully logged in';
	   						if ($row['profile_setup'] == "No")
	   							$return_code['url'] = '../profile/user_profile_post_registration.php';
	   						else
	   							$return_code['url'] = '../profile/user_account.php';

	   						$login_data = array();
	   						$login_data['user_id'] = $row['user_id'];
	   						$login_data['first_name'] = $row['first_name'];
	   						$login_data['email'] = $row['email'];
	   						$login_data['profile_setup'] = $row['profile_setup'];
	   						$_SESSION['user1234'] = $login_data;
	   					}
	   					else
	   						$return_code['msg'] = 'Your email is not activated yet. Please check your email.';
	   				}
	   				else
	   					$return_code['msg'] = 'Wrong password or email';
	   			}
	   			else
	   				$return_code['msg'] = 'Wrong password or email';
	   			$mysqli->close();
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
   		$sql = "INSERT INTO {$this->table_name} (first_name, last_name, email, confirm_email, password, agree_to_policy, token, profile_setup, email_verified) ";
   		$sql .= " VALUES ('{$data['first_name']}', '{$data['last_name']}', '{$data['email']}',
   			'{$data['confirm_email']}', '{$data['password']}', 'Yes', '{$token}', 
   			'No', 'No')";
		$mysqli->query($sql);
		$ret_id = $mysqli->insert_id;
		$mysqli->close();
		if ($ret_id != -1)
			return $token;
		else
			return "";
   	}
    public function update_profile($user_id, $reg_data)
    {
        global $mysqli;
        $return_code = array();
        $return_code['result'] = 'success';
        $return_code['msg'] = 'You have successfully updated the profile';
        $data = $reg_data;
        foreach($data as &$each)
        {
            $each = $mysqli->escape_string($each);
        }
        $data['password'] = $this->encrypt_password($data['password']);
        $sql = "UPDATE {$this->table_name} SET 
            first_name = '{$data['first_name']}', 
            last_name  = '{$data['last_name']}', 
            password  = '{$data['password']}' WHERE user_id='$user_id'";
        $mysqli->query($sql);
        $ret_id = $mysqli->insert_id;
        $mysqli->close();
        if ($ret_id != -1)
            return $return_code;
        else
        {
            $return_code['result'] = 'fail';
            $return_code['msg'] = 'You have failed to updated the profile';
        }
    }
   	public function forgot_pass($forgot_data)
	{
		global $mysqli;
		$return_code = array();
		$new_pass = $this->generate_pass();
		$return_code['password'] = $new_pass;
		$new_pass = $this->encrypt_password($new_pass);
		$update_sql = "UPDATE {$this->table_name} SET password='{$new_pass}' WHERE email='{$forgot_data['forgot_email']}'";
		$mysqli->query($update_sql);
		$return_code['result'] = 'success';
		$return_code['msg'] = 'You have successfully updated the password';
		
		$mysqli->close();
		return $return_code;
	}
   	public function confirm_email($email, $key)
    {
    	global $mysqli;
        $return_code = array('result' => 'fail', 'msg' => "Permission denied");
        try{
        	$sql = "SELECT * FROM {$this->table_name} WHERE email='$email' and token='$key'";
        	if ($result = $mysqli->query($sql)) {
	   			if ($result->num_rows>0)
	   			{
	   				$row = $result->fetch_assoc();
	   				if ($row['email_verified'] == "No")
	   				{
						$update_sql = "UPDATE {$this->table_name} SET email_verified='Yes' WHERE email='$email'";
	   					$mysqli->query($update_sql);
	   					$return_code['result'] = 'success';
	   					$return_code['msg'] = 'You have successfully verified your email';
	   				}
	   				else
	   					$return_code['msg'] = "You have already verified your email";
	   			}
				$mysqli->close();
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