<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__) . "/model/drugeducation_model.php")) {
    include_once(dirname(__FILE__) . "/model/drugeducation_model.php");
} else {
    include_once(dirname(__FILE__) . "/../model/drugeducation_model.php");
}

class Drugeducation
{
    public function __construct()
    {
    }
    public function insert_drug_education($data)
    {
        $drugeducation_model = new DrugeducationModel();
        $ret_id = $drugeducation_model->insert_drug_education($data);
        if ($ret_id != -1)
            $response = array('status' => 'ok', 'code' => 200);
        else
            $response = array('status' => 'DB Error', 'code' => 400);

        return $response;
    }
    public function get_drug_simple_list() {
        $drugeducation_model = new DrugeducationModel();
        $ret = $drugeducation_model->get_drug_simple_list();
        return $ret;
    }
    public function get_drug_list($page, $filter) {
        $drugeducation_model = new DrugeducationModel();
        $ret = $drugeducation_model->get_drug_list($page, $filter);
        return $ret;
    }
    public function get_drug_one($id) {
        $drugeducation_model = new DrugeducationModel();
        $ret = $drugeducation_model->get_drug_one($id);
        return $ret;
    }
    public function get_drug_delete($id) {
        $drugeducation_model = new DrugeducationModel();
        $ret = $drugeducation_model->get_drug_delete($id);
        return $ret;
    }
    public function update_drug_education($form_data)
    {
        $response = array(); $response['code'] = 200;
        $data = $form_data;

        $drugeducation_model = new DrugeducationModel();
        $ret_id = $drugeducation_model->update_drug_education($data);
        if ($ret_id != -1)
            $response['status'] = 'ok';
        else
            $response = array('status' => 'DB Error', 'code' => 400);
        return $response;
    }
}
?>