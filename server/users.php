<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once(dirname(__FILE__) . "/controller/user.php");
include_once(dirname(__FILE__) . "/controller/email.php");
if (isset($_POST)) {
    $flag  = isset($_POST['flag']) ? $_POST['flag'] : "";
    $user  = new USER();
    $email = new EMAIL();
    switch ($flag) {
        case 'register_validate':
            $error = $user->register_validate($_POST['form_data']);
            $ret   = array();
            if (empty($error))
                $ret['result'] = 'success';
            else
                $ret['result'] = 'fail';
            $ret['error'] = $error;
            echo json_encode($ret);
            break;
        case 'register':
            $token    = $user->register($_POST['form_data']);
            $ret_code = FALSE;
            if ($token != "") {
                $info             = array();
                $info['username'] = $_POST['form_data']['first_name'];
                $info['email']    = $_POST['form_data']['email'];
                $info['key']      = $token;
                $ret_code         = $email->send_confirm_email($info['email'], $info);
            }
            $ret           = array();
            $ret['result'] = 'success';
            if ($ret_code == TRUE)
                $ret['url'] = "../registration/user_register_success.php";
            else {
                $ret['result'] = FALSE;
                $ret['error']  = "An error was occured on server side. Please try it again later.";
            }
            echo json_encode($ret);
            break;
        case 'login':
            $result = $user->login($_POST['form_data']);
            if ($result['result'] != 'success') {
                $result['url'] = "../registration/user_login_failed.php";
                ;
            }
            echo json_encode($result);
            break;
        case 'forgot_pass':
            $result = $user->forgot_pass($_POST['form_data']);
            if ($result['result'] == 'success') {
                $info             = array();
                $info['email']    = $_POST['form_data']['forgot_email'];
                $info['password'] = $result['password'];
                $ret_code         = $email->send_forgot_email($info['email'], $info);
            }
            $ret           = array();
            $ret['result'] = 'success';
            if ($ret_code == TRUE)
                $ret['url'] = "../registration/forgot_password_success.php";
            else {
                $ret['result'] = FALSE;
                $ret['error']  = "An error was occured on server side. Please try it again later.";
            }
            echo json_encode($ret);
            break;
        case 'user_profile_setup_validate':
            $error = $user->profile_setup_validate($_POST['form_data']);
            $ret   = array();
            if (empty($error))
                $ret['result'] = 'success';
            else
                $ret['result'] = 'fail';
            $ret['error'] = $error;
            echo json_encode($ret);
            break;
        case 'user_profile_setup':
            $ret = $user->profile_setup($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_profile_setup_contact_info.php";
            echo json_encode($ret);
            break;
        case 'user_contact_info':
            $ret = $user->profile_setup_contact($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_profile_setup_doctor_info.php";
            echo json_encode($ret);
            break;
        case 'user_profile_doctor':
            $ret = $user->setup_profile_doctor($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_profile_setup_patient_options.php";
            echo json_encode($ret);
            break;
        case 'user_profile_patient':
            $ret = $user->setup_profile_patient($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_profile_setup_insurance_info.php";
            echo json_encode($ret);
            break;
        case 'user_profile_insurance':
            $ret = $user->profile_setup_profile_insurance($_POST);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_profile_setup_dependent.php";
            echo json_encode($ret);
            break;
        case 'user_dependent':
            $ret = $user->profile_setup_dependent($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_profile_setup_end.php";
            echo json_encode($ret);
            break;
        case 'update_address':
            $ret = $user->update_address($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'add_address':
            $ret = $user->add_address($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'add_phone':
            $ret = $user->add_phone($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'update_phone':
            $ret = $user->update_phone($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'user_add_insurance':
            $ret = $user->profile_setup_profile_insurance($_POST);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'user_update_insurance':
            $ret = $user->update_profile_insurance($_POST);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'user_add_patient_info':
            $ret = $user->setup_profile_patient($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'user_update_patient_info':
            $ret = $user->update_profile_patient($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'add_user_dependent':
            $ret = $user->profile_setup_dependent($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'update_user_dependent':
            $ret = $user->update_profile_dependent($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'add_doctor_info':
            $ret = $user->setup_profile_doctor($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'update_doctor_info':
            $ret = $user->update_profile_doctor($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success')
                $ret['url'] = "user_account.php";
            echo json_encode($ret);
            break;
        case 'profile_validate':
            $error = $user->profile_validate($_POST['form_data']);
            $ret   = array();
            if (empty($error))
                $ret['result'] = 'success';
            else
                $ret['result'] = 'fail';
            $ret['error'] = $error;
            echo json_encode($ret);
            break;
        case 'update_profile':
            $ret = $user->update_profile($_POST['form_data']);
            if ($ret != NULL && $ret['result'] == 'success') {
                $user->logout();
                $ret['url'] = "user_account.php";
            }
            echo json_encode($ret);
            break;
        default:
            # code...            break;    
    }
}
?>