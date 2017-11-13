<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
	require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
	require_once(dirname(__FILE__)."/../config.php");

class UserContactInfoModel{
	private $table_name;
	public function __construct()
    {
    	$this->table_name = "rap_user_contact_info";
    }
    public function check_user_id($user_id)
   	{
   		global $mysqli;
   		$ret = FALSE;
   		$sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
   		if ($result = $mysqli->query($sql)) {
   			if ($result->num_rows>0)
   				$ret = TRUE;
            $result->close();
        }
        return $ret;
   	}
   	public function register_contact_info($user_id, $profile_data){
   		global $mysqli;
   		$ret_id = -1;
   		$data = $profile_data;
   		$return_code = array('result' => 'fail', 'msg' => "You already have contact info.");
   		foreach($data as &$each)
   		{
   			$each = $mysqli->escape_string($each);
   		}

   		$sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
   		if ($result = $mysqli->query($sql)) {
   			if ($result->num_rows>0)
   				$ret = TRUE;
   			else
   			{
   				$sql1 = "INSERT INTO {$this->table_name} (user_id, home_phone, cell_phone, work_phone, prefered_contact_form) ";
		   		$sql1 .= " VALUES ('{$user_id}', '{$data['home_phone']}', '{$data['cell_phone']}', 
                            '{$data['work_phone']}', '{$data['prefer']}')";
				$mysqli->query($sql1);

                $update_sql = "UPDATE rap_users SET profile_setup='Yes' WHERE user_id='{$user_id}'";
                $mysqli->query($update_sql);
                
				$return_code['result'] = 'success';
				$return_code['msg'] = 'You have successfully registered your contact info.';
   			}
   		}
   		else
   		{
			$return_code['msg'] = 'Server error';
   		}
		$mysqli->close();
		return $return_code;
   	}
}
?>