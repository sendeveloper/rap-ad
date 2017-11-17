<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once(dirname(__FILE__) . "/controller/admin.php");
include_once(dirname(__FILE__) . "/controller/drugcolor.php");
include_once(dirname(__FILE__) . "/controller/drugshape.php");
include_once(dirname(__FILE__) . "/controller/drugimage.php");
include_once(dirname(__FILE__) . "/controller/drugproperty.php");

include_once(dirname(__FILE__) . "/controller/email.php");
if (isset($_POST)) {
    $flag  = isset($_POST['flag']) ? $_POST['flag'] : "";
    $admin  = new ADMIN();
    $email = new EMAIL();
    switch ($flag) {
        case 'register_validate':
            $error = $admin->register_validate($_POST['form_data']);
            $ret   = array();
            if (empty($error))
                $ret['result'] = 'success';
            else
                $ret['result'] = 'fail';
            $ret['error'] = $error;
            echo json_encode($ret);
            break;
        case 'register':
            $token    = $admin->register($_POST['form_data']);
            $ret_code = FALSE;
            if ($token != "") {
                $info             = array();
                $info['adminname'] = $_POST['form_data']['first_name'];
                $info['email']    = $_POST['form_data']['email'];
                $info['key']      = $token;
                $ret_code         = $email->send_confirm_email($info['email'], $info);
            }
            $ret           = array();
            $ret['result'] = 'success';
            if ($ret_code == TRUE)
                $ret['url'] = "admin_register_success.php";
            else {
                $ret['result'] = FALSE;
                $ret['error']  = "An error was occured on server side. Please try it again later.";
            }
            echo json_encode($ret);
            break;
        case 'login':
            $result = $admin->login($_POST['form_data']);
            if ($result['result'] != 'success') {
                $result['url'] = "admin_login_failed.php";
                ;
            }
            echo json_encode($result);
            break;
        case 'forgot_pass':
            $result = $admin->forgot_pass($_POST['form_data']);
            if ($result['result'] == 'success') {
                $info             = array();
                $info['email']    = $_POST['form_data']['forgot_email'];
                $info['password'] = $result['password'];
                $ret_code         = $email->send_forgot_email($info['email'], $info);
            }
            $ret           = array();
            $ret['result'] = 'success';
            if ($ret_code == TRUE)
                $ret['url'] = "forgot_password_success.php";
            else {
                $ret['result'] = FALSE;
                $ret['error']  = "An error was occured on server side. Please try it again later.";
            }
            echo json_encode($ret);
            break;
        // Drug Color
        case 'drug_color_insert':
            $drug_color = new Drugcolor();
            $ret = $drug_color->insert_drug_color($_POST);
            if ($ret['code'] == 200)
                $ret['url'] = "drug_color_list.php";
            echo json_encode($ret);
            break;
        case 'drug_color_list':
            $drug_color = new Drugcolor();
            $data = $drug_color->get_drug_list();
            $ret = array('code' => 200, 'data' => $data);
            echo json_encode($ret);
            break;
        case 'drug_color_one':
            $drug_color = new Drugcolor();
            if (isset($_POST['id']) && (int)$_POST['id'] > 0)
                $data = $drug_color->get_drug_one($_POST['id']);
            else
                $data = array();
            if (count($data) > 0)
                $ret = array('code' => 200, 'data' => $data);
            else
                $ret = array('code' => 400, 'status' => "Error", 'msg' => "Sorry, you can not get the required data from the database");
            echo json_encode($ret);
            break;
        case 'drug_color_delete':
            $drug_color = new Drugcolor();
            if (isset($_POST['id']) && (int)$_POST['id'] > 0)
                $data = $drug_color->get_drug_delete($_POST['id']);
            else
                $data = -1;
            if ($data > 0)
                $ret = array('code' => 200);
            else
                $ret = array('code' => 400, 'status' => "Error", 'msg' => "Sorry, you can not delete the required data");
            echo json_encode($ret);
            break;
        case 'drug_color_update':
            $drug_color = new Drugcolor();
            $ret = $drug_color->update_drug_color($_POST);
            if ($ret['code'] == 200)
                $ret['url'] = "drug_color_list.php";
            echo json_encode($ret);
            break;

        // Drug Shape
        case 'drug_shape_insert':
            $drug_shape = new Drugshape();
            $ret = $drug_shape->insert_drug_shape($_POST);
            if ($ret['code'] == 200)
                $ret['url'] = "drug_shape_list.php";
            echo json_encode($ret);
            break;
        case 'drug_shape_list':
            $drug_shape = new Drugshape();
            $data = $drug_shape->get_drug_list();
            $ret = array('code' => 200, 'data' => $data);
            echo json_encode($ret);
            break;
        case 'drug_shape_one':
            $drug_shape = new Drugshape();
            if (isset($_POST['id']) && (int)$_POST['id'] > 0)
                $data = $drug_shape->get_drug_one($_POST['id']);
            else
                $data = array();
            if (count($data) > 0)
                $ret = array('code' => 200, 'data' => $data);
            else
                $ret = array('code' => 400, 'status' => "Error", 'msg' => "Sorry, you can not get the required data from the database");
            echo json_encode($ret);
            break;
        case 'drug_shape_delete':
            $drug_shape = new Drugshape();
            if (isset($_POST['id']) && (int)$_POST['id'] > 0)
                $data = $drug_shape->get_drug_delete($_POST['id']);
            else
                $data = -1;
            if ($data > 0)
                $ret = array('code' => 200);
            else
                $ret = array('code' => 400, 'status' => "Error", 'msg' => "Sorry, you can not delete the required data");
            echo json_encode($ret);
            break;
        case 'drug_shape_update':
            $drug_shape = new Drugshape();
            $ret = $drug_shape->update_drug_shape($_POST);
            if ($ret['code'] == 200)
                $ret['url'] = "drug_shape_list.php";
            echo json_encode($ret);
            break;

		// Drug Image
        case 'drug_image_insert_auto':
            $drug_property = new Drugproperty();
            $ndc_data = $drug_property->get_drug_simple_list();
            $drug_color = new Drugcolor();
            $color_data = $drug_color->get_drug_list();
            $drug_shape = new Drugshape();
            $shape_data = $drug_shape->get_drug_list();
            $ret = array('code' => 200, 'ndc_data' => $ndc_data, 
            			'color_data' => $color_data, 'shape_data' => $shape_data);
            echo json_encode($ret);
            break;
        case 'drug_image_insert':
            $drug_image = new Drugimage();
            $ret = $drug_image->insert_drug_image($_POST);
            if ($ret['code'] == 200)
                $ret['url'] = "drug_image_list.php";
            echo json_encode($ret);
            break;
        case 'drug_image_list_auto':
            $drug_image = new Drugimage();
            $ndc_data = $drug_image->get_drug_simple_list();
            $ret = array('code' => 200, 'ndc_data' => $ndc_data);
            echo json_encode($ret);
            break;
        case 'drug_image_list':
            $drug_image = new Drugimage();
            $data = $drug_image->get_drug_list($_POST['filter']);
            $ret = array('code' => 200, 'data' => $data);
            echo json_encode($ret);
            break;
        case 'drug_image_one':
            $drug_image = new Drugimage();
            if (isset($_POST['id']) && (int)$_POST['id'] > 0)
                $data = $drug_image->get_drug_one($_POST['id']);
            else
                $data = array();
            if (count($data) > 0)
                $ret = array('code' => 200, 'data' => $data);
            else
                $ret = array('code' => 400, 'status' => "Error", 'msg' => "Sorry, you can not get the required data from the database");
            echo json_encode($ret);
            break;
        case 'drug_image_update_one':
            $drug_image = new Drugimage();
            $ndc_data = array();
            $color_data = array();
            $shape_data = array();
            if (isset($_POST['id']) && (int)$_POST['id'] > 0){
                $data = $drug_image->get_drug_one($_POST['id']);
                $drug_property = new Drugproperty();
                $ndc_data = $drug_property->get_drug_simple_list();
                $drug_color = new Drugcolor();
                $color_data = $drug_color->get_drug_list();
                $drug_shape = new Drugshape();
                $shape_data = $drug_shape->get_drug_list();
            }
            else
                $data = array();
            if (count($data) > 0)
                $ret = array('code' => 200, 'data' => $data, 'ndc_data' => $ndc_data, 
                        'color_data' => $color_data, 'shape_data' => $shape_data);
            else
                $ret = array('code' => 400, 'status' => "Error", 'msg' => "Sorry, you can not get the required data from the database");
            echo json_encode($ret);
            break;
        case 'drug_image_delete':
            $drug_image = new Drugimage();
            if (isset($_POST['id']) && (int)$_POST['id'] > 0)
                $data = $drug_image->get_drug_delete($_POST['id']);
            else
                $data = -1;
            if ($data > 0)
                $ret = array('code' => 200);
            else
                $ret = array('code' => 400, 'status' => "Error", 'msg' => "Sorry, you can not delete the required data");
            echo json_encode($ret);
            break;
        case 'drug_image_update':
            $drug_image = new Drugimage();
            $ret = $drug_image->update_drug_image($_POST);
            if ($ret['code'] == 200)
                $ret['url'] = "drug_image_list.php";
            echo json_encode($ret);
            break;
        default:
            # code...            break;    
    }
}
?>