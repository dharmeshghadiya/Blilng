<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("security_model");
	}
	public function index()
	{
		$this->load->view('teacher_list');
	}
	public function get_teacher_list(){
		$sql="SELECT * FROM user WHERE user_type='teacher' AND del_date IS NULL";
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
			$url1=site_url("user/user_assetst_map/id/").$row['id'];
			$html = '<button  onclick="view_membership('.$row['id'].')" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button>';
			$html .= '&nbsp;<button  onclick="delete_user('.$row['id'].')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
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
	function get_membership_details()
	{
		$id=$this->input->post("id");
		$sql="SELECT tm.*,ms.membership_name,ms.membership_period  FROM teacher_membership tm ,member_ship ms WHERE tm.user_id='".$id."' AND tm.order_status='active' AND tm.membership_id=ms.id";
		$res=$this->db->query($sql);
		$row=$res->row();
		if(isset($row)){
			$data="<table class='table table-striped table-bordered'>";
			$data.="<tr>";
				$data.="<td>Membership</td>";
				$data.="<td>".$row->membership_name."</td>";
			$data.="</tr>";
			$data.="<tr>";
				$data.="<td>Price</td>";
				$data.="<td>$".$row->amont."</td>";
			$data.="</tr>";
			$data.="<tr>";
				$data.="<td>Start Date</td>";
				$data.="<td>".date("d.m.Y H:i:s",strtotime($row->start_date))."</td>";
			$data.="</tr>";
			$data.="<tr>";
				$data.="<td>End Date</td>";
				$data.="<td>".date("d.m.Y H:i:s",strtotime($row->end_date))."</td>";
			$data.="</tr>";
			$data.="<tr>";
				$data.="<td>Transaction Id</td>";
				$data.="<td>".$row->transaction_id."</td>";
			$data.="</tr>";
			$data.="</table>";
		}else{
			$data="<h3 style='text-align:center;color:red'>No Membership Found For this user</h3>";
		}
		echo $data;
		
	}
	function delete_teacher()
	{
		$delete_id=$this->input->post("delete_id");
		$update=array(
			"del_date"=>date("Y-m-d H:i:s"),
			"del_uid"=>$this->session->userdata("id"),
			"status"=>"deactive"
		);
		$this->db->where("id",$delete_id);
		$this->db->update("user",$update);
		die(json_encode(array("success"=>true,"message"=>"Teacher deleted successfully.")));
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
		$this->db->update("user",$update);
		die(json_encode(array("success"=>true,"message"=>"Teacher status update successfully.")));
	}
}
