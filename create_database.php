<?php
	session_start();
	include('master_database_connection.php');
?>
<!DOCTYPE>
<html>
	<head>
		<title>Create Databases</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

		

		<script type="text/javascript" src="js/jquery.min.js"></script>	
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>	

		<link rel="stylesheet" type="text/css" href="set_criteriaCSS.css">
	</head>
	<body id="body">
		<?php include("adheader.php");?>
		<ul class="nav nav-tabs content">
		  <li role="presentation"><a href="adminHome.php">Home</a></li>
		  <li role="presentation"><a href="set_criteria.php">Set Criteria</a></li>
		  <li role="presentation"><a href="view_applications.php">View Applications</a></li>
		  <li role="presentation" class="active"><a href="create_database.php">Create Database</a></li>
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
	</body>
</html>
