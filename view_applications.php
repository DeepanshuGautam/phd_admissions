<?php
	session_start();
	include('master_database_connection.php');
?>
<!DOCTYPE html>

<html>
	<head>
		<title>View Applications</title>
		
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

		

		<script type="text/javascript" src="js/jquery.min.js"></script>	
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>	
		
		<link rel="stylesheet" type="text/css" href="view_applicationsCSS.css">
	</head>
	<body id="body">
		<?php include("adheader.php");?>
		<!-- <?php //include("navigation_bar.php");?> -->
		<ul class="nav nav-tabs content">
			<li role="presentation"><a href="adminHome.php">Home</a></li>	
			<li role="presentation"><a href="set_criteria.php">Set Criteria</a></li>		
			<li role="presentation" class="active"><a href="view_applications.php">View Applications</a></li>
			<li role="presentation"><a href="create_database.php">Create Database</a></li>
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
			if(isset($_POST['submit']) && isset($_SESSION['adminUserName']))
			{										
				$year = $_POST['year'];
				$semester = $_POST['semester'];
				$discipline = $_POST['discipline'];

				$query = "select dbName from db_list where year='".$year."' and semester='".$semester."'";
				$queryResult = mysqli_query($master_database_connection,$query);
				if($queryResult)
				{
					$queryRows = mysqli_num_rows($queryResult);
					if($queryRows == 0)
					{
						echo "<div class='col-md-offset-4 col-md-4 alert alert-danger topMargin' role='alert'>
							<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
							<span class='sr-only'>Error:</span>


							Database doesn't exists!
							</div>";
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
		?>
		<div class="panel-group content" id="accordion" role="tablist" aria-multiselectable="true">		
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#first_step" aria-expanded="true" aria-controls="collapseOne">
							Choose:
						</a>
					</h4>
				</div>
				<div id="first_step" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">
						<form method='post' action='view_applications.php'>
							<div class="col-md-4 col-md-offset-4">
								<div class="panel panel-info content">
									<div class="panel-heading center">DataBase</div>
									<div class="panel-body">
										<p class="requireTag">*require fields</p>
										<div class="form-group betweenMargin">
											<div class="row">
												<label class="col-md-4">Year*</label>																		
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
												<label class="col-md-6">Semester*</label>												
											</div>
											<select id='semester' name='semester' class='discipline_options form-control'>
												<option value=1 <?php if(isset($_POST['submit'])) if($semester == 1) echo "selected";?> >Even(E)</option>
												<option value=0 <?php if(isset($_POST['submit'])) if($semester == 0) echo "selected";?> >Odd(O)</option>											
											</select>
										</div>

										<div class="form-group topMargin">
											<div class="row">
												<label class="col-md-4">Course*</label>																		
											</div>																						
											<select id="discipline" name="discipline" class="discipline_options form-control">		
												<option value='Computer Engineering'<?php if(isset($_POST['submit'])) if($_POST['discipline'] == 'Computer Engineering') echo "selected";?> >Computer Engineering</option>
												<option value='Electronics'<?php if(isset($_POST['submit'])) if($_POST['discipline'] == 'Electronics') echo "selected";?>>Electronics</option>
												<option value='Mechanical'<?php if(isset($_POST['submit'])) if($_POST['discipline'] == 'Mechanical') echo "selected";?>>Mechanical</option>
												<option value='Mathematics'<?php if(isset($_POST['submit'])) if($_POST['discipline'] == 'Mathematics') echo "selected";?>>Mathematics</option>
												<option value='Physics'<?php if(isset($_POST['submit'])) if($_POST['discipline'] == 'Physics') echo "selected";?>>Physics</option>
											</select>												
										</div>			

										<div class="center extraMargin">
											<button name="submit" type="submit" class="btn btn-block btn-success">Submit</button>	
										</div>					
									</div>											
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>		
			
		</div>		
		
		<?php
			if(isset($_POST['submit']))
			{	
				if(isset($_SESSION['adminUserName']))
				{					
					$FetchApplicationSQL="select pi.userId,pi.firstName,pi.lastName From registered_users as ru inner join personal_info as pi on pi.userId=ru.userId where ru.discipline='".$_POST['discipline']."' and ru.applicationSubmitStatus=1";
					$result=mysql_query($FetchApplicationSQL);	

					if($result)
					{
						$resultRows = mysql_num_rows($result);
						if($resultRows == 0)			
						{
							echo "<script>alert('no results')</script>";
						}
						else
						{
							echo '
							<div class="panel panel-info content">
								<div class="panel-heading center">Submitted Applications</div>
								<div class="panel-body">	
									<p class="col-md-offset-5 col-md-4">No. of Applications received:'. $resultRows.'</p>													
									<table class="table table-striped  topMargin">
										<tr>
											<td><strong>Sr. No.</strong></td>
											<td><strong>Application No.</strong></td>
											<td><strong>Full Name</strong></td>
										</tr>';
										$count=1;
										while($array=mysql_fetch_array($result))
										{
											echo '<tr>
											<td>'.$count.'</td>
											<td><a data-toggle="tooltip" data-placement="left" title="Show full details" target="_blank" href=personal_info.php?app_no='.$array['userId'].'
												>
												'.$array['userId'].'</a></td>
											<td>'.$array['firstName']." ".$array['lastName'].'</td>
											</tr>';
											$count++;
										}
										
							echo '	</table>
								</div>										
							</div>
							';
						}
					}
					else
					{
						//query failed
						echo mysql_error().'</ br>';
					}
				}				
			}			
		?>			
	</body>
</html>