<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__) . "/model/drugcolor_model.php")) {
    include_once(dirname(__FILE__) . "/model/drugcolor_model.php");
} else {
    include_once(dirname(__FILE__) . "/../model/drugcolor_model.php");
}

class Drugcolor
{
    private $targetDir;
    public function __construct()
    {
        $this->targetDir = "../images/uploads/drug_color_image/";
    }
    public function insert_drug_color($form_data)
    {
        //generate unique file name
        $fileName = time().'_'.basename($_FILES["file"]["name"]);
        
        //file upload path
        $targetFilePath = $this->targetDir . $fileName;

        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        $response = array(); $response['code'] = 200;
        if(in_array($fileType, $allowTypes)){
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                $data = array();
                $data['drug_color']             = $form_data['drug_color'];
                $data['drug_color_image_file']  = $fileName;

                $drugcolor_model = new DrugcolorModel();
                $ret_id = $drugcolor_model->insert_drug_color($data);
                if ($ret_id != -1)
                    $response['status'] = 'ok';
                else
                    $response = array('status' => 'DB Error', 'code' => 400);
            }else{
                $response = array('status' => 'Error', 'code' => 400);
            }
        }else{
            $response = array('status' => 'Type Error', 'code' => 400);
        }

        return $response;
    }
    function get_drug_list() {
        $drugcolor_model = new DrugcolorModel();
        $ret = $drugcolor_model->get_drug_list();
        foreach($ret as &$each)
        {
            $each['drug_color_image_file'] = '../' . $this->targetDir . $each['drug_color_image_file'];
            // $each['drug_color_image_file'] = $each['drug_color_image_file'];
        }
        return $ret;
    }
    function get_drug_one($id) {
        $drugcolor_model = new DrugcolorModel();
        $ret = $drugcolor_model->get_drug_one($id);
        $ret['drug_color_image_file'] = '../' . $this->targetDir . $ret['drug_color_image_file'];
        return $ret;
    }
    function get_drug_delete($id) {
        $drugcolor_model = new DrugcolorModel();
        $ret = $drugcolor_model->get_drug_delete($id);
        return $ret;
    }
    public function update_drug_color($form_data)
    {
        $response = array(); $response['code'] = 200;
        if(!isset($_FILES['file']) || !file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['myfile']['tmp_name']))
        {
            $data = array();
            $data['drug_color_id']                = $form_data['drug_id'];
            $data['drug_color']             = $form_data['drug_color'];

            $drugcolor_model = new DrugcolorModel();
            $ret_id = $drugcolor_model->update_drug_color($data);
            if ($ret_id != -1)
                $response['status'] = 'ok';
            else
                $response = array('status' => 'DB Error', 'code' => 400);
        }
        else
        {
            //generate unique file name
            $fileName = time().'_'.basename($_FILES["file"]["name"]);
        
            //file upload path
            $targetFilePath = $this->targetDir . $fileName;

            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif');

            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    $data = array();
                    $data['drug_color_id']                = $form_data['drug_id'];
                    $data['drug_color']             = $form_data['drug_color'];
                    $data['drug_color_image_file']  = $fileName;

                    $drugcolor_model = new DrugcolorModel();
                    $ret_id = $drugcolor_model->update_drug_color($data);
                    if ($ret_id != -1)
                        $response['status'] = 'ok';
                    else
                        $response = array('status' => 'DB Error', 'code' => 400);
                }else{
                    $response = array('status' => 'Error', 'code' => 400);
                }
            }else{
                $response = array('status' => 'Type Error', 'code' => 400);
            }
        }

        return $response;
    }
}
?>