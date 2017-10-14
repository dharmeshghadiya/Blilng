<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_model extends CI_Model{
	
	public function duplicate_check(){
		$membership_id 	= 	$this->input->post('membership_id');
		$membership_name 	= 	addslashes($this->input->post('membership_name'));
		
		$sql="SELECT membership_name FROM member_ship WHERE membership_name='".$membership_name."'";
		if($membership_id!=''){
			$sql.=" AND id!='".$membership_id."'";
		}
		$res=$this->db->query($sql);
		if($res->num_rows()==1){
			return false;
		}else{
			return true;
		}
	}
	public function insert(){
		$sql="SELECT max(priority) as priority FROM member_ship";
		$res=$this->db->query($sql);
		$row=$res->row();
		$priority=$row->priority+1;
		
		$membership_name 		= 	addslashes($this->input->post('membership_name'));
		$membership_details 	= 	addslashes($this->input->post('membership_details'));
		$membership_period 		= 	$this->input->post('membership_period');
		$price 					= 	$this->input->post('price');
		$add_date 				= 	date("Y-m-d H:i:s");
		$add_uid 				= 	$this->session->userdata("id");
		$insert=array(
			"membership_name"=>$membership_name,
			"membership_details"=>$membership_details,
			"membership_period"=>$membership_period,
			"price"=>$price,
			"priority"=>$priority,
			"add_date"=>$add_date,
			"add_uid"=>$add_uid,
		);
		$this->db->insert("member_ship",$insert);
		$insert_id=$this->db->insert_id();
		if($insert_id){
			return true;
		}else{
			return false;
		}
	}
	public function update(){
		$membership_id 			= 	$this->input->post('membership_id');
		$membership_name 		= 	addslashes($this->input->post('membership_name'));
		$membership_details 	= 	addslashes($this->input->post('membership_details'));
		$membership_period 		= 	$this->input->post('membership_period');
		$price 					= 	$this->input->post('price');
		$add_date 	= 	date("Y-m-d H:i:s");
		$add_uid 	= 	$this->session->userdata("id");
		$update=array(
			"membership_name"=>$membership_name,
			"membership_details"=>$membership_details,
			"membership_period"=>$membership_period,
			"price"=>$price,
			"modified_date"=>$add_date,
		);
		$this->db->where("id",$membership_id);
		$this->db->update("member_ship",$update);
		return true;
		
	}
	public function get_id_wise_data($id){
		$sql="SELECT * FROM member_ship WHERE id='".$id."'";
		$res=$this->db->query($sql);
		if($res->num_rows()==1){
			return $res->row();
		}else{
			return false;
		}
	}
	
}