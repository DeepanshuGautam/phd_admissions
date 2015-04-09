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
					<li><a data-toggle="modal" data-target="#select">Change Database</a></li>
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
				unset($_SESSION['year']);
				unset($_SESSION['semester']);
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
		?>
		
		<form action="adminHome.php" method="post">																			

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

			<?php
				if(!isset($_POST['select']) && !isset($_SESSION['dbName']))
				{

				echo '
			<div class="modal fade" id="selected_database" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Alert!</h4>
						</div>
						<div class="modal-body">
			';						
								
								$query = "select dbName,year,semester from db_list where activeStatus = 1";						
								$queryResult = mysqli_query($masterDbConnection,$query);
								if($queryResult)
								{
									$queryRows = mysqli_num_rows($queryResult);
									if($queryRows == 0)
									{
									  	echo "<script> $('#select_database').modal('show');</script>";					
									}
									else
									{

										$array = mysqli_fetch_array($queryResult);	
										$_SESSION['dbName'] = $array['dbName'];	

										//echo '<p class="text-center col-md-offset-6 col-md-3">Selected Database: '.strtoupper($_SESSION['dbName']).'</p>';
							
										//echo $_SESSION['dbName'];
										if($array['semester'] == 1)
										{
											$sem = "Even";
										}
										else
										{
											$sem = "Odd";
										}
										$_SESSION['year'] = $array['year'];
										$_SESSION['semester'] = $sem;
										$msg = "Selected database is of ".$sem." semester of year ".$array["year"];
										echo "<script type='text/javascript'>$('#selected_database').modal('show')</script>";
									}
								}
								else
								{
									echo mysqli_error();
								}
								echo $msg;	
																																	
						
					echo '
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
							<button type="submit" name="change_database" class="btn btn-primary">Change</button>
						</div>
					</div>
				</div>
			</div>';
			}
			?>
		</form>

		<?php
			if(isset($_POST['select']))
			{										
				$year = $_POST['year'];	
				$semester = $_POST['semester'];

			} 
		?>

		<form action="adminHome.php" method="post" id="modal_form">
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
												if(isset($_POST['select']))
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
										<option value=1 <?php if(isset($_POST['select'])) if($semester == 1) echo "selected";?> >Even(E)</option>
										<option value=0 <?php if(isset($_POST['select'])) if($semester == 0) echo "selected";?> >Odd(O)</option>											
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
										

		<?php
			if(isset($_POST['select']))
			{	
				$querySB = "select dbName,year,semester from db_list where year='".$year."' and semester='".$semester."'";
				$queryResultSB = mysqli_query($masterDbConnection,$querySB);
				if($queryResultSB)
				{
					$queryRowsSB = mysqli_num_rows($queryResultSB);
					if($queryRowsSB == 0)
					{						
						echo "<script>	
							alert('No database existing!');	
							$('#select').modal('show');
						</script>";
					}
					else
					{
						$array = mysqli_fetch_array($queryResultSB);

						$_SESSION['dbName'] = $array['dbName'];
						if($array['semester'] == 1)
						{
							$sem = "Even";
						}
						else
						{
							$sem = "Odd";
						}
						$_SESSION['year'] = $array['year'];
						$_SESSION['semester'] = $sem;

						$msg = "Selected database is of ".$sem." semester of year ".$array["year"];
						echo '
						<div class="modal fade" id="chosen_database" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Alert!</h4>
									</div>
									<div class="modal-body">					
						';			echo $msg;
						echo '
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
										<button data-toggle="modal" data-target="#select" type="button" data-dismiss="modal" name="select_database" class="btn btn-primary">Change</button>
									</div>
								</div>
							</div>
						</div>
						';
						echo "<script type='text/javascript'>$('#chosen_database').modal('show')</script>";
					}
				}
				else
				{
					echo mysqli_error();
				}
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
							<?php echo "Deactivate the database of ".$_SESSION['semester']." of year ".$_SESSION['year']."?"?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
							<button type="submit" onclick="deactivate_database()" name="deactivate_database"class="btn btn-primary">Yes</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<?php include("footer.php");?>
	</body>
</html>

<script type="text/javascript">
	function deactivate_database(){	   	    
	    $('#deactivate').modal('hide');
	}
	function activate_database(){	   	    
	    $('#activate').modal('hide');
	}	
	$("#modal_form").submit(function(e) {
		//alert("hi");
		
		var year = document.getElementById('year').value;
		//var semester = document.getElementById('semester').value;

		//alert(year);
		//alert(year.length);
		if(year.length == 0)
		{
			alert("Fill in the year");
			e.preventDefault();
		}
	});
</script>