<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthCont extends CI_Controller {

	private $msg;
	private $exp_time = 60 * 5;

	function __construct() {
		parent::__construct();
		$this->load->library('authlibrary');
		$this->load->library('form_validation');
	}

	function display_msg($msg) {
		$this->msg .= $msg . nl2br("\n");
	}

	function index() {
		$is_logged_in = $this->authlibrary->is_logged_in();

		if (!$is_logged_in) {
			redirect('authcont/login');
		}
		else {
			$this->load->view('home');
		}
	}

	function login() {
		if ($this->input->post('login')) {
			if (get_cookie('remember')) {
				$username = get_cookie('username');
				$password = get_cookie('password');

				if ($this->authlibrary->login($username, $password) == TRUE) {
					$this->session->set_flashdata('users', 'Anda Berhasil Login');
					$this->session->keep_flashdata('users');
					redirect('/');
				}
				else {
					$errors = $this->authlibrary->get_error_message();
					$this->display_msg($errors);
				}
			}
			else {
				$this->form_validation->set_rules('username', 'username', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('password', 'password', 'trim|required|max_length[100]|xss_clean');

				if ($this->form_validation->run()) {
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$remember = $this->input->post('remember');

					if ($remember) {
						set_cookie("username", $username, $this->exp_time);
						set_cookie("password", $password, $this->exp_time);
						set_cookie("remember", $remember, $this->exp_time);
					}
					else {
						delete_cookie("username");
						delete_cookie("password");
						delete_cookie("remember");
					}

					if ($this->authlibrary->login($username, $password) == TRUE) {
						$this->session->set_flashdata('users', 'Anda Berhasil Login');
						$this->session->keep_flashdata('users');
						redirect('/');
					}
					else {
						$errors = $this->authlibrary->get_error_message();
						$this->display_msg($errors);
					}
				}
			}
		}

		$data['errors'] = $this->msg;
		$data['msg'] = '';

		if ($message = $this->session->flashdata('login')) {
			$data['msg'] = $message;
		}

		$this->load->view('login', $data);
	}

	function logout() {
		if ($this->authlibrary->is_logged_in()) {
			$this->authlibrary->logout();
			$this->session->set_flashdata('users', 'Anda Berhasil Logged out');
			$this->session->keep_flashdata('users');
			
			redirect('/');
		}
		
	}

}
