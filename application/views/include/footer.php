
       

      
  </div>
  <!-- row-offcanvas ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?php echo base_url("assets/node_modules/jquery/dist/jquery.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/node_modules/popper.js/dist/umd/popper.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/node_modules/bootstrap/dist/js/bootstrap.min.js");?>" ></script>
  <script src="<?php echo base_url("assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/node_modules/datatables.net/js/jquery.dataTables.js");?>"></script>
  <script src="<?php echo base_url("assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"); ?>"></script>
   <script src="<?php echo base_url("assets/node_modules/jquery-toast-plugin/dist/jquery.toast.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/node_modules/sweetalert2/dist/sweetalert2.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/node_modules/jquery.repeater/jquery.repeater.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/node_modules/jquery.repeater/jquery.repeater.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"); ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?php echo base_url("assets/node_modules/icheck/icheck.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/node_modules/chart.js/dist/Chart.min.js"); ?>"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo base_url("assets/js/off-canvas.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/hoverable-collapse.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/misc.js"); ?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url("assets/js/chart.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/iCheck.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/validate.js"); ?>"></script>
  <script>
	function viewmenu(url){
		if(url=="#") return;
		if(url=="Dashboard"){
			$(".preloader").show();
			$("#dashboard").show();
			$("#module_container").html("").hide();
			$(".preloader").hide();
		}else{
			$(".preloader").show();
			$("#dashboard").hide();
			$("#module_container").html("").show();
			  $.ajax({url: url, success: function(result){
				$("#module_container").html(result);
				$(".preloader").hide();
			}});
		}

	}
	function success_notification(message){
		$.toast({
			heading: "Well done!",
			text:	message,
			position: 'bottom-right',
			loaderBg: "#d9534f",
			icon: "success",
			hideAfter: 3000,
			stack: 1
		});
	}
	function error_notification(message){
		$.toast({
			heading: 'Oh snap!',
			text:	message,
			position: 'bottom-right',
			loaderBg: "#5bc0de",
			icon: "error",
			hideAfter: 3000,
			stack: 1
		});
	}
	function get_state(){
		var country_id=$("#country_id").val();
		if(country_id!=''){
			$(".preloader").show();
			var request = $.ajax({
				url: "<?php echo site_url("admin/get_state"); ?>",
				method: "POST",
				data: {country_id:country_id},
				dataType: "html"
			});
			request.done(function( data, textStatus, jqXHR ) {
				$(".preloader").hide();
				$("#state_id").html(data);
				get_city();
			});
			request.fail(function( jqXHR, textStatus ) {
				console.log( "Request failed: " + textStatus );
			});
		}else{
			$("#state_id").html("<option value=''>Please select State</option>");
			$("#city_id").html("<option value=''>Please select city</option>");
		}	
	}
	function get_city(){
		var state_id=$("#state_id").val();
		if(state_id!=''){
			$(".preloader").show();
			var request = $.ajax({
				url: "<?php echo site_url("admin/get_city"); ?>",
				method: "POST",
				data: {state_id:state_id},
				dataType: "html"
			});
			request.done(function( data, textStatus, jqXHR ) {
				$(".preloader").hide();
				$("#city_id").html(data);
			});
			request.fail(function( jqXHR, textStatus ) {
				console.log( "Request failed: " + textStatus );
			});
		}else{
			$("#city_id").html("<option value=''>Please select city</option>");
		}
	}
</script>
</body>


</html>
