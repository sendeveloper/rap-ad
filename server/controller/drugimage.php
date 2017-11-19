<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__) . "/model/drugimage_model.php")) {
    include_once(dirname(__FILE__) . "/model/drugimage_model.php");
} else {
    include_once(dirname(__FILE__) . "/../model/drugimage_model.php");
}

class Drugimage
{
    private $targetDir;
    public function __construct()
    {
        $this->targetDir = "../images/uploads/drug_image_image/";
    }
    public function insert_drug_image($form_data)
    {
        //generate unique file name
        $response = array(); $response['code'] = 200;
        $allowTypes = array('jpg','png','jpeg','gif');
        $fileCount = (int)$form_data['file_count'];
        if ($fileCount > 0)
        {
            $data = array();
            $data['ndc']                    = $form_data['ndc'];
            $data['generic_name']           = $form_data['generic_name'];
            $data['drug_imprint_side_1']    = $form_data['drug_imprint_side_1'];
            $data['drug_imprint_side_2']    = $form_data['drug_imprint_side_2'];
            $data['drug_color_id']          = $form_data['drug_color'];
            $data['drug_shape_id']          = $form_data['drug_shape'];
            $data['drug_image_description'] = $form_data['drug_image_description'];

            for ($i=0;$i<$fileCount;$i++)
            {
                $fileName = time().'_'.basename($_FILES["file" . ($i+1)]["name"]);
                $targetFilePath = $this->targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){
                    if(move_uploaded_file($_FILES["file" . ($i+1)]["tmp_name"], $targetFilePath)){
                        $data['file_name_'.($i+1)] = $fileName;
                    }else{
                        $response = array('status' => 'Error', 'code' => 400);
                    }
                }
                else
                {
                    $response = array('status' => 'Image type error', 'code' => 400);
                }
            }

            $drugimage_model = new DrugimageModel();
            $ret_id = $drugimage_model->insert_drug_image($data);
            if ($ret_id != -1)
                $response['status'] = 'ok';
            else
                $response = array('status' => 'DB Error', 'code' => 400);
        }
        return $response;
    }
    function get_drug_simple_list() {
        $drugimage_model = new DrugimageModel();
        $ret = $drugimage_model->get_drug_simple_list();
        return $ret;
    }
    function get_drug_list($filter) {
        $drugimage_model = new DrugimageModel();
        $ret = $drugimage_model->get_drug_list($filter);
        foreach($ret as &$each)
        {
            for ($i=1;$i<8;$i++)
            {
                if (isset($each['file_name_'.$i]))
                    $each['file_name_'.$i] = '../' . $this->targetDir . $each['file_name_'.$i];
                else
                    break;
            }
            $each['image_count'] = $i-1;
        }
        return $ret;
    }
    function get_drug_one($id) {
        $drugimage_model = new DrugimageModel();
        $ret = $drugimage_model->get_drug_one($id);
        for ($i=1;$i<8;$i++)
        {
            if (isset($ret['file_name_'.$i]))
                $ret['file_name_'.$i] = '../' . $this->targetDir . $ret['file_name_'.$i];
            else
                break;
        }
        $ret['image_count'] = $i-1;
        return $ret;
    }
    function get_drug_delete($id) {
        $drugimage_model = new DrugimageModel();
        $ret = $drugimage_model->get_drug_delete($id);
        return $ret;
    }
    public function update_drug_image($form_data)
    {
        $response = array(); $response['code'] = 200;
        $data = array();
        $data['drug_image_id']          = $form_data['drug_id'];
        $data['ndc']                    = $form_data['ndc'];
        $data['generic_name']           = $form_data['generic_name'];
        $data['drug_imprint_side_1']    = $form_data['drug_imprint_side_1'];
        $data['drug_imprint_side_2']    = $form_data['drug_imprint_side_2'];
        $data['drug_color_id']          = $form_data['drug_color'];
        $data['drug_shape_id']          = $form_data['drug_shape'];
        $data['drug_image_description'] = $form_data['drug_image_description'];

        $allowTypes = array('jpg','png','jpeg','gif');
        $fileCount = (int)$form_data['file_count'];
        if ($fileCount > 0)
        {
            for ($i=0;$i<$fileCount;$i++)
            {
                $fileName = time().'_'.basename($_FILES["file" . ($i+1)]["name"]);
                $targetFilePath = $this->targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){
                    if(move_uploaded_file($_FILES["file" . ($i+1)]["tmp_name"], $targetFilePath)){
                        $data['file_name_'.($i+1)] = $fileName;
                    }else{
                        $response = array('status' => 'Error', 'code' => 400);
                    }
                }
                else
                {
                    $response = array('status' => 'Image type error', 'code' => 400);
                }
            }
        }
        if ($response['code'] == 200)
        {
            $drugimage_model = new DrugimageModel();
            $ret_id = $drugimage_model->update_drug_image($data);
            if ($ret_id != -1)
                $response['status'] = 'ok';
            else
                $response = array('status' => 'DB Error', 'code' => 400);
        }
        return $response;
    }
}
?>