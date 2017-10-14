<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security_model extends CI_Model{
	public function __construct() {
		parent::__construct();
		$this->is_admin_logged_in();
	}
	public function is_admin_logged_in(){
		if($this->session->userdata('billing_admin_logged_in')){
			return true;
		}else{
			redirect("login");
		}
	}
	
}