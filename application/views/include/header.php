<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Educator Hub</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/mdi/css/materialdesignicons.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css"); ?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css"); ?>" />
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/icheck/skins/all.css"); ?>" />
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/jquery-toast-plugin/dist/jquery.toast.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/sweetalert2/dist/sweetalert2.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/node_modules/font-awesome/css/font-awesome.min.css"); ?>" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.png"); ?>" />
</head>

<body class='sidebar-fixed'>
<div class="container-scroller">
	<nav class="navbar navbar-primary col-lg-12 col-12 fixed-top d-flex flex-row">
		<div class="text-center navbar-brand-wrapper">
			<a class="navbar-brand brand-logo" href="#">Educator
			  <i class="mdi mdi-cube-send"></i>
			</a>
			<a class="navbar-brand brand-logo-mini" href="#"><i class="mdi mdi-cube-send"></i></a>
		</div>
		<div class="navbar-menu-wrapper d-flex align-items-center">
			<button class="navbar-toggler navbar-toggler d-none d-lg-block align-self-center mr-2" type="button" data-toggle="minimize">
				<span class="mdi mdi-chevron-left"></span>
			</button>
		
			<form class="form-inline mt-2 mt-md-0 d-none d-lg-block ml-lg-auto"></form>
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
						<i class="mdi mdi-bell-outline"></i>
						<span class="count bg-warning">7</span>
					</a>
					<div class="dropdown-menu navbar-dropdown notification-drop-down" aria-labelledby="notificationDropdown">
						<a class="dropdown-item" href="#">
							<i class="mdi mdi-cake text-success"></i>
							<span class="notification-text">Today is John's birthday</span>
						</a>
						<a class="dropdown-item" href="#">
							<i class="mdi mdi-cellphone-iphone text-danger"></i>
							<span class="notification-text">Call John Doe</span>
						</a>
						<a class="dropdown-item" href="#">
							<i class="mdi mdi-account-multiple text-primary"></i>
							<span class="notification-text">Meeting Alisa</span>
						</a>
						<a class="dropdown-item" href="#">
							<i class="mdi mdi-alert text-danger"></i>
							<span class="notification-text">Server space almost full</span>
						</a>
						<a class="dropdown-item" href="#">
							<i class="mdi mdi-bell-outline text-warning"></i>
							<span class="notification-text">Payment Due</span>
						</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link count-indicator" id="MailDropdown" href="#" data-toggle="dropdown">
						<div class="nav-profile">
						  <span>Hi, <?php echo ucwords($this->session->userdata("user_name")); ?></span>
						  <img src="<?php echo base_url("assets/images/faces/face6.jpg"); ?>"
						  />
						</div>
					</a>
				<div class="dropdown-menu navbar-dropdown notification-drop-down" aria-labelledby="MailDropdown">
						<a class="dropdown-item" href="#">
							<i class="fa fa-user-circle"></i>
							<span class="notification-text">Profile</span>
						</a>
						<a class="dropdown-item" href="<?php echo site_url("login/logout"); ?>">
							<i class="fa fa-sign-out"></i>
							<span class="notification-text">Logout</span>
						</a>
						
					</div>
				</li>
			</ul>
			<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
				<span class="mdi mdi-chevron-left"></span>
			</button>
		</div>
	</nav>
<?php $this->load->view("include/sidebar"); ?>