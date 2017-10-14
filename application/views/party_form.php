<div class="card">
	<div class="card-body">
	  <h2 class="card-title">Party</h2>
		<div class="row">
			<div class="col-12">
				<form class="forms-sample" id="party_form">
					<input type="hidden" id="party_id" name="party_id" value='<?php if(isset($id)) echo $id; ?>' />
					<div class="form-group">
						<div class="row">
							<div class="col-6">
								<label for="party_name">Party Name</label>
								<input type="text" class="form-control p-input" id="party_name" placeholder="Party Name" value='<?php if(isset($party_name)) echo $party_name; ?>' name="party_name">
							</div>
							<div class="col-6">
								<label for="party_code">Party Code</label>
								<input type="text" class="form-control p-input" id="party_code" placeholder="Party code" value='<?php if(isset($party_code)) echo $party_code; ?>' name="party_code">
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-6">
								<label for="mobile_no">Mobile No</label>
								<input type="text" class="form-control p-input" id="mobile_no" placeholder="Mobile No" value='<?php if(isset($mobile_no)) echo $mobile_no; ?>' name="mobile_no">
							</div>
						
							<div class="col-6">
								<label for="phone_no">Phone No</label>
								<input type="text" class="form-control p-input" id="phone_no" placeholder="Phone No" value='<?php if(isset($phone_no)) echo $phone_no; ?>' name="phone_no">
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-12">
								<label for="address">Address</label>
								<textarea class="form-control p-input" id="address" placeholder="Address" name="address"><?php if(isset($address)) echo $address; ?></textarea>	
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-3">
								<label for="address">Country</label>
								<select class="form-control p-input" id="country_id" name="country_id" onchange="get_state()">
									<option value=''>Please select Country</option>
									<?php 
										$sql="SELECT * FROM countries";
										$res=$this->db->query($sql);
										foreach($res->result_Array() as $row){
											$s='';
											if(isset($country_id) && $country_id==$row['id']) $s="selected='selected'";
											echo "<option value='".$row['id']."' $s>".$row['country_name']."</option>";
										}
									?>
								</select>
							</div>
							<div class="col-3">
								<label for="address">State</label>
								<select class="form-control p-input" id="state_id" name="state_id" onchange="get_city()">
									<option value=''>Please select State</option>
									<?php 
										if(isset($state_id)){
											$sql="SELECT * FROM states where country_id='".$country_id."'";
											$res=$this->db->query($sql);
											foreach($res->result_Array() as $row){
												$s='';
												if($state_id==$row['id']) $s="selected='selected'";
												echo "<option value='".$row['id']."' $s>".$row['state_name']."</option>";
											}
										}	
									?>
								</select>
							</div>
							<div class="col-3">
								<label for="address">City</label>
								<select class="form-control p-input" id="city_id" name="city_id">
									<option value=''>Please select City</option>
									<?php 
										if(isset($city_id)){
											$sql="SELECT * FROM cities where state_id='".$state_id."'";
											$res=$this->db->query($sql);
											foreach($res->result_Array() as $row){
												$s='';
												if($city_id==$row['id']) $s="selected='selected'";
												echo "<option value='".$row['id']."' $s>".$row['city_name']."</option>";
											}
										}
									?>
								</select>
							</div>
							<div class="col-3">
								<label for="zip_code">Zip Code</label>
								<input type="text" class="form-control p-input" id="zip_code" placeholder="Zip Code" value='<?php if(isset($zip_code)) echo $zip_code; ?>' name="zip_code">
							</div>
						</div>
					</div>
					
					<button type="button" class="btn btn-primary" id="btn_submit">Submit</button>
					<button type="button" class="btn btn-default" onclick="viewmenu('party')">Cancel</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$( document ).ready(function() {
		$("#party_form").validate({
			rules: {
				party_name: { required:true},
				address: { required:true},
				country_id: { required:true},
				state_id: { required:true},
				city_id: { required:true},
				zip_code: { required:true,number:true},
			}
		});
	
	$('#btn_submit').click(function () {
		var party_id=$("#party_id").val();
		if ($("#party_form").valid()) {
			$(".preloader").show();
			var request = $.ajax({
				url: "<?php echo site_url("party/form_submit"); ?>",
				method: "POST",
				data: $("#party_form").serialize(),
				dataType: "json"
			});
			request.done(function( data, textStatus, jqXHR ) {
				$(".preloader").hide();
				if(data.success==true){
					success_notification(data.message);
					$('#party_form')[0].reset();
					if($("#party_id").val()!=''){
						viewmenu("party");
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
	
});
</script>