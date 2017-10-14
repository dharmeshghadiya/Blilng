<div class="card">
	<div class="card-body">
	  <h2 class="card-title pull-left">Membership</h2>
	  <h2 class="card-title pull-right"> <button type='button' class='btn btn-primary btn-sm' onclick='viewmenu("membership/form")'s><i class='fa fa-plus'></i> ADD NEW</button><h2>
		<div class="row" style='clear:both'>
			<div class="col-12">
				<table id="membership_list" class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th></th>
							<th>#</th>
							<th>Membership</th>
							<th>Price</th>
							<th>Membership Days</th>
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
<style>
td.details-control {
    background: url('<?php echo base_url("assets/images/details_open.png");  ?>') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url("assets/images/details_close.png");  ?>') no-repeat center center;
}
</style>
<script>
function format ( d ) {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Details:</td>'+
            '<td>'+d.membership_details+'</td>'+
        '</tr>'+
    '</table>';
}


	var table=$('#membership_list').DataTable( {
		"processing": true,
        "serverSide": true,
        "ajax": "<?php echo site_url("membership/get_membership_list"); ?>",
		"orderable":false,
		"columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "id" },
            { "data": "membership_name" },
            { "data": "price" },
            { "data": "membership_period" },
            { "data": "status" },
            { "data": "action" }
        ],
        columnDefs: [
            { orderable: false, targets: [ 0 , 1, 2, 3, 4, 5, 6 ] } 
        ]
    } );
     
    // Add event listener for opening and closing details
    $('#membership_list tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
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
			url: "<?php echo site_url("membership/change_status"); ?>", 
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