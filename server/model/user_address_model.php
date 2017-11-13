<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
	require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
	require_once(dirname(__FILE__)."/../config.php");

class UserAddressModel{
	private $table_name;
	public function __construct()
    {
    	$this->table_name = "rap_user_address";
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
    public function update_address($user_id, $profile_data)
    {
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "Currently you don't have address");
        foreach($data as &$each)
        {
            $each = $mysqli->escape_string($each);
        }
        $sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows>0)
            {
                $update_sql = "UPDATE {$this->table_name} SET 
                        street  = '{$data['street']}',
                        city    = '{$data['city']}',
                        state  = '{$data['state']}',
                        zip_code  = '{$data['zipcode']}'
                    WHERE user_id='{$user_id}'";
                $mysqli->query($update_sql);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully updated your address.';
            }
            $mysqli->close();            
        }
        else
        {
            $return_code['msg'] = 'Server error';
        }
        
        return $return_code;
    }
    public function add_address($user_id, $profile_data)
    {
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "You already have address");
        foreach($data as &$each)
        {
            $each = $mysqli->escape_string($each);
        }
        $sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows == 0)
            {
                $insert_sql = "INSERT INTO {$this->table_name}
                        (user_id, address_type, street, city, state, zip_code) VALUES 
                        ('$user_id', 'Home', '{$data['street']}', '{$data['city']}', 
                            '{$data['state']}', '{$data['zipcode']}')";
                $mysqli->query($insert_sql);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully added your address.';
            }
            else
            {
                $row = $result->fetch_assoc();
                if ($row['street'] == "")
                {
                    $update_sql = "UPDATE {$this->table_name} SET 
                            street  = '{$data['street']}',
                            city    = '{$data['city']}',
                            state  = '{$data['state']}',
                            zip_code  = '{$data['zipcode']}'
                        WHERE user_id='{$user_id}'";
                    $mysqli->query($update_sql);
                    $return_code['result'] = 'success';
                    $return_code['msg'] = 'You have successfully added your address.';
                }
            }
            $mysqli->close();            
        }
        else
        {
            $return_code['msg'] = 'Server error';
        }
        
        return $return_code;
    }
    public function add_phone($user_id, $profile_data)
    {
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "You already have phone");
        foreach($data as &$each)
        {
            $each = $mysqli->escape_string($each);
        }
        $sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows == 0)
            {
                $insert_sql = "INSERT INTO {$this->table_name}
                        (user_id, phone) VALUES 
                        ('$user_id', '{$data['phone']}')";
                $mysqli->query($insert_sql);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully added your phone.';
            }
            else
            {
                $row = $result->fetch_assoc();
                if ($row['phone'] == "")
                {
                    $update_sql = "UPDATE {$this->table_name} SET 
                            phone  = '{$data['phone']}'
                        WHERE user_id='{$user_id}'";
                    $mysqli->query($update_sql);
                    $return_code['result'] = 'success';
                    $return_code['msg'] = 'You have successfully added your phone.';
                }
            }
            $mysqli->close();            
        }
        else
        {
            $return_code['msg'] = 'Server error';
        }
        
        return $return_code;
    }
    public function update_phone($user_id, $profile_data)
    {
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "Currently you don't have phone");
        foreach($data as &$each)
        {
            $each = $mysqli->escape_string($each);
        }
        $sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows>0)
            {
                $update_sql = "UPDATE {$this->table_name} SET 
                            phone  = '{$data['phone']}'
                        WHERE user_id='{$user_id}'";
                $mysqli->query($update_sql);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully updated your phone.';
            }
            $mysqli->close();            
        }
        else
        {
            $return_code['msg'] = 'Server error';
        }
        
        return $return_code;
    }
   	public function register_profile($user_id, $profile_data){
   		global $mysqli;
   		$ret_id = -1;
   		$data = $profile_data;
   		$return_code = array('result' => 'fail', 'msg' => "You already have profile.");
   		foreach($data as &$each)
   		{
   			$each = $mysqli->escape_string($each);
   		}
   		$birthdate = date("Y-m-d", strtotime($data['birthdate']));
   		$data['birthdate'] = $birthdate;

   		$sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
   		if ($result = $mysqli->query($sql)) {
   			if ($result->num_rows>0)
   				$ret = TRUE;
   			else
   			{
   				$sql1 = "INSERT INTO {$this->table_name} (user_id, address_type, gender, birthdate, street, city, state, zip_code) ";
		   		$sql1 .= " VALUES ('{$user_id}', '{$data['address_type']}', '{$data['gender']}', '{$data['birthdate']}',
		   					'{$data['street']}', '{$data['city']}', '{$data['state']}', '{$data['zip_code']}')";
  				$mysqli->query($sql1);

  				$return_code['result'] = 'success';
  				$return_code['msg'] = 'You have successfully registered your profile.';
   			}
            $mysqli->close();            
   		}
   		else
   		{
            $return_code['msg'] = 'Server error';
   		}
		
		return $return_code;
   	}
}
?>