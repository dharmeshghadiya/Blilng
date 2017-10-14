<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("security_model");
		$this->load->model("membership_model");
	}
	public function index()
	{
		$this->load->view('membership_list');
	}
	public function get_membership_list(){
		$sql="SELECT * FROM member_ship WHERE del_date is NULL";
		$res=$this->db->query($sql);
		$recordsTotal=$res->num_rows();
		
		if($_REQUEST['search']['value']!='')
		{
			$sql.=" AND (membership_name LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR price LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR membership_details LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR membership_period LIKE '%".$_REQUEST['search']['value']."%' )";
		}
		$sql.=" ORDER BY priority DESC ";
		$res=$this->db->query($sql);
		$recordsFiltered=$res->num_rows();
		$data=array();
		$i=$_REQUEST['start']+1;
		foreach($res->result_Array() as $row)
		{
			$url=site_url("membership/form?id=").$row['id'];
			$html = '<button  onclick="viewmenu(\''.$url.'\')" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>';
			$html .= '&nbsp;<button  onclick="delete_category('.$row['id'].')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
			if($row['status']=='active'){
				$status='<button type="button" class="btn btn-sm btn-success" onclick="change_status('.$row['id'].',0)">Active</button>';
			}else if($row['status']=='deactive'){
				$status='<button type="button" class="btn btn-sm btn-danger" onclick="change_status('.$row['id'].',1)">Deactive</button>';
			}
			$nested=array();
			$nested['id']=$i;
			$nested['membership_name']=ucfirst($row['membership_name']);
			$nested['price']="$".$row['price'];
			$nested['membership_details']=$row['membership_details'];
			$nested['membership_period']=$row['membership_period']." Days";
			$nested['status']=$status;
			$nested['action']=$html;
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
			$data=$this->membership_model->get_id_wise_data($id);
			$this->load->view("membership_form",$data);
		}
		else
		{
			$this->load->view("membership_form");
		}		
	}
	public function form_submit(){
		$this->form_validation->set_rules('membership_name', 'Membership', 'trim|required');	
		$this->form_validation->set_rules('membership_details', 'Membership Details', 'trim|required');	
		$this->form_validation->set_rules('price', 'Price', 'trim|required');	
		$this->form_validation->set_rules('membership_period', 'Membership Period', 'trim|required');	
		if ($this->form_validation->run()==false)
		{
			foreach($this->form_validation->error_array() as $key=>$val)
			{
				die(json_encode(array("success"=>false,"message"=>$val)));
			}
		}
		else
		{
			$duplicate=$this->membership_model->duplicate_check();
			if($duplicate)
			{
				if($this->input->post("membership_id")!='')
				{
					$update=$this->membership_model->update();
					die(json_encode(array("success"=>true,"message"=>"Recored update successfully.")));
				}
				else
				{
					$insert=$this->membership_model->insert();
					die(json_encode(array("success"=>true,"message"=>"Recored insert successfully.")));
				}
			}
			else
			{
				die(json_encode(array("success"=>false,"message"=>"Duplicate membership found.")));
			}
		}
	}
	function change_status()
	{
		$id=$this->input->post("id");
		$status=$this->input->post("status");
		if($status==0)
		{
			$status='deactive';
		}
		else
		{
			$status='active';
		}
		$update=array(
			"status"=>$status
		);
		$this->db->where("id",$id);
		$this->db->update("member_ship",$update);
		die(json_encode(array("success"=>true,"message"=>"Membership status update successfully.")));
	}
}
