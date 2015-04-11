<?php
	session_start();
	require_once('master_database_connection.php');
?>
<!DOCTYPE>
<html>
	<head>
		<title>Create Databases</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

		<script type="text/javascript" src="js/jquery.min.js"></script>	
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>	
		
		<link rel="stylesheet" type="text/css" href="adminLoginCSS.css" media="screen, projection">	

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

		
		<?php
			function alert_modal()
			{
				echo '
					<div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Alert!</h4>
								</div>
								<div class="modal-body">
									Fill in the year value!
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>							
								</div>
							</div>
						</div>
					</div>
					';

				echo "<script type='text/javascript'>$('#alert_modal').modal('show')</script>";
			}
			function existing_modal($yr,$sem)
			{
				echo '
					<div class="modal fade" id="existing_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Alert!</h4>
								</div>
								<div class="modal-body">
									The database of '.$sem.' semester of year '.$yr.' is already existing!
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>							
								</div>
							</div>
						</div>
					</div>
					';

				echo "<script type='text/javascript'>$('#existing_modal').modal('show')</script>";
			}

			if(isset($_POST['submit']))
			{
				$year = $_POST['year'];
				$semester = $_POST['semester'];

				if(empty(trim($year)))
				{
					alert_modal();
				}
				else
				{
					$query = "select dbName from db_list where year='".$year."' and semester='".$semester."'";
					$queryResult = mysqli_query($masterDbConnection,$query);
					if($queryResult)
					{
						$queryRows = mysqli_num_rows($queryResult);
						if($queryRows != 0)
						{
							if($semester == 0)
								$sm = "Odd";
							else
								$sm = "Even";
							existing_modal($year,$sm);
						}
						else
						{
							
						}
					}
					else
					{
						echo mysql_error();
					}
				}
			}
		?>

		<form class="col-md-offset-4 col-md-4 topMargin" method="post" action="create_database.php">
			<div class="panel panel-info">					
				<div class="panel-heading center">Create Database</div>
				<div class="panel-body">										
					<p class="requireTag">*require fields</p>
					<div class="form-group betweenMargin">
						<div class="row">
							<label class="col-md-3">Year*</label>																		
						</div>
						<input id="year" name="year" type="text" class="form-control" placeholder="Year"
							value=
								<?php
									if(isset($_POST['submit']))
									{										
										echo $year;	
									} 
								?>							
						>
					</div>
					<div class="form-group topMargin">
						<div class="row">
							<label class="col-md-3">Semester*</label>												
						</div>
						<select id='semester' name='semester' class='discipline_options form-control'>
							<option value=1 <?php if(isset($_POST['submit'])) if($semester == 1) echo "selected";?> >Even(E)</option>
							<option value=0 <?php if(isset($_POST['submit'])) if($semester == 0) echo "selected";?> >Odd(O)</option>											
						</select>
					</div>														
					<div class="center topMargin">
						<button name="submit" type="submit" class="btn btn-block btn-success">Create</button>	
					</div>	
				</div>	
			</div>			
		</form>	
	</body>
</html>

<style type="text/css">
	.topMargin{
		margin-top: 40px;
	}	
</style>