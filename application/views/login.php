
<!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Educator Hub | Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/mdi/css/materialdesignicons.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css"); ?>">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/jquery-toast-plugin/dist/jquery.toast.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.png"); ?>" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper auth-pages login-2">
          <div class="card col-lg-4">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Login</h3>
              <form id="admin_login_form" method="post">
                <div class="form-group">
                  <label>Username *</label>
                  <input type="text" class="form-control p_input" id="user_name" name="user_name">
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input type="password" class="form-control p_input" id="password" name="password">
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                     
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <button type="button" class="btn btn-primary btn-block enter-btn" id="login_btn">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
       
      </div>
     
    </div>
   
  </div>
  
  <script src="<?php echo base_url("assets/node_modules/jquery/dist/jquery.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/node_modules/popper.js/dist/umd/popper.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/node_modules/bootstrap/dist/js/bootstrap.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/node_modules/jquery-toast-plugin/dist/jquery.toast.min.js"); ?>"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php echo base_url("assets/js/off-canvas.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/hoverable-collapse.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/misc.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/validate.js"); ?>"></script>
<script>
$( document ).ready(function() {
	/* Register Form */
    $("#admin_login_form").validate({
		rules: {
			user_name: { required:true},
			password: { required:true, minlength:5 },
		}
	});
	
	$('#login_btn').click(function () {
		if ($("#admin_login_form").valid()) {
			$(".preloader").show();
			var request = $.ajax({
				url: "<?php echo site_url("login/admin_login"); ?>",
				method: "POST",
				data: $("#admin_login_form").serialize(),
				dataType: "json"
			});
			request.done(function( data, textStatus, jqXHR ) {
				$(".preloader").hide();
				if(data.success==true){
					success_notification(data.message);
					$('#admin_login_form')[0].reset();
					window.location="<?php echo site_url("admin"); ?>";
					
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

	function success_notification(message){
		$.toast({
			heading: "Well done!",
			text:	message,
			position: 'bottom-left',
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
			position: 'bottom-left',
			loaderBg: "#5bc0de",
			icon: "error",
			hideAfter: 3000,
			stack: 1
		});
	}


</script>
</body>

</html>
