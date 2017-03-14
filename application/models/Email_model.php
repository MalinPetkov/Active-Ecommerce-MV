<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Email_model extends CI_Model
{
    
    /*	
	 *	Developed by    : Active IT zone
	 *	Date	        : 14 July, 2015
	 *	Active Supershop eCommerce CMS
	 *	http://codecanyon.net/user/activeitezone
     *  Last Modified   : 18 January, 2017 
	 */
    
    function __construct()
    {
        parent::__construct();
    }
    
    
    function password_reset_email($account_type = '', $id = '', $pass = '')
    {
        $this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }
        
        $query  = $this->db->get_where($account_type, array($account_type . '_id' => $id));

        if ($query->num_rows() > 0){

            $sub    = $this->db->get_where('email_template', array('email_template_id' => 1))->row()->subject;
            $to     = $query->row()->email;
			if($account_type == 'user'){
				$to_name	= $query->row()->username;
			}else{
				$to_name	= $query->row()->name;
			}
			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 1))->row()->body;
			$email_body      = str_replace('[[to]]',$to_name,$email_body);
			$email_body      = str_replace('[[account_type]]',$account_type,$email_body);
			$email_body      = str_replace('[[password]]',$pass,$email_body);
			$email_body      = str_replace('[[from]]',$from_name,$email_body);
			
            $send_mail  = $this->do_email($from, $from_name, $to, $sub, $email_body);
            return $send_mail;
        } 
        else {
            return false;
        }
    }
    function status_email($account_type = '', $id = '')
    {
        $this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }
                
        $query = $this->db->get_where($account_type, array($account_type . '_id' => $id));

		if ($query->num_rows() > 0) {
            $sub        = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->subject;
            $to         = $query->row()->email;
			if($account_type == 'user'){
				$to_name	= $query->row()->username;
			}else{
				$to_name	= $query->row()->name;
			}
			if($query->row()->status == 'approved'){
                $status = "Approved";
            } else {
                $status = "Postponed";
            }
			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->body;
			$email_body      = str_replace('[[to]]',$to_name,$email_body);
			$email_body      = str_replace('[[account_type]]',$account_type,$email_body);
			$email_body      = str_replace('[[email]]',$to,$email_body);
			$email_body      = str_replace('[[status]]',$status,$email_body);
			$email_body      = str_replace('[[from]]',$from_name,$email_body);
			
            $send_mail  = $this->do_email($from, $from_name, $to, $sub, $email_body);
            return $send_mail;
        }
        else {
            return false;
        }
    }
    
    
    function membership_upgrade_email($vendor)
    {
        $this->load->database();
        $account_type = 'vendor';

        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }
        
        
        $query = $this->db->get_where($account_type, array($account_type . '_id' => $vendor));
		
		if ($query->num_rows() > 0) {
            $sub        = $this->db->get_where('email_template', array('email_template_id' => 3))->row()->subject;
            $to         = $query->row()->email;
			
			$to_name	= $query->row()->name;
			
			if($query->row()->membership == '0'){
                $package    = "reduced to : Default";
            } 
            else {
                $package    = "upgraded to : " . $this->db->get_where('membership',array('membership_id'=>$query->row()->membership))->row()->title;
            }
			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 3))->row()->body;
			$email_body      = str_replace('[[to]]',$to_name,$email_body);
			$email_body      = str_replace('[[account_type]]',$account_type,$email_body);
			$email_body      = str_replace('[[email]]',$to,$email_body);
			$email_body      = str_replace('[[package]]',$status,$email_body);
			$email_body      = str_replace('[[from]]',$from_name,$email_body);
			
            $send_mail  = $this->do_email($from, $from_name, $to, $sub, $email_body);
            return $send_mail;
        }
        else {
            return false;
        }
    }
    
    function account_opening($account_type = '', $email = '', $pass = '')
    {
        $this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }
        
        $to   = $email;
        $query = $this->db->get_where($account_type, array('email' => $email));
        
        if ($query->num_rows() > 0) {
			$sub        = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->subject;
			if($account_type == 'admin'){
				$password  = $pass;
				$email_body = "Thanks for your registration in : " . $from_name . "<br />";
				$email_body .= "Your account type is : " . $account_type . "<br />";
				$email_body .= "Your password is : " . $pass . "<br />";
				$email_body .= "login here: <a href='".base_url()."index.php/admin/'>".base_url()."index.php/admin</a>";
			}
			if($account_type == 'vendor'){
				$to_name	= $query->row()->name;
				$url 		= "<a href='".base_url()."index.php/vendor/'>".base_url()."index.php/vendor</a>";
				
				$email_body      = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->body;
				$email_body      = str_replace('[[to]]',$to_name,$email_body);
				$email_body      = str_replace('[[sitename]]',$from_name,$email_body);
				$email_body      = str_replace('[[account_type]]',$account_type,$email_body);
				$email_body      = str_replace('[[email]]',$to,$email_body);
				$email_body      = str_replace('[[password]]',$pass,$email_body);
				$email_body      = str_replace('[[url]]',$url,$email_body);
				$email_body      = str_replace('[[from]]',$from_name,$email_body);
			}
			if($account_type == 'user'){
				$to_name	= $query->row()->username;
				$url 		= "<a href='".base_url()."index.php/home/login_set/login'>".base_url()."index.php/home/login_set/login</a>";
				
				$email_body  = "Hello " . $to_name . ",<br />";
				$email_body .= "Thanks for your registration in : " . $from_name . "<br />";
				$email_body .= "Your account type is : " . $account_type . "<br />";
				$email_body .= "Your email is : " . $to . "<br />";
				$email_body .= "Your password is : " . $pass . "<br />";
				$email_body .= "login here: ".$url;
			}
			$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
            return $send_mail;
        }
        else {
            return false;
        }
    }
    
    
    
    function newsletter($title = '', $text = '', $email = '', $from = '')
    {
        $from_name  = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
        $this->do_email($from, $from_name, $email, $title, $text);
    }
    
    
    
    /***custom email sender****/
    
    function do_email($from = '', $from_name = '', $to = '', $sub ='', $msg ='')
    {   
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from($from, $from_name);
        $this->email->to($to);        
        $this->email->subject($sub);
        $this->email->message($msg);
        
        if($this->email->send()){
            return true;
        }else{
            //echo $this->email->print_debugger();
            return false;
        }
        //echo $this->email->print_debugger();
    }
    
    
    
}