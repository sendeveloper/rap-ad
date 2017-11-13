<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
  require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
  require_once(dirname(__FILE__)."/../config.php");

class UserProfileDependentModel{
    private $table_name;
    public function __construct()
    {
        $this->table_name = "rap_user_dependent";
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
    public function has_dependents($user_id)
    {
        return $this->check_user_id($user_id);
    }
    public function update_profile_dependent($user_id, $profile_data)
    {
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "You don't have profile dependent");
        foreach($data as &$each)
        {
            $each = $mysqli->escape_string($each);
        }

        $sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows>0)
            {
                $sql1 = "UPDATE {$this->table_name} SET
                            dependent_first_name    = '{$data['dependent_first_name']}',
                            dependent_last_name     = '{$data['dependent_last_name']}',
                            dependent_birthdate     = '{$data['dependent_birthdate']}',
                            dependent_gender        = '{$data['dependent_gender']}',
                            relationship            = '{$data['relationship']}',
                            dependent_address_group = '{$data['dependent_address_group']}',
                            dependent_street        = '{$data['dependent_street']}',
                            dependent_city          = '{$data['dependent_city']}',
                            dependent_zipcode       = '{$data['dependent_zipcode']}',
                            dependent_state         = '{$data['dependent_state']}',
                            dependent_phone_group   = '{$data['dependent_phone_group']}',
                            dependent_phone         = '{$data['dependent_phone']}',
                            dependent_email_group   = '{$data['dependent_email_group']}',
                            dependent_email         = '{$data['dependent_email']}',
                            dependent_insurance_group = '{$data['dependent_insurance_group']}',
                            dependent_allergy_group   = '{$data['dependent_allergy_group']}',
                            dependent_allergy         = '{$data['dependent_allergy']}',
                            dependent_doctor          = '{$data['dependent_doctor']}',
                            dependent_doctor_phone    = '{$data['dependent_doctor_phone']}'
                        WHERE user_id='{$user_id}'";
                $mysqli->query($sql1);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully updated your profile dependent info.';
            }
        }
        else
        {
            $return_code['msg'] = 'Server error';
        }
        $mysqli->close();
        return $return_code;
    }
    public function register_profile_dependent($user_id, $profile_data){
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "You already have profile dependent.");
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
                $sql1 = "INSERT INTO {$this->table_name} (user_id, 
                    dependent_first_name, dependent_last_name, 
                    dependent_birthdate, dependent_gender,
                    relationship, dependent_address_group,
                    dependent_street, dependent_city,
                    dependent_zipcode, dependent_state,
                    dependent_phone_group, dependent_phone,
                    dependent_email_group, dependent_email,
                    dependent_insurance_group, dependent_allergy_group, 
                    dependent_allergy, dependent_doctor,
                    dependent_doctor_phone
                    ) ";
                $sql1 .= " VALUES ('{$user_id}', 
                    '{$data['dependent_first_name']}', '{$data['dependent_last_name']}', 
                    '{$data['dependent_birthdate']}', '{$data['dependent_gender']}', 
                    '{$data['relationship']}', '{$data['dependent_address_group']}', 
                    '{$data['dependent_street']}', '{$data['dependent_city']}', 
                    '{$data['dependent_zipcode']}', '{$data['dependent_state']}', 
                    '{$data['dependent_phone_group']}', '{$data['dependent_phone']}', 
                    '{$data['dependent_email_group']}', '{$data['dependent_email']}', 
                    '{$data['dependent_insurance_group']}', '{$data['dependent_allergy_group']}', 
                    '{$data['dependent_allergy']}', '{$data['dependent_doctor']}', 
                    '{$data['dependent_doctor_phone']}')";
                $mysqli->query($sql1);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully registered your profile dependent info.';
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