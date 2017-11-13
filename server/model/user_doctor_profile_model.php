<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
  require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
  require_once(dirname(__FILE__)."/../config.php");

class UserDoctorProfileModel{
  private $table_name;
  public function __construct()
    {
      $this->table_name = "rap_doctor";
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
    public function update_profile_doctor($user_id, $profile_data){
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "You don't have doctor info.");
        foreach($data as &$each)
        {
            $each = $mysqli->escape_string($each);
        }

        $sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows>0)
            {
                $sql1 = "UPDATE {$this->table_name} SET 
                        doctor_name         = '{$data['doctor_name']}',
                        doctor_phone        = '{$data['doctor_phone']}',
                        doctor_street       = '{$data['street']}',
                        doctor_city         = '{$data['city']}',
                        doctor_state        = '{$data['state']}',
                        doctor_zipcode      = '{$data['zip_code']}'
                    WHERE user_id='$user_id'";
                $mysqli->query($sql1);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully updated your doctor profile.';
            }
        }
        else
        {
            $return_code['msg'] = 'Server error';
        }
        $mysqli->close();
        return $return_code;
    }
    public function register_profile_doctor($user_id, $profile_data){
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "You already have doctor profile.");
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
                $sql1 = "INSERT INTO {$this->table_name} (user_id, doctor_name, doctor_phone, doctor_street, doctor_city, doctor_state, doctor_zipcode) ";
                $sql1 .= " VALUES ('{$user_id}', '{$data['doctor_name']}', '{$data['doctor_phone']}',
                    '{$data['street']}', '{$data['city']}', '{$data['state']}', '{$data['zip_code']}')";
                $mysqli->query($sql1);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully registered your doctor profile.';
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