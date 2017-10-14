<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("login_model");
	}
	public function index()
	{
		if($this->session->userdata('billing_admin_logged_in')){
			redirect("admin");
		}else{
			$this->load->view('login');
		}			
	}
	public function admin_login(){
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required');	
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');	
		if ($this->form_validation->run()==false) {
			foreach($this->form_validation->error_array() as $key=>$val){
				die(json_encode(array("success"=>false,"message"=>$val)));
			}
		}else{
			$login=$this->login_model->check_login();
			if($login){
				$session=array(
					"id"=>$login->id,
					"user_name"=>$login->user_name,
					"company_logo"=>$login->company_logo,
					"email"=>$login->email,
					"billing_admin_logged_in"=>true
				);
				$this->session->set_userdata($session);	
				die(json_encode(array("success"=>true,"message"=>"Login successfully.")));
			}else{
				die(json_encode(array("success"=>false,"message"=>"Username or password invalid.")));
			}
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		$session=array(
			"id"=>"",
			"user_name"=>"",
			"company_logo"=>"",
			"email"=>"",
			"billing_admin_logged_in"=>false
		);
		$this->session->unset_userdata($session);
		redirect("login");
	}
}
