<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__) . "/model/interactivecode_model.php")) {
    include_once(dirname(__FILE__) . "/model/interactivecode_model.php");
} else {
    include_once(dirname(__FILE__) . "/../model/interactivecode_model.php");
}

require 'twilio-php/Twilio/autoload.php';

use Twilio\Rest\Client;

class Interactivecode
{
    private $server_email = "nosakelly1@yahoo.com";
    private $twilio_number = "+14702354473";

    private $twilio_live_sid = "AC3d53b0bbfa9c7480247ceca8bc460166";
    private $twilio_live_token = "3ddd23648f61dea02a29bfe45a005d92";

    private $twilio_test_sid = "ACb840624ae354d37321c5e1e5001e4bd6";
    private $twilio_test_token = "c7b4fba14ad1896060823981230233db";

    private $twilio_current_sid = "";
    private $twilio_current_token = "";
    public function __construct()
    {
        $this->setTwilioMode('live');
    }
    public function insert_interactive_code($data)
    {
        $generate_code = $this->generate_code();
        $data['interactive_code'] = $generate_code;

        $interactivecode_model = new InteractivecodeModel();
        $ret_id = $interactivecode_model->insert_interactive_code($data);
        if ($ret_id != -1){
            $this->twilio_send($data['patient_cellphone'], $generate_code);
            $response = array('status' => 'ok', 'code' => 200);
        }
        else
            $response = array('status' => 'DB Error', 'code' => 400);

        return $response;
    }
    public function get_code_simple_list() {
        $interactivecode_model = new InteractivecodeModel();
        $ret = $interactivecode_model->get_code_simple_list();
        return $ret;
    }
    public function get_code_list($filter) {
        $interactivecode_model = new InteractivecodeModel();
        $ret = $interactivecode_model->get_code_list($filter);
        return $ret;
    }
    public function get_code_one($id) {
        $interactivecode_model = new InteractivecodeModel();
        $ret = $interactivecode_model->get_code_one($id);
        return $ret;
    }
    public function get_code_delete($id) {
        $interactivecode_model = new InteractivecodeModel();
        $ret = $interactivecode_model->get_code_delete($id);
        return $ret;
    }
    public function update_interactive_code($form_data)
    {
        $response = array(); $response['code'] = 200;
        $data = $form_data;
        $data['interactive_code_id'] = $data['id'];
        unset($data['id']);
        $data['interactive_code'] = $this->generate_code();

        $interactivecode_model = new InteractivecodeModel();
        $ret_id = $interactivecode_model->update_interactive_code($data);
        if ($ret_id != -1){
            $this->twilio_send($data['patient_cellphone'], $data['interactive_code']);
            $response['status'] = 'ok';
        }
        else
            $response = array('status' => 'DB Error', 'code' => 400);
        return $response;
    }
    private function generate_code() {
        $code = rand(111111,999999);
        return $code;
    }
    private function setTwilioMode($mode){
        if ($mode == 'test')
        {
            $this->twilio_current_sid = $this->twilio_test_sid;
            $this->twilio_current_token = $this->twilio_test_token;
        }
        else if ($mode == 'live')
        {
            $this->twilio_current_sid = $this->twilio_live_sid;
            $this->twilio_current_token = $this->twilio_live_token;
        }
        else
            return false;
    }
    private function twilio_send($number, $code) {
        $codeMessage = "You have just generated the code. Code Number is {$code}";
        if ($this->twilio_current_sid != '' && $this->twilio_current_token != '')
        {
            $client = new Client($this->twilio_current_sid, $this->twilio_current_token);
            try {
                $client->account->messages->create(
                    $number,
                    array(
                        'from' => $this->twilio_number,
                        'body' => $codeMessage
                    )
                );
                return array('ret' => true, 'msg' => 'success');
            } catch (Exception $e) {
                $errMsg = $e->getMessage();
                return array('ret' => false, 'msg' => $errMsg);
            }
        }
    }
}
?>