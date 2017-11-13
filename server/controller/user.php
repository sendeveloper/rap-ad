<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__) . "/model/user_model.php")) {
    include_once(dirname(__FILE__) . "/model/user_model.php");
    include_once(dirname(__FILE__) . "/model/user_address_model.php");
    include_once(dirname(__FILE__) . "/model/user_contact_info_model.php");
    include_once(dirname(__FILE__) . "/model/user_doctor_profile_model.php");
    include_once(dirname(__FILE__) . "/model/user_patient_profile_model.php");
    include_once(dirname(__FILE__) . "/model/user_profile_insurance_model.php");
    include_once(dirname(__FILE__) . "/model/user_profile_dependent_model.php");
} else {
    include_once(dirname(__FILE__) . "/../model/user_model.php");
    include_once(dirname(__FILE__) . "/../model/user_address_model.php");
    include_once(dirname(__FILE__) . "/../model/user_contact_info_model.php");
    include_once(dirname(__FILE__) . "/../model/user_doctor_profile_model.php");
    include_once(dirname(__FILE__) . "/../model/user_patient_profile_model.php");
    include_once(dirname(__FILE__) . "/../model/user_profile_insurance_model.php");
    include_once(dirname(__FILE__) . "/../model/user_profile_dependent_model.php");
}

