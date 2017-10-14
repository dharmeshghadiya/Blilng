<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("security_model");
	}
	public function index()
	{
		$this->load->view('admin');
	}
	public function get_state(){
		$country_id=$this->input->post("country_id");
		$sql="SELECT * FROM states WHERE country_id='".$country_id."'";
		$res=$this->db->query($sql);
		foreach($res->result_Array() as $row){
			echo "<option value='".$row['id']."'>".$row['state_name']."</option>";
		}
	}
	public function get_city(){
		$state_id=$this->input->post("state_id");
		$sql="SELECT * FROM cities WHERE state_id='".$state_id."'";
		$res=$this->db->query($sql);
		foreach($res->result_Array() as $row){
			echo "<option value='".$row['id']."'>".$row['city_name']."</option>";
		}
	}
}
