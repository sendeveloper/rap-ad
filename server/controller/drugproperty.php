<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__) . "/model/drugproperty_model.php")) {
    include_once(dirname(__FILE__) . "/model/drugproperty_model.php");
} else {
    include_once(dirname(__FILE__) . "/../model/drugproperty_model.php");
}

class Drugproperty
{
    private $targetDir;
    public function __construct()
    {
        $this->targetDir = "../images/uploads/drug_property_image/";
    }
    public function insert_drug_property($data)
    {
        $drugproperty_model = new DrugpropertyModel();
        $ret_id = $drugproperty_model->insert_drug_property($data);
        if ($ret_id != -1)
            $response = array('status' => 'ok', 'code' => 200);
        else
            $response = array('status' => 'DB Error', 'code' => 400);

        return $response;
    }
    public function get_drug_simple_list() {
        $drugproperty_model = new DrugpropertyModel();
        $ret = $drugproperty_model->get_drug_simple_list();
        return $ret;
    }
    public function get_drug_list($page, $filter) {
        $drugproperty_model = new DrugpropertyModel();
        $ret = $drugproperty_model->get_drug_list($page, $filter);
        return $ret;
    }
    public function get_drug_one($id) {
        $drugproperty_model = new DrugpropertyModel();
        $ret = $drugproperty_model->get_drug_one($id);
        return $ret;
    }
    public function get_drug_delete($id) {
        $drugproperty_model = new DrugpropertyModel();
        $ret = $drugproperty_model->get_drug_delete($id);
        return $ret;
    }
    public function update_drug_property($form_data)
    {
        $response = array(); $response['code'] = 200;
        $data = $form_data;

        $drugproperty_model = new DrugpropertyModel();
        $ret_id = $drugproperty_model->update_drug_property($data);
        if ($ret_id != -1)
            $response['status'] = 'ok';
        else
            $response = array('status' => 'DB Error', 'code' => 400);
        return $response;
    }
}
?>