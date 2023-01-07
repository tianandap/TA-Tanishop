<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_cont extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('file');
		$this->load->helper('url');
		$this->load->helper('form');
		// load model also
		$this->load->model('Admin_model');
		$this->load->model('Home_model');
	}
	function index(){		
		$session_data = $this->session->userdata('logged_in');
        $data['session_data'] = $session_data;
        $data['subcat'] = $this->Admin_model->showsubcategories();
		$data['cat']    = $this->Admin_model->showcategories();
		$data['prod']   = $this->Admin_model->products();
		
		$this->load->view('include/header',$data);
		$this->load->view('home',$data);
		$this->load->view('include/footer',$data);
	}

    function products(){ 	
        $session_data = $this->session->userdata('logged_in');
        $data['session_data'] = $session_data;
        $cat_id = $this->input->get('cat_id');
        
        $data['cats'] 	  = $this->Home_model->category($cat_id);
        $data['prod_cat'] = $this->Home_model->prod_cat($cat_id);
        $data['subcat']   = $this->Admin_model->showsubcategories();
        $data['cat']      = $this->Admin_model->showcategories();
        $data['prod']     = $this->Admin_model->products();

        $this->load->view('include/header',$data);
        $this->load->view('products',$data);
        $this->load->view('include/footer',$data);
    }

    function myaccount(){
        $session_data = $this->session->userdata('logged_in');
        $data['session_data'] = $session_data;
        $data['subcat']  = $this->Admin_model->showsubcategories();
        $data['cat']     = $this->Admin_model->showcategories();
        $data['prod']    = $this->Admin_model->products();
        $data['account'] = $this->Home_model->myaccount($session_data);

        $this->load->view('include/header',$data);
        $this->load->view('myaccount',$data);
        $this->load->view('include/footer',$data);
    }

    function orders(){
        $session_data = $this->session->userdata('logged_in');
        $data['session_data'] = $session_data;
        $data['subcat']  = $this->Admin_model->showsubcategories();
        $data['cat']     = $this->Admin_model->showcategories();
        $data['prod']    = $this->Admin_model->products();
        $data['account'] = $this->Home_model->myaccount($session_data);
        $data['orders']  = $this->Home_model->orders($session_data);

        $this->load->view('include/header',$data);
        $this->load->view('orders',$data);
        $this->load->view('include/footer',$data);
    }
}
?>