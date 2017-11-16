<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__) . "/model/drugshape_model.php")) {
    include_once(dirname(__FILE__) . "/model/drugshape_model.php");
} else {
    include_once(dirname(__FILE__) . "/../model/drugshape_model.php");
}

class Drugshape
{
    private $targetDir;
    public function __construct()
    {
        $this->targetDir = "../images/uploads/drug_shape_image/";
    }
    public function insert_drug_shape($form_data)
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
                $data['drug_shape']             = $form_data['drug_shape'];
                $data['drug_shape_image_file']  = $fileName;

                $drugshape_model = new DrugshapeModel();
                $ret_id = $drugshape_model->insert_drug_shape($data);
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
        $drugshape_model = new DrugshapeModel();
        $ret = $drugshape_model->get_drug_list();
        foreach($ret as &$each)
        {
            $each['drug_shape_image_file'] = '../' . $this->targetDir . $each['drug_shape_image_file'];
            // $each['drug_shape_image_file'] = $each['drug_shape_image_file'];
        }
        return $ret;
    }
    function get_drug_one($id) {
        $drugshape_model = new DrugshapeModel();
        $ret = $drugshape_model->get_drug_one($id);
        $ret['drug_shape_image_file'] = '../' . $this->targetDir . $ret['drug_shape_image_file'];
        return $ret;
    }
    function get_drug_delete($id) {
        $drugshape_model = new DrugshapeModel();
        $ret = $drugshape_model->get_drug_delete($id);
        return $ret;
    }
    public function update_drug_shape($form_data)
    {
        $response = array(); $response['code'] = 200;
        if(!isset($_FILES['file']) || !file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name']))
        {
            $data = array();
            $data['drug_shape_id']                = $form_data['drug_id'];
            $data['drug_shape']             = $form_data['drug_shape'];

            $drugshape_model = new DrugshapeModel();
            $ret_id = $drugshape_model->update_drug_shape($data);
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
                    $data['drug_shape_id']                = $form_data['drug_id'];
                    $data['drug_shape']             = $form_data['drug_shape'];
                    $data['drug_shape_image_file']  = $fileName;

                    $drugshape_model = new DrugshapeModel();
                    $ret_id = $drugshape_model->update_drug_shape($data);
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