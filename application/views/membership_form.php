<div class="card">
	<div class="card-body">
	  <h2 class="card-title">Membership</h2>
		<div class="row">
			<div class="col-12">
				<form class="forms-sample" id="membership_form">
					<input type="hidden" id="membership_id" name="membership_id" value='<?php if(isset($id)) echo $id; ?>' />
					<div class="form-group">
						<label for="exampleInputEmail1">Membership*</label>
						<input type="text" class="form-control p-input" id="membership_name" placeholder="Membership" value='<?php if(isset($membership_name)) echo $membership_name; ?>' name="membership_name">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Membership Details*</label>
						<textarea class="form-control p-input" id="membership_details" placeholder="Membership Details" rows="5" name='membership_details'><?php if(isset($membership_details)) echo $membership_details; ?></textarea>
						
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-6">
								<label for="exampleInputEmail1">Price In Dollar* </label>
								<input type="text" class="form-control p-input" id="price" placeholder="Price" value='<?php if(isset($price)) echo $price; ?>' name="price">
							</div>
							<div class="col-6">
								<label for="exampleInputEmail1">Membership Period In Days*</label>
								<input type="text" class="form-control p-input" id="membership_period" placeholder="Membership Period In Days" value='<?php if(isset($membership_period)) echo $membership_period; ?>' name="membership_period">
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-primary" id="btn_submit">Submit</button>
					<button type="button" class="btn btn-default" onclick="viewmenu('membership')">Cancel</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$( document ).ready(function() {
		$("#membership_form").validate({
			rules: {
				membership_name: { required:true},
				membership_details: { required:true},
				price: { required:true,number: true},
				membership_period: { required:true,number: true},
			}
		});
	
	$('#btn_submit').click(function () {
		var cat_id=$("#cat_id").val();
		if ($("#membership_form").valid()) {
			$(".preloader").show();
			var request = $.ajax({
				url: "<?php echo site_url("membership/form_submit"); ?>",
				method: "POST",
				data: $("#membership_form").serialize(),
				dataType: "json"
			});
			request.done(function( data, textStatus, jqXHR ) {
				$(".preloader").hide();
				if(data.success==true){
					success_notification(data.message);
					$('#membership_form')[0].reset();
					if($("#membership_id").val()!=''){
						viewmenu("membership");
					}
				}else{
					error_notification(data.message);
				}
			});
			request.fail(function( jqXHR, textStatus ) {
				console.log( "Request failed: " + textStatus );
			});
        }
    });
	
	$("#price").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	$("#membership_period").keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			$("#errmsg").html("Digits Only").show().fadeOut("slow");
			return false;
		}
	});
});
</script>