<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
  require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
  require_once(dirname(__FILE__)."/../config.php");

class UserPatientProfileModel{
    private $table_name;
    public function __construct()
    {
        $this->table_name = "rap_patient_options";
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
    public function update_profile_patient($user_id, $profile_data){
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "You don't have patient profile.");
        foreach($data as &$each)
        {
            $each = $mysqli->escape_string($each);
        }

        $sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows>0)
            {
                $sql1 = "UPDATE {$this->table_name} SET 
                        allergy             = '{$data['allergy']}',
                        allergy_medicine    = '{$data['allergy_medicine']}',
                        allergy_description = '{$data['allergy_description']}',
                        allergy_cat         = '{$data['allergy_cat']}',
                        bottle_caps         = '{$data['bottle_caps']}',
                        language            = '{$data['language']}',
                        clinical_program    = '{$data['clinical_program']}',
                        notes               = '{$data['notes']}',
                        weight              = '{$data['weight']}',
                        height              = '{$data['height']}',
                        conditions          = '{$data['conditions']}'
                    WHERE user_id='{$user_id}'";
                $mysqli->query($sql1);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully updated your patient options.';
            }
        }
        else
        {
            $return_code['msg'] = 'Server error';
        }
        $mysqli->close();
        return $return_code;
    }
    public function register_profile_patient($user_id, $profile_data){
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "You already have patient profile.");
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
                $sql1 = "INSERT INTO {$this->table_name} (user_id, allergy, allergy_medicine, allergy_description, 
                    allergy_cat, bottle_caps, language, clinical_program, notes, weight, height, conditions) ";
                $sql1 .= " VALUES ('{$user_id}', '{$data['allergy']}', '{$data['allergy_medicine']}',
                    '{$data['allergy_description']}', '{$data['allergy_cat']}', 
                    '{$data['bottle_caps']}', '{$data['language']}', 
                    '{$data['clinical_program']}', '{$data['notes']}',
                    '{$data['weight']}', '{$data['height']}', '{$data['conditions']}')";
                $mysqli->query($sql1);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully registered your patient options.';
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