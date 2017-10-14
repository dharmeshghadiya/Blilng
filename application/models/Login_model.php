<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
	
	public function check_login(){
		$sql="SELECT * FROM company_master WHERE user_name='".$this->input->post("user_name")."' AND password='".md5($this->input->post("password"))."' AND status='1'";
		$res=$this->db->query($sql);
		if($res->num_rows()==1){
			return $res->row();
		}else{
			return false;
		}
	}
	public function last_login($user_id){
		$update=array(
			"user_agent"=>$this->agent->browser()." - ".$this->agent->version()." - ".$this->agent->mobile(),
			"platform"=>$this->agent->platform(),
			"last_login"=>date("Y-m-d H:i:s")
		);
		$this->db->where("id",$user_id);
		$this->db->update("company_master",$update);
		return true;
	}
	
}