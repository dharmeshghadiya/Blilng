<div class="card">
	<div class="card-body">
		<h2 class="card-title pull-left">Party</h2>
		<h2 class="card-title pull-right"> <button type='button' class='btn btn-primary btn-sm' onclick='viewmenu("party/form")'s><i class='fa fa-plus'></i> ADD NEW</button><h2>
	  
		<div class="row" style='clear:both'>
			<div class="col-12">
				<table id="party_list" class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Address</th>
							<th>Mobile No</th>
							<th>Phone No</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	var table=$('#party_list').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo site_url("party/get_party_list"); ?>",
		"ordering":false
    } );
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
			url: "<?php echo site_url("party/change_status"); ?>", 
			data: {id:id,status:status}, 
			dataType: "json",
			success: function(data){
				$(".preloader").hide();
				table.ajax.reload();
				$("#status_modal").modal("hide");
				
			}
		});
		
	}
	function delete_party(delete_id){
	
		swal({
			title: "Are you sure?",
			text: "Want to delete this party.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Yes, delete it!',
			closeOnConfirm: false
		},
		function(){
			$.ajax({
				type: "POST",
				url: "<?php echo site_url("user/deleteparty"); ?>", 
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
</script>