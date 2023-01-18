<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_cont extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('file');
		$this->load->helper('url');
		$this->load->helper('form');
		// load model also
		$this->load->model('Admin_model');
	}

	//--------------------------------- CATEGORY ---------------------------------------------
	function Category(){
		$session_data = $this->session->userdata('logged_in');
        $data['session_data'] = $session_data;
		$data['cat'] = $this->Admin_model->showcategories();

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/category',$data);
	}

	function addcat(){
		$name = $this->input->post('name');
		$catdata = array('cat_name' => $name);
		$this->Admin_model->addcat($catdata);
	}

	function deletecat(){
		$cat_id = $this->input->post('cat_id');
		$this->Admin_model->deletecat($cat_id);
	}

	//-------------------------------- SUB - CATEGORY ----------------------------------------
	function Subcategory(){
		$session_data = $this->session->userdata('logged_in');
        $data['session_data'] = $session_data;
		$data['subcat'] = $this->Admin_model->showsubcategories();
		$data['cat']    = $this->Admin_model->showcategories();

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/subcategory',$data);
	}

	function addsubcat(){
		$name    = $this->input->post('name');
		$cat_id  = $this->input->post('cat_id');
		$subcatdata = array('sub_name' => $name, 'cat_id' => $cat_id);
		
		$this->Admin_model->addsubcat($subcatdata);
	}

	function deletesubcat(){
		$sub_id = $this->input->post('sub_id');
		$this->Admin_model->deletesubcat($sub_id);
	}
	
	//--------------------------------- PRODUCTS --------------------------------------------
	function Products(){
		$session_data = $this->session->userdata('logged_in');
        $data['session_data'] = $session_data;
        $data['subcat'] = $this->Admin_model->showsubcategories();
		$data['cat']    = $this->Admin_model->showcategories();
		$data['prod']   = $this->Admin_model->products();

		$this->load->view('admin/include/header',$data);
	}

	function Addproduct(){
		$session_data = $this->session->userdata('logged_in');
        $data['session_data'] = $session_data;
		$data['subcat'] = $this->Admin_model->showsubcategories();
		$data['cat']    = $this->Admin_model->showcategories();

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/Addproduct',$data);
	}

	function addprod(){
		$cat_id 	= $this->input->post('cat_id');
		$sub_id     = $this->input->post('sub_id');
		$prod_name  = $this->input->post('prod_name');
		$prod_desc  = $this->input->post('prod_descp');
		$prod_price = $this->input->post('prod_price');

		if (!empty($_FILES['prod_img'])){
            $r_name_img = $_FILES["prod_img"]["name"];
            $extension  = end(explode(".", $r_name_img));
            $fileName   = $r_name_img;         
            $config     = array(
	            'allowed_types' => '*',
	            'upload_path' 	=> './assets/img/',
	            'remove_spaces' => true,
	            'file_name'		=> $fileName
            );
                       
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('prod_img');
        }

        $proddata = array(
        	'cat_id' 	 => $cat_id,
        	'sub_id' 	 => $sub_id,
        	'prod_name'  => $prod_name,
        	'prod_desc'  => $prod_desc,
        	'prod_price' => $prod_price,
        	'prod_img' 	 => $fileName,	
        );
        $this->Admin_model->addprod($proddata);
		
		echo json_encode($proddata);
	}

	function deleteprod(){
		$prod_id = $this->input->post('prod_id');
		$this->Admin_model->deleteprod($prod_id);
	}

	//--------------------------------- ORDERS ----------------------------------------------
	function Orders(){
		$session_data = $this->session->userdata('logged_in');
        $data['session_data'] = $session_data;
		$data['orders'] = $this->Admin_model->orders();

        $this->load->view('admin/include/header',$data);
		$this->load->view('admin/orders',$data);
	}
}
?>