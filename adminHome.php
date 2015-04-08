<?php
	session_start();
	include('master_database_connection.php');
	$adminName = $_SESSION['adminUserName'];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Welcome <?php echo $adminName; ?></title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">


		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

		

		<script type="text/javascript" src="js/jquery.min.js"></script>	
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>	

		<link rel="stylesheet" type="text/css" href="adminHomeCSS.css" media="screen, projection">
		<link rel="stylesheet" type="text/css" href="align_css.css" media="screen, projection">
		<!-- <script type="text/javascript" src="prompt.js"></script> -->

	</head>
	<body id="body">
		<?php include("adheader.php");?>

		<ul class="nav nav-tabs content">
		 	<li role="presentation" class="active"><a href="adminHome.php">Home</a></li>
			<li class="navbar-right" role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					Settings <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">					
			 		<li><a href="change_password.php">Change Password</a></li>		
			 		<li><a href="log_out.php">Log Out</a></li>
				</ul>
			</li>  
		</ul>


		<h1 id="welcome_tag">Welcome <?php echo $adminName; ?></h1><br />
		<div id="all_options">
			<a href="set_criteria.php"><button class="options">Set Criteria</button></a>
			<a href="view_applications.php"><button class="options">View Applications</button></a>
			<a href="create_database.php"><button class="options">Create Database</button></a>
			<a ><button data-toggle="modal" data-target="#activate" class="options">Activate Client</button></a>		
			<a ><button data-toggle="modal" data-target="#deactivate"class="options">Deactivate Client</button></a>
		</div>	
	
		<div class="modal fade" id="activate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Activate Database</h4>
					</div>
					<div class="modal-body">
						Activate the client?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						<button type="button" class="btn btn-primary">Yes</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Deactivate Database</h4>
					</div>
					<div class="modal-body">
						De-Activate the client?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						<button type="button" class="btn btn-primary">Yes</button>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>