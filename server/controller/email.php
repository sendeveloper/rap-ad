<?php 

class EMAIL{
	public function __construct(){}
	private function format_email($info, $format)
	{
		include_once("variables.php");        
		$link_url = SITEURL . "/users/registration/user_check_confirm_email.php";        
		//grab the template content        
		$template = file_get_contents('mail_template/signup_template.'.$format);                        
		//replace all the tags        
		$template = ereg_replace('{USERNAME}', $info['username'], $template);        
		$template = ereg_replace('{EMAIL}', $info['email'], $template);        
		$template = ereg_replace('{KEY}', $info['key'], $template);        
		$template = ereg_replace('{SITEPATH}',$link_url, $template);        
		//return the html of the template        
		return $template;   
	}				
	private function format_forgot_email($info, $format)    {
		include_once("variables.php");        
		$link_url = SITEURL . "/users/registration/user_login.php";        
		//grab the template content        
		$template = file_get_contents('mail_template/forgot_password_template.'.$format);        
		//replace all the tags        
		$template = ereg_replace('{EMAIL}', $info['email'], $template);        
		$template = ereg_replace('{PASSWORD}', $info['password'], $template);        
		$template = ereg_replace('{SITEPATH}', $link_url, $template);        
		//return the html of the template        
		return $template;    
	}				
	private function util_mail($from, $to, $subject, $message) {        
		$headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: $from" . "\r\n" .
            "Reply-To: $from" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();      
		
		$public_email = "contactus@redapplepharmacy.com";
        mail($public_email, $subject, $message, $headers);      
		return mail($to, $subject, $message, $headers);    
	}				
	public function send_forgot_email($to, $info){
	    include_once("variables.php");
        $site_name = SITEURL;
        $from = SENDER_EMAIL;
		$message = $this->format_forgot_email($info,'html');        
		$rand = date("Y_m_d_h_i_s");        
		file_put_contents("mail_template/forgot/forgot_pass_mail$rand.html", $message);        
		$subject = "Welcome to $site_name";        
		return $this->util_mail($from, $to, $subject, $message);        
		// return true;    
	}				
	public function send_confirm_email($to, $info){
	    include_once("variables.php");
        $site_name = SITEURL;
        $from = SENDER_EMAIL;
		$message = $this->format_email($info,'html');       
		$rand = date("Y_m_d_h_i_s");        
		file_put_contents("mail_template/confirm/confirm_mail$rand.html", $message);        
		$subject = "Welcome to $site_name";        
		return $this->util_mail($from, $to, $subject, $message);        
		// return true;    
	}
}
?>