<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AuthLibrary {

    private $ci;
    private $msg;

    function __construct() {
        $this->ci = & get_instance();
		$this->ci->load->model('authmodel');
    }

    /*
     * get message
     */

    private function get_msg($msg) {
        $this->msg .= $msg . nl2br("\n");
    }

    /*
     * display message
     */

    function display_msg() {
        return $this->msg;
    }

    function login($username, $password) {
        if ((strlen($username) > 0) AND (strlen($password) > 0)) {
			$user = $this->ci->authmodel->get_user($username, $password);
			
            if ($user !== NULL) {
				$this->ci->session->set_userdata(array(
					'user_name' => $user->username,
					'last_login' => $user->last_login
				));
                return TRUE;
            } else {
                $this->get_msg('Incorrect username or password');
            }
        }
		
        return FALSE;
    }

    
    function logout() {
        $this->ci->session->set_userdata(array('user_name' => '', 'last_login' => ''));
        $this->ci->session->sess_destroy();
    }

    
    function is_logged_in() {
        if($this->ci->session->userdata('user_name') && ($this->ci->session->userdata('user_name') !== NULL || $this->ci->session->userdata('user_name') !== '')) {
			return TRUE;
		}
		
		return FALSE;
    }

    function get_username() {
        if ($this->ci->session->userdata('user_name')) {
            return $this->ci->session->userdata('user_name');
        }
        return '';
    }

    function get_error_message() {
        return $this->msg;
    }

}