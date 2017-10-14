<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("security_model");
	}
	public function index()
	{
		$this->load->view('user_list');
	}
	public function get_user_list(){
		$sql="SELECT * FROM user WHERE user_type='user' AND del_date IS NULL";
		$res=$this->db->query($sql);
		$recordsTotal=$res->num_rows();
		
		if($_REQUEST['search']['value']!=''){
			$sql.=" AND (full_name LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR email LIKE '%".$_REQUEST['search']['value']."%'";
			$sql.=" OR phone_no LIKE '%".$_REQUEST['search']['value']."%')";
		}
		$sql.=" ORDER BY id DESC ";
		$res=$this->db->query($sql);
		$recordsFiltered=$res->num_rows();
		$data=array();
		$i=$_REQUEST['start']+1;
		foreach($res->result_Array() as $row){
			$url=site_url("user/user_Form/id/").$row['id'];
			$html = '&nbsp;<button  onclick="delete_user('.$row['id'].')" class="btn btn-danger btn-sm btn-rounded "><i class="fa fa-trash"></i></button>';
			if($row['status']=='active'){
				$status='<button type="button" class="btn btn-sm btn-success" onclick="change_status('.$row['id'].',0)">Active</button>';
			}else if($row['status']=='deactive'){
				$status='<button type="button" class="btn btn-sm btn-danger" onclick="change_status('.$row['id'].',1)">Deactive</button>';
			}
			$nested=array();
			$nested[]=$i;
			$nested[]=ucfirst($row['full_name']);
			$nested[]=$row['email'];
			$nested[]=$row['phone_no'];
			$nested[]=$status;
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
	function deleteuser(){
		$delete_id=$this->input->post("delete_id");
		$update=array(
			"del_date"=>date("Y-m-d H:i:s"),
			"del_uid"=>$this->session->userdata("id"),
			"status"=>"deactive"
		);
		$this->db->where("id",$delete_id);
		$this->db->update("user",$update);
		die(json_encode(array("success"=>true,"message"=>"User deleted successfully.")));
	}
		
}