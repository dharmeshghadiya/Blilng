<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill_model extends CI_Model{
	
	
	public function insert(){
		$bill_no 	= 	$this->input->post('bill_no');
		$truck_no 	= 	$this->input->post('truck_no');
		$consignor 	= 	$this->input->post('consignor');
		$consignee 	= 	$this->input->post('consignee');
		$from_destination 	= 	$this->input->post('from_destination');
		$to_destination 	= 	$this->input->post('to_destination');
		$actual_weight 	= 	$this->input->post('actual_weight');
		$charge_kg 	= 	$this->input->post('charge_kg');
		$rate_kg 	= 	$this->input->post('rate_kg');
		$pay_or_not_pay 	= 	$this->input->post('pay_or_not_pay');
		$pay_paid_price 	= 	$this->input->post('pay_paid_price');
		$hamali 	= 	$this->input->post('hamali');
		$cc 	= 	$this->input->post('cc');
		$bc 	= 	$this->input->post('bc');
		$total 	= 	$this->input->post('total');
		$gst_tax 	= 	$this->input->post('gst_tax');
		$grand_total 	= 	$this->input->post('grand_total');
		$ramarks 	= 	$this->input->post('ramarks');
		$delivery_at 	= 	$this->input->post('delivery_at');
		$price_in_word 	= 	$this->input->post('price_in_word');
		$biil_date 	= 	$this->input->post('biil_date');
		$add_date 	= 	date("Y-m-d H:i:s");
		$add_uid 	= 	$this->session->userdata("id");
		$insert=array(
			"bill_no"=>$bill_no,
			"truck_no"=>$truck_no,
			"consignor"=>$consignor,
			"consignee"=>$consignee,
			"from_destination"=>$from_destination,
			"to_destination"=>$to_destination,
			"actual_weight"=>$actual_weight,
			"charge_kg"=>$charge_kg,
			"pay_or_not_pay"=>$pay_or_not_pay,
			"pay_paid_price"=>$pay_paid_price,
			"hamali"=>$hamali,
			"cc"=>$cc,
			"bc"=>$bc,
			"total"=>$total,
			"gst_tax"=>$gst_tax,
			"grand_total"=>$grand_total,
			"ramarks"=>$ramarks,
			"delivery_at"=>$delivery_at,
			"price_in_word"=>$price_in_word,
			"biil_date"=>$biil_date,
			"add_date"=>$add_date,
			"add_uid"=>$add_uid,
			"company_id"=>$add_uid,
		);
		$this->db->insert("bill",$insert);
		$insert_id=$this->db->insert_id();
		if($insert_id){
			$product=$this->input->post("group-a");
			foreach($product as $key=>$val){
				if($val['product_name']!=''){
					$insert=array(
						"product_name"=>$val['product_name'],
						"product_weight"=>$val['product_weight'],
						"company_id"=>$add_uid,
						"bill_id"=>$insert_id,
						"add_date"=>$add_date,
					);
					$this->db->insert("bill_product",$insert);
				}	
			}
			
			$sql="SELECT * FROM truck_master WHERE truck_no='".$truck_no."' AND company_id='".$add_uid."'";
			$res=$this->db->query($sql);
			if($res->num_rows()==0){
				$insert=array(
					"truck_no"=>$truck_no,
					"company_id"=>$add_uid,
				);
				$this->db->insert("truck_master",$insert);
			}
			return true;
		}else{
			return false;
		}
		
		
	}
	public function update(){
		$bill_id 	= 	$this->input->post('bill_id');
		$bill_name 	= 	addslashes($this->input->post('bill_name'));
		$bill_code 	= 	addslashes($this->input->post('bill_code'));
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
			"bill_name"=>$bill_name,
			"bill_code"=>$bill_code,
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
		$this->db->where("id",$bill_id);
		$this->db->update("bill",$update);
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
		$sql="SELECT * FROM bill WHERE id='".$id."'";
		$res=$this->db->query($sql);
		if($res->num_rows()==1){
			return $res->row();
		}else{
			return false;
		}
	}
	
}