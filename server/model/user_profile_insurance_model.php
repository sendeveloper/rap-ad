<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
  require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
  require_once(dirname(__FILE__)."/../config.php");

class UserProfileInsuranceModel{
    private $table_name;
    public function __construct()
    {
        $this->table_name = "rap_user_insurance_info";
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
    public function update_profile_insurance($user_id, $profile_data){
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "You don't have profile insurance.");
        foreach($data as &$each)
        {
            $each = $mysqli->escape_string($each);
        }

        $sql = "SELECT * FROM {$this->table_name} where user_id='$user_id'";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows>0)
            {
                $effective_date = date("Y-m-d", strtotime($data['effective_date']));
                $data['effective_date'] = $effective_date;
                if ($data['card_image'] != '')
                    $card_image = ", card_image = '{$data['card_image']}'";
                else
                    $card_image = "";
                $sql1 = "UPDATE {$this->table_name} SET
                        plan_name               = '{$data['plan_name']}',
                        cardholder_name         = '{$data['cardholder_name']}',
                        cardholder_id           = '{$data['cardholder_id']}',
                        bin                     = '{$data['bin']}',
                        group_id                = '{$data['group_id']}',
                        relation_to_cardholder  = '{$data['relation_to_cardholder']}',
                        person_code             = '{$data['person_code']}',
                        effective_date          = '{$data['effective_date']}',
                        copay                   = '{$data['copay']}',
                        deductible              = '{$data['deductible']}',
                        helpdesk_no             = '{$data['helpdesk_no']}'
                        {$card_image} 
                    WHERE user_id = '{$user_id}'";
                $mysqli->query($sql1);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully updated your insurance info.';
            }
        }
        else
        {
            $return_code['msg'] = 'Server error';
        }
        $mysqli->close();
        return $return_code;
    }
    public function register_profile_insurance($user_id, $profile_data){
        global $mysqli;
        $ret_id = -1;
        $data = $profile_data;
        $return_code = array('result' => 'fail', 'msg' => "You already have profile insurance.");
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
                $effective_date = date("Y-m-d", strtotime($data['effective_date']));
                $data['effective_date'] = $effective_date;
                $sql1 = "INSERT INTO {$this->table_name} (user_id, plan_name, cardholder_name, cardholder_id, bin, group_id, relation_to_cardholder, person_code, effective_date, copay, deductible, helpdesk_no, card_image) ";
                $sql1 .= " VALUES ('{$user_id}', '{$data['plan_name']}', '{$data['cardholder_name']}', 
                    '{$data['cardholder_id']}',  '{$data['bin']}', '{$data['group_id']}', 
                    '{$data['relation_to_cardholder']}', '{$data['person_code']}', 
                    '{$data['effective_date']}', '{$data['copay']}',
                    '{$data['deductible']}', '{$data['helpdesk_no']}', '{$data['card_image']}')";
                $mysqli->query($sql1);
                $return_code['result'] = 'success';
                $return_code['msg'] = 'You have successfully registered your insurance info.';
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