class USER
{
    public function __construct()
    {
    }
    public function get_user_name()
    {
        if (isset($_SESSION['user1234']))
            return $_SESSION['user1234']['first_name'];
        else
            return "";
    }
    public function is_logged_in()
    {
        if (isset($_SESSION['user1234']))
            return true;
        else
            return false;
    }
    public function logout()
    {
        session_destroy();
        if (file_exists("user_login.php"))
            header("Location: user_login.php");
    }
    public function get_user()
    {
        if (isset($_SESSION['user1234']))
            return $_SESSION['user1234'];
        else
            return NULL;
    }
    public function get_user_full_info()
    {
        if (isset($_SESSION['user1234'])) {
            $user_model = new UserModel();
            $email      = $_SESSION['user1234']['email'];
            $full_info  = $user_model->get_full_info($email);
            return $full_info;
        } else
            return NULL;
    }
    public function redirect()
    {
        if (isset($_SESSION['user1234'])) {
            if ($_SESSION['user1234']['profile_setup'] == 'No')
                header("Location: ../profile/user_profile_setup.php");
            else
                header("Location: ../profile/user_profile_setup.php");
        } else
            header("Location: user_login.php");
    }
    public function confirm_email($email, $key)
    {
        $user_model = new UserModel();
        return $user_model->confirm_email($email, $key);
    }
    public function login($form_data)
    {
        $error      = array();
        // Initialize error as blank        
        $user_model = new UserModel();
        $ret        = $user_model->login($form_data);
        return $ret;
    }
    public function forgot_pass($form_data)
    {
        $error      = array();
        // Initialize error as blank        
        $user_model = new UserModel();
        $ret        = $user_model->forgot_pass($form_data);
        return $ret;
    }
    public function register($form_data)
    {
        $error      = array();
        $user_model = new UserModel();
        $ret        = $user_model->register($form_data);
        return $ret;
    }
    public function register_validate($form_data)
    {
        $error         = array();
        // Initialize error as blank        
        $user_model    = new UserModel();
        $first_name    = isset($form_data['first_name']) ? trim($form_data['first_name']) : "";
        $last_name     = isset($form_data['last_name']) ? trim($form_data['last_name']) : "";
        $email         = isset($form_data['email']) ? $form_data['email'] : "";
        $confirm_email = isset($form_data['confirm_email']) ? $form_data['confirm_email'] : "";
        $password      = isset($form_data['password']) ? $form_data['password'] : "";
        $agree         = isset($form_data['agree']) ? $form_data['agree'] : "";
        if (strlen($first_name) == 0) {
            $error['first_name'] = 'Can not be blank';
        }
        if (strlen($last_name) == 0) {
            $error['last_name'] = 'Can not be blank';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Enter a valid email.';
        } else if ($user_model->check_email($email)) {
            $error['email'] = 'Already existed';
        }
        if (!filter_var($confirm_email, FILTER_VALIDATE_EMAIL)) {
            $error['confirm_email'] = 'Enter a valid email';
        } else if ($email != $confirm_email) {
            $error['confirm_email'] = 'Not same';
        }
        if (strlen($password) < '8') {
            $error['password'] = "Password should be at least 8 characters!";
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $error['password'] = "Password should contain at least 1 number!";
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $error['password'] = "Password should contain at least 1 capital letter!";
        }
        if ($agree != "on") {
            $error['agree'] = "You must agree to the terms first.";
        }
        return $error;
    }
    public function profile_validate($form_data)
    {
        $error            = array();
        // Initialize error as blank        
        $user_model       = new UserModel();
        $first_name       = isset($form_data['first_name']) ? trim($form_data['first_name']) : "";
        $last_name        = isset($form_data['last_name']) ? trim($form_data['last_name']) : "";
        $password         = isset($form_data['password']) ? $form_data['password'] : "";
        $password_confirm = isset($form_data['password_confirm']) ? $form_data['password_confirm'] : "";
        if (strlen($first_name) == 0) {
            $error['first_name'] = 'Can not be blank';
        }
        if (strlen($last_name) == 0) {
            $error['last_name'] = 'Can not be blank';
        }
        if (strlen($password) < '8') {
            $error['password'] = "Password should be at least 8 characters!";
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $error['password'] = "Password should contain at least 1 number!";
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $error['password'] = "Password should contain at least 1 capital letter!";
        }
        if ($password_confirm != $password) {
            $error['password_confirm'] = "Confirm password doesn't match";
        }
        return $error;
    }
    public function profile_setup_validate($form_data)
    {
        $error = array();
        // Initialize error as blank        
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_address = new UserAddressModel();
            $user_id      = $user['user_id'];
            if ($user_address->check_user_id($user_id)) {
                $user['alternate'] = 'You already have profile information';
            } else {
                if (strlen($form_data['address']) == "")
                    $error['address'] = 'Input address';
                if (strlen($form_data['address_type']) == "")
                    $error['address_type'] = 'Select address type';
                if (strlen($form_data['birthdate']) == "")
                    $error['birthdate'] = 'Input birthplace';
                if (strlen($form_data['gender']) == "")
                    $error['gender'] = 'Select gender';
            }
        } else
            $user['alternate'] = 'Please log in first to access this page';
        return $error;
    }
    public function profile_setup($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_address_model = new UserAddressModel();
            $user_id            = $user['user_id'];
            $ret                = $user_address_model->register_profile($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function update_profile($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_model = new UserModel();
            $user_id    = $user['user_id'];
            $ret        = $user_model->update_profile($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function profile_setup_contact($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_contact_info_model = new UserContactInfoModel();
            $user_id                 = $user['user_id'];
            $ret                     = $user_contact_info_model->register_contact_info($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function setup_profile_doctor($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_doctor_profile_model = new UserDoctorProfileModel();
            $user_id                   = $user['user_id'];
            $ret                       = $user_doctor_profile_model->register_profile_doctor($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function update_profile_doctor($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_doctor_profile_model = new UserDoctorProfileModel();
            $user_id                   = $user['user_id'];
            $ret                       = $user_doctor_profile_model->update_profile_doctor($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function setup_profile_patient($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_patient_profile_model = new UserPatientProfileModel();
            $user_id                    = $user['user_id'];
            $ret                        = $user_patient_profile_model->register_profile_patient($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function update_profile_patient($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_patient_profile_model = new UserPatientProfileModel();
            $user_id                    = $user['user_id'];
            $ret                        = $user_patient_profile_model->update_profile_patient($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function profile_setup_profile_insurance($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $files = "";
            if (isset($_FILES['card_image'])) {
                $len = sizeof($_FILES['card_image']['name']);
                for ($i = 0; $i < $len; $i++) {
                    $id            = uniqid();
                    $temp          = explode(".", $_FILES['card_image']['name'][$i]);
                    $extension     = end($temp);
                    $photo_name    = "photo_" . $id . "." . $extension;
                    $uploaded_path = "uploads/card_image/" . $photo_name;
                    $files .= $photo_name . ", ";
                    move_uploaded_file($_FILES['card_image']['tmp_name'][$i], $uploaded_path);
                }
                if (strlen($files) > 0) {
                    $files = substr($files, 0, strlen($files) - 2);
                }
            }
            $user_profile_insurance_model = new UserProfileInsuranceModel();
            $user_id                      = $user['user_id'];
            $form_data['card_image']      = $files;
            $ret                          = $user_profile_insurance_model->register_profile_insurance($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function update_profile_insurance($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $files = "";
            if (isset($_FILES['card_image'])) {
                $len = sizeof($_FILES['card_image']['name']);
                for ($i = 0; $i < $len; $i++) {
                    $id            = uniqid();
                    $temp          = explode(".", $_FILES['card_image']['name'][$i]);
                    $extension     = end($temp);
                    $photo_name    = "photo_" . $id . "." . $extension;
                    $uploaded_path = "uploads/card_image/" . $photo_name;
                    $files .= $photo_name . ", ";
                    move_uploaded_file($_FILES['card_image']['tmp_name'][$i], $uploaded_path);
                }
                if (strlen($files) > 0) {
                    $files = substr($files, 0, strlen($files) - 2);
                }
            }
            $user_profile_insurance_model = new UserProfileInsuranceModel();
            $user_id                      = $user['user_id'];
            $form_data['card_image']      = $files;
            $ret                          = $user_profile_insurance_model->update_profile_insurance($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function profile_setup_dependent($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_profile_dependent_model = new UserProfileDependentModel();
            $user_id                      = $user['user_id'];
            $ret                          = $user_profile_dependent_model->register_profile_dependent($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function update_profile_dependent($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_profile_dependent_model = new UserProfileDependentModel();
            $user_id                      = $user['user_id'];
            $ret                          = $user_profile_dependent_model->update_profile_dependent($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function update_address($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_address_model = new UserAddressModel();
            $user_id            = $user['user_id'];
            $ret                = $user_address_model->update_address($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function add_address($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_address_model = new UserAddressModel();
            $user_id            = $user['user_id'];
            $ret                = $user_address_model->add_address($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function add_phone($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_address_model = new UserAddressModel();
            $user_id            = $user['user_id'];
            $ret                = $user_address_model->add_phone($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
    public function update_phone($form_data)
    {
        $error = array();
        $user  = $this->get_user();
        if ($user != NULL) {
            $user_address_model = new UserAddressModel();
            $user_id            = $user['user_id'];
            $ret                = $user_address_model->update_phone($user_id, $form_data);
        } else
            $ret = array(
                'result' => 'fail',
                'msg' => 'Please log in first to access this page'
            );
        return $ret;
    }
}
?>