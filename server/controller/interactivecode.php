<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__) . "/model/interactivecode_model.php")) {
    include_once(dirname(__FILE__) . "/model/interactivecode_model.php");
} else {
    include_once(dirname(__FILE__) . "/../model/interactivecode_model.php");
}

class Interactivecode
{
    public function __construct()
    {
    }
    public function insert_interactive_code($data)
    {
        $generate_code = $this->generate_code();
        $data['interactive_code'] = $generate_code;

        $interactivecode_model = new InteractivecodeModel();
        $ret_id = $interactivecode_model->insert_interactive_code($data);
        if ($ret_id != -1)
            $response = array('status' => 'ok', 'code' => 200);
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
        if ($ret_id != -1)
            $response['status'] = 'ok';
        else
            $response = array('status' => 'DB Error', 'code' => 400);
        return $response;
    }
    private function generate_code() {
        $code = rand(111111,999999);
        return $code;
    }
}
?>