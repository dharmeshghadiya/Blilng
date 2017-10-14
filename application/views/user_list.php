<div class="card">
	<div class="card-body">
	  <h2 class="card-title">User</h2>
		<div class="row">
			<div class="col-12">
				<table id="user_list" class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone No</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade bd-example-modal-sm" id="status_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLabel">Change Status</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" id="id" />
				<input type="hidden" name="status" id="status" />
				<p>Are you sure want to change status?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="confirm_change_status()">Yes</button>
			</div>
		</div>
	</div>
</div>
<script>
	var table=$('#user_list').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo site_url("user/get_user_list"); ?>",
		"ordering":false
    } );
	function delete_user(delete_id){
	
		swal({
			title: "Are you sure?",
			text: "Want to delete this user.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Yes, delete it!',
			closeOnConfirm: false
		},
		function(){
			$.ajax({
				type: "POST",
				url: "<?php echo site_url("user/deleteuser"); ?>", 
				data: {delete_id:delete_id}, 
				dataType: "json",
				success: function(data){
					if(data.success == true){
						table.ajax.reload();
						swal("Deleted!", data.message, "success");
					}
				}
			});
			
		});
	}
	function change_status(id,status){
		$("#id").val(id);
		$("#status").val(status);
		$("#status_modal").modal("show");
	}
	
	function confirm_change_status(){
		var id=$("#id").val();
		var status=$("#status").val();
		$(".preloader").show();
		$.ajax({
			type: "POST",
			url: "<?php echo site_url("teacher/change_status"); ?>", 
			data: {id:id,status:status}, 
			dataType: "json",
			success: function(data){
				$(".preloader").hide();
				table.ajax.reload();
				$("#status_modal").modal("hide");
				
			}
		});
		
	}
</script>