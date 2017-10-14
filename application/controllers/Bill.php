<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("security_model");
		$this->load->model("bill_model");
	}
	public function index()
	{
		$this->load->view('bill_list');
	}
	public function get_bill_list(){
		$sql="SELECT  * FROM bill WHERE del_date is NULL ";
		$res=$this->db->query($sql);
		$recordsTotal=$res->num_rows();
		
		if($_REQUEST['search']['value']!='')
		{
			$sql.=" AND (bill_no LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR truck_no LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR consignor LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR consignee LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR from_destination LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR to_destination LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR pay_or_not_pay LIKE '%".$_REQUEST['search']['value']."%')";
		}
		$sql.=" AND company_id='".$this->session->userdata("id")."' ORDER BY id DESC";
		$res=$this->db->query($sql);
		$recordsFiltered=$res->num_rows();
		$data=array();
		$i=$_REQUEST['start']+1;
		foreach($res->result_Array() as $row)
		{
			$url=site_url("bill/form?id=").$row['id'];
			$html = '<button  onclick="viewmenu(\''.$url.'\')" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>';
			$html .= '&nbsp;<button  onclick="delete_bill('.$row['id'].')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
			
			$nested=array();
			$nested['bill_no']=$row['bill_no'];
			//$nested['consignor']=ucfirst($row['party_name']);
			//$nested['consignee']=ucfirst($row['party_name']);
			$nested['consignor']="";
			$nested['consignee']="";
			$nested['from_destination']=ucfirst($row['from_destination']);
			$nested['to_destination']=ucfirst($row['to_destination']);
			$nested['biil_date']=date("d.m.Y",strtotime($row['biil_date']));
			$nested['pay_or_not_pay']=$row['pay_or_not_pay'];
			$nested['grand_total']=$row['grand_total'];
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
			$data=$this->bill_model->get_id_wise_data($id);
			$this->load->view("bill_form",$data);
		}
		else
		{
			$sql="SELECT MAX(bill_no) as bill_no FROM bill WHERE company_id='".$this->session->userdata("id")."'";
			$res=$this->db->query($sql);
			if($res->num_rows()==0){
				$data['bill_no']=1;
			}else{
				$row=$res->result_Array();
				$data['bill_no']=$row[0]['bill_no']+1;
			}
			$this->load->view("bill_form",$data);
		}		
	}
	public function form_submit(){
		$this->form_validation->set_rules('bill_no', 'bill No', 'trim|required');	
		$this->form_validation->set_rules('biil_date', 'Bill Date', 'trim|required');	
		$this->form_validation->set_rules('consignor', 'consignor', 'trim|required');	
		$this->form_validation->set_rules('consignor_address', 'consignor_address', 'trim|required');	
		$this->form_validation->set_rules('from_destination', 'from_destination', 'trim|required');	
		$this->form_validation->set_rules('consignee', 'consignee', 'trim|required');	
		$this->form_validation->set_rules('consignee_address', 'consignee_address', 'trim|required');	
		$this->form_validation->set_rules('to_destination', 'to_destination', 'trim|required');	
		$this->form_validation->set_rules('group-a[]', 'product_name', 'trim|required');	
		$this->form_validation->set_rules('charge_kg', 'charge_kg', 'trim|required');	
		$this->form_validation->set_rules('rate_kg', 'rate_kg', 'trim|required');	
		$this->form_validation->set_rules('pay_paid_price', 'pay_paid_price', 'trim|required');	
		$this->form_validation->set_rules('hamali', 'hamali', 'trim|required');	
		$this->form_validation->set_rules('cc', 'cc', 'trim|required');	
		$this->form_validation->set_rules('bc', 'bc', 'trim|required');	
		$this->form_validation->set_rules('total', 'total', 'trim|required');	
		$this->form_validation->set_rules('gst_tax', 'gst_tax', 'trim|required');	
		$this->form_validation->set_rules('grand_total', 'grand_total', 'trim|required');	
		$this->form_validation->set_rules('delivery_at', 'delivery_at', 'trim|required');	
		if ($this->form_validation->run()==false)
		{
			foreach($this->form_validation->error_array() as $key=>$val)
			{
				die(json_encode(array("success"=>false,"message"=>$val)));
			}
		}
		else
		{
			
			if($this->input->post("bill_id")!='')
			{
				$update=$this->bill_model->update();
				die(json_encode(array("success"=>true,"message"=>"Recored update successfully.")));
			}
			else
			{
				$insert=$this->bill_model->insert();
				die(json_encode(array("success"=>true,"message"=>"Recored insert successfully.")));
			}
			
		}
	}
	public function delete_bill(){
		$delete_id=$this->input->post("delete_id");
		$update=array(
			"del_date"=>date("Y-m-d H:i:s"),
			"del_uid"=>$this->session->userdata("id"),
			"status"=>"deactive"
		);
		$this->db->where("id",$delete_id);
		$this->db->update("bill",$update);
		die(json_encode(array("success"=>true,"message"=>"User deleted successfully.")));
	}
	public function get_party_address(){
		$id=$this->input->post("id");
		$sql="SELECT *,(SELECT city_name FROM cities WHERE city_id IN(id)) as city_name,(SELECT country_name FROM countries WHERE country_id IN(id)) as country_name,(SELECT state_name FROM states WHERE state_id IN(id)) as state_name FROM party WHERE id='".$id."'";
		$res=$this->db->query($sql);
		$row=$res->result_Array();
		$row=$row[0];
		echo $row['address']." ".$row['city_name']." ".$row['state_name']." - ".$row['country_name']." ".$row['zip_code'];
	
	}
	
	public function get_truck_list(){
		$query = $_REQUEST['query'];
		$sql="SELECT * FROM truck_master WHERE company_id='".$this->session->userdata("id")."' AND truck_no LIKE '%".$query."%'";
		$res=$this->db->query($sql);
		foreach($res->result_Array() as $row){
			$array[] = array (
				'value' => $row['truck_no'],
			);
		}
		 echo json_encode ($array);
		
	}
	
}
