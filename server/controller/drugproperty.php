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
    function get_drug_simple_list() {
        $drugproperty_model = new DrugpropertyModel();
        $ret = $drugproperty_model->get_drug_simple_list();
        return $ret;
    }
}
?>