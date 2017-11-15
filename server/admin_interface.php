<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once(dirname(__FILE__) . "/controller/admin.php");
include_once(dirname(__FILE__) . "/controller/drugcolor.php");

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
        default:
            # code...            break;    
    }
}
?>