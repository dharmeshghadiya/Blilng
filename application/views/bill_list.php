<div class="card">
	<div class="card-body">
		<h2 class="card-title pull-left">Bill</h2>
		<h2 class="card-title pull-right"> <button type='button' class='btn btn-primary btn-sm' onclick='viewmenu("bill/form")'s><i class='fa fa-plus'></i> ADD NEW</button><h2>
	  
		<div class="row" style='clear:both'>
			<div class="col-12">
				<table id="bill_list" class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th></th>
							<th>Bill No</th>
							<th>Consignor</th>
							<th>Consignee</th>
							<th>From</th>
							<th>To</th>
							<th>Date</th>
							<th>Pay Or Paid<th>
							<th>Total</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
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
            '<td>Goods:</td>'+
            '<td>'+d.details+'</td>'+
        '</tr>'
    '</table>';
}


	var table=$('#bill_list').DataTable( {
		"processing": true,
        "serverSide": true,
        "ajax": "<?php echo site_url("bill/get_bill_list"); ?>",
		"orderable":false,
		"columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "bill_no" },
            { "data": "consignor" },
            { "data": "consignee" },
            { "data": "from_destination" },
            { "data": "to_destination" },
            { "data": "biil_date" },
            { "data": "pay_or_not_pay" },
            { "data": "grand_total" },
            { "data": "action" }
        ],
        columnDefs: [
            { orderable: false, targets: [ 0 , 1, 2, 3, 4, 5, 6,7,8,9,10 ] } 
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