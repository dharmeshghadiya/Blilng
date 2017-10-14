<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party_model extends CI_Model{
	
	public function duplicate_check(){
		$party_id 	= 	$this->input->post('party_id');
		$party_name 	= 	addslashes($this->input->post('party_name'));
		$party_code 	= 	addslashes($this->input->post('party_code'));
		
		$sql="SELECT party_name FROM party WHERE party_name='".$party_name."' AND party_code='".$party_code."'";
		if($party_id!=''){
			$sql.=" AND id!='".$party_id."'";
		}
		$res=$this->db->query($sql);
		if($res->num_rows()==1){
			return false;
		}else{
			return true;
		}
	}
	public function insert(){
		$party_name 	= 	addslashes($this->input->post('party_name'));
		$party_code 	= 	addslashes($this->input->post('party_code'));
		$address 	= 	addslashes($this->input->post('address'));
		$country_id 	= 	$this->input->post('country_id');
		$state_id 	= 	$this->input->post('state_id');
		$city_id 	= 	$this->input->post('city_id');
		$zip_code 	= 	$this->input->post('zip_code');
		$mobile_no 	= 	$this->input->post('mobile_no');
		$phone_no 	= 	$this->input->post('phone_no');
		$add_date 	= 	date("Y-m-d H:i:s");
		$add_uid 	= 	$this->session->userdata("id");
		$insert=array(
			"party_name"=>$party_name,
			"party_code"=>$party_code,
			"address"=>$address,
			"country_id"=>$country_id,
			"state_id"=>$state_id,
			"city_id"=>$city_id,
			"mobile_no"=>$mobile_no,
			"phone_no"=>$phone_no,
			"add_date"=>$add_date,
			"zip_code"=>$zip_code,
			"add_uid"=>$add_uid,
			"company_id"=>$add_uid,
		);
		$this->db->insert("party",$insert);
		$insert_id=$this->db->insert_id();
		if($insert_id){
			return true;
		}else{
			return false;
		}
	}
	public function update(){
		$party_id 	= 	$this->input->post('party_id');
		$party_name 	= 	addslashes($this->input->post('party_name'));
		$party_code 	= 	addslashes($this->input->post('party_code'));
		$address 	= 	addslashes($this->input->post('address'));
		$country_id 	= 	$this->input->post('country_id');
		$state_id 	= 	$this->input->post('state_id');
		$city_id 	= 	$this->input->post('city_id');
		$zip_code 	= 	$this->input->post('zip_code');
		$mobile_no 	= 	$this->input->post('mobile_no');
		$phone_no 	= 	$this->input->post('phone_no');	
		
		$add_date 	= 	date("Y-m-d H:i:s");
		$add_uid 	= 	$this->session->userdata("id");
		$update=array(
			"party_name"=>$party_name,
			"party_code"=>$party_code,
			"address"=>$address,
			"country_id"=>$country_id,
			"state_id"=>$state_id,
			"city_id"=>$city_id,
			"mobile_no"=>$mobile_no,
			"phone_no"=>$phone_no,
			"add_date"=>$add_date,
			"company_id"=>$add_uid,
			"add_uid"=>$add_uid,
		);
		$this->db->where("id",$party_id);
		$this->db->update("party",$update);
		return true;
		
	}
	public function last_login($user_id){
		$update=array(
			"user_agent"=>$this->agent->browser()." - ".$this->agent->version()." - ".$this->agent->mobile(),
			"platform"=>$this->agent->platform(),
			"last_login"=>date("Y-m-d H:i:s")
		);
		$this->db->where("id",$user_id);
		$this->db->update("admin",$update);
		return true;
	}
	public function get_id_wise_data($id){
		$sql="SELECT * FROM party WHERE id='".$id."'";
		$res=$this->db->query($sql);
		if($res->num_rows()==1){
			return $res->row();
		}else{
			return false;
		}
	}
	
}