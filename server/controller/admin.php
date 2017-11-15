<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__) . "/model/admin_model.php")) {
    include_once(dirname(__FILE__) . "/model/admin_model.php");
} else {
    include_once(dirname(__FILE__) . "/../model/admin_model.php");
}

class ADMIN
{
    public function __construct()
    {
    }
    public function get_admin_name()
    {
        if (isset($_SESSION['admin1234']))
            return $_SESSION['admin1234']['first_name'];
        else
            return "";
    }
    public function is_logged_in()
    {
        if (isset($_SESSION['admin1234']))
            return true;
        else
            return false;
    }
    public function logout()
    {
        session_destroy();
        if (file_exists("admin_login.php"))
            header("Location: admin_login.php");
    }
    public function get_admin()
    {
        if (isset($_SESSION['admin1234']))
            return $_SESSION['admin1234'];
        else
            return NULL;
    }
    public function get_admin_full_info()
    {
        if (isset($_SESSION['admin1234'])) {
            $admin_model = new AdminModel();
            $email      = $_SESSION['admin1234']['email'];
            $full_info  = $admin_model->get_full_info($email);
            return $full_info;
        } else
            return NULL;
    }
    public function redirect()
    {
        if (isset($_SESSION['admin1234'])) {
            header("Location: index.php");
        } else
            header("Location: admin_login.php");
    }
    public function confirm_email($email, $key)
    {
        $admin_model = new AdminModel();
        return $admin_model->confirm_email($email, $key);
    }
    public function login($form_data)
    {
        $error      = array();
        // Initialize error as blank        
        $admin_model = new AdminModel();
        $ret        = $admin_model->login($form_data);
        return $ret;
    }
    public function forgot_pass($form_data)
    {
        $error      = array();
        // Initialize error as blank        
        $admin_model = new AdminModel();
        $ret        = $admin_model->forgot_pass($form_data);
        return $ret;
    }
    public function register($form_data)
    {
        $error      = array();
        $admin_model = new AdminModel();
        $ret        = $admin_model->register($form_data);
        return $ret;
    }
    public function register_validate($form_data)
    {
        $error         = array();
        // Initialize error as blank        
        $admin_model    = new AdminModel();
        $first_name    = isset($form_data['first_name']) ? trim($form_data['first_name']) : "";
        $last_name     = isset($form_data['last_name']) ? trim($form_data['last_name']) : "";
        $email         = isset($form_data['email']) ? $form_data['email'] : "";
        $confirm_email = isset($form_data['confirm_email']) ? $form_data['confirm_email'] : "";
        $password      = isset($form_data['password']) ? $form_data['password'] : "";
        $user_level    = isset($form_data['user_level']) ? $form_data['user_level'] : "";
        $agree         = isset($form_data['agree']) ? $form_data['agree'] : "";
        if (strlen($first_name) == 0) {
            $error['first_name'] = 'Can not be blank';
        }
        if (strlen($last_name) == 0) {
            $error['last_name'] = 'Can not be blank';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Enter a valid email.';
        } else if ($admin_model->check_email($email)) {
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
        if ($user_level == "")
            $error['user_level'] = "Choose user level";
        if ($agree != "on") {
            $error['agree'] = "You must agree to the terms first.";
        }
        return $error;
    }
}
?>