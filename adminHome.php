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
	
		<?php
			if(isset($_POST['deactivate_database']))
			{				
				$queryDA = "update db_list set activeStatus = 0 where dbName ='".$_SESSION["dbName"]."'";
				$queryResultDA = mysqli_query($masterDbConnection,$queryDA);				
				if($queryResultDA)
				{
					//query executed					
				}
				else
				{
					echo mysqli_error();
				}
				unset($_SESSION['dbName']);
			}
			if(isset($_POST['activate_database']))
			{
				if(isset($_SESSION['dbName']))	
				{
					$query = "update db_list set activeStatus = 1 where dbName ='".$_SESSION['dbName']."'";
					$queryResult = mysqli_query($masterDbConnection,$query);
					if($queryResult)
					{
						
					}
					else
					{
						echo mysqli_error();
					}
				}
				
			}
			if(isset($_POST['select_database']))
			{			
			}
			if(isset($_POST['submit']))
			{
				echo "<script>$('#select').modal('show');</script>";
			}
		?>
		
		<form action="adminHome.php" method="post">				
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
							<button type="submit" onclick="activate_database()" name="activate_database" class="btn btn-primary">Yes</button>
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
							<button type="submit" onclick="deactivate_database()" name="deactivate_database"class="btn btn-primary">Yes</button>
						</div>
					</div>
				</div>
			</div>
		
			<div class="modal fade" id="select_database" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Alert!</h4>
						</div>
						<div class="modal-body">
							No Database is selected, Select a database?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
							<button data-toggle="modal" data-target="#select" type="button" data-dismiss="modal" name="select_database" class="btn btn-primary">Select</button>
						</div>
					</div>
				</div>
			</div>		

			<div class="modal fade" id="selected_database" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Alert!</h4>
						</div>
						<div class="modal-body">
							<?php									
								$query = "select dbName,year,semester from db_list where activeStatus = 1";						
								$queryResult = mysqli_query($masterDbConnection,$query);
								if($queryResult)
								{
									$queryRows = mysqli_num_rows($queryResult);
									if($queryRows == 0)
									{
									  	echo '<script> $("#select_database").modal("show");</script>';					
									}
									else
									{

										$array = mysqli_fetch_array($queryResult);	
										$_SESSION['dbName'] = $array['dbName'];							
										//echo $_SESSION['dbName'];
										if($array['semester'] == 1)
										{
											$sem = "Even";
										}
										else
										{
											$sem = "Odd";
										}
										$msg = "Selected database is of ".$sem." semester of year ".$array["year"];
										echo "<script type='text/javascript'>$('#selected_database').modal('show')</script>";
									}
								}
								else
								{
									echo mysqli_error();
								}
								echo $msg;																											
						?>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
							<button type="submit" name="change_database" class="btn btn-primary">Change</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="select" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Select Database</h4>
						</div>
						<div class="panel-body">
							<div class="modal-body">							
								<p class="requireTag">*require fields</p>
								<div class="form-group">
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
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
								<button type="submit" name="select" class="btn btn-primary" onclick="select_check()">Select</button>
							</div>
						</div>
					</div>
				</div>
			</div>

		</form>	
	</body>
</html>

<script type="text/javascript">
	function deactivate_database(){	   	    
	    $('#deactivate').modal('hide');
	}
	function activate_database(){	   	    
	    $('#activate').modal('hide');
	}	
	function select_check(){
		alert("hi");
		//$('#select').modal('show');
	}
</script>