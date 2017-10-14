<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("security_model");
		$this->load->model("party_model");
	}
	public function index()
	{
		$this->load->view('party_list');
	}
	public function get_party_list(){
		$sql="SELECT p.*,c.city_name,cm.country_name,s.state_name FROM party p,cities c, countries cm, states s WHERE p.del_date is NULL AND p.city_id=c.id AND p.country_id=cm.id AND p.state_id=s.id";
		$res=$this->db->query($sql);
		$recordsTotal=$res->num_rows();
		
		if($_REQUEST['search']['value']!='')
		{
			$sql.=" AND (p.party_name LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR p.party_name LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR p.mobile_no LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR p.phone_no LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR c.city_name LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR cm.country_name LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR s.state_name LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR p.address LIKE '%".$_REQUEST['search']['value']."%')";
		}
		$sql.=" AND p.company_id='".$this->session->userdata("id")."' ORDER BY p.id DESC";
		$res=$this->db->query($sql);
		$recordsFiltered=$res->num_rows();
		$data=array();
		$i=$_REQUEST['start']+1;
		foreach($res->result_Array() as $row)
		{
			$url=site_url("party/form?id=").$row['id'];
			$html = '<button  onclick="viewmenu(\''.$url.'\')" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>';
			$html .= '&nbsp;<button  onclick="delete_party('.$row['id'].')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
			if($row['status']=='active'){
				$status='<button type="button" class="btn btn-sm btn-success" onclick="change_status('.$row['id'].',0)">Active</button>';
			}else if($row['status']=='deactive'){
				$status='<button type="button" class="btn btn-sm btn-danger" onclick="change_status('.$row['id'].',1)">Deactive</button>';
			}
			$nested=array();
			$nested[]=$i;
			$nested[]=ucfirst($row['party_name']);
			$nested[]=ucfirst($row['address'])." ".$row['city_name']." ".$row['state_name']." ".$row['country_name']." ".$row['zip_code'];
			$nested[]=$row['mobile_no'];
			$nested[]=$row['phone_no'];
			$nested[]=$html;
			$data[]=$nested;
			$i++;
		}
		
		die(
			json_encode(
				array(
					"draw"            => isset ( $_REQUEST['draw'] ) ?  intval( $_REQUEST['draw'] ) : 0,
					"recordsTotal"    => intval( $recordsTotal ),
					"recordsFiltered" => intval( $recordsFiltered ),
					"data"            => $data
				)
			)
		);
	}
	public function form(){
		$id=$this->input->get("id");
		if($id!='')
		{
			$data=array();
			$data=$this->party_model->get_id_wise_data($id);
			$this->load->view("party_form",$data);
		}
		else
		{
			$this->load->view("party_form");
		}		
	}
	public function form_submit(){
		$this->form_validation->set_rules('party_name', 'party Name', 'trim|required');	
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|min_length[10]');	
		$this->form_validation->set_rules('phone_no', 'Phone No', 'trim|min_length[6]');	
		$this->form_validation->set_rules('address', 'Address', 'trim|required');	
		$this->form_validation->set_rules('country_id', 'country_id', 'trim|required');	
		$this->form_validation->set_rules('state_id', 'state_id', 'trim|required');	
		$this->form_validation->set_rules('city_id', 'city_id', 'trim|required');	
		if ($this->form_validation->run()==false)
		{
			foreach($this->form_validation->error_array() as $key=>$val)
			{
				die(json_encode(array("success"=>false,"message"=>$val)));
			}
		}
		else
		{
			$duplicate=$this->party_model->duplicate_check();
			if($duplicate)
			{
				if($this->input->post("party_id")!='')
				{
					$update=$this->party_model->update();
					die(json_encode(array("success"=>true,"message"=>"Recored update successfully.")));
				}
				else
				{
					$insert=$this->party_model->insert();
					die(json_encode(array("success"=>true,"message"=>"Recored insert successfully.")));
				}
			}
			else
			{
				die(json_encode(array("success"=>false,"message"=>"Duplicate party found.")));
			}
		}
	}
	public function delete_party(){
		$delete_id=$this->input->post("delete_id");
		$update=array(
			"del_date"=>date("Y-m-d H:i:s"),
			"del_uid"=>$this->session->userdata("id"),
			"status"=>0
		);
		$this->db->where("id",$delete_id);
		$this->db->update("party",$update);
		die(json_encode(array("success"=>true,"message"=>"User deleted successfully.")));
	}
	
}
