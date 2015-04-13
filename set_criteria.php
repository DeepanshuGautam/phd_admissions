<?php
	session_start();
	include('master_database_connection.php');
?>
<!DOCTYPE>
<html>
	<head>
		<title>Set Qualification Criteria</title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">


		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

		

		<script type="text/javascript" src="js/jquery.min.js"></script>	
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>		
				
		<script type="text/javascript" src="set_criteria_js.js"></script>
		<link rel="stylesheet" type="text/css" href="set_criteriaCSS.css">

	</head>
	<body id="body">
		<?php include("adheader.php");?>
		
		<?php
			$_SESSION['pageName'] = "set_criteria.php";
			include("select_database.php");	
		?>
		<ul class="nav nav-tabs content">
			<li role="presentation"><a href="adminHome.php">Home</a></li>
			<li role="presentation" class="active"><a href="set_criteria.php">Set Criteria</a></li>
			<li role="presentation"><a href="view_applications.php">View Applications</a></li>
			<li role="presentation"><a href="create_database.php">Create Database</a></li>
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
			<?php
				if(isset($_SESSION['selected']))
				{					
					echo "<li class='navbar-right'>
							<a href='' data-toggle='modal' data-target='#select' style='color:black;";
							if($_SESSION['activeStatus'] == 0)
								echo "background-color:#ED6666;";
							else
								echo "background-color:#33CC33;";
							echo "'>".$_SESSION['year']."(".$_SESSION['semester'].")</a>
						</li>";					
				}
				else
				{
					echo "<li class='navbar-right' role='presentation'>
							<a href='' data-toggle='modal' data-target='#select' style='color:black;background-color:#FFFF99';>No DataBase Selected</a>
						</li>";
				}
			?> 
		</ul>	


		<form method='post' action='set_criteria.php'>
			<?php
				if(isset($_SESSION['selected']))
				{

					echo '
						<div class="panel-group content" id="accordion" role="tablist" aria-multiselectable="true">		
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#first_step" aria-expanded="true" aria-controls="collapseOne">
											Choose Discipline:
										</a>
									</h4>
								</div>
								<div id="first_step" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">										
										<div class="col-md-4 col-md-offset-4">
											<div class="panel panel-info content">
												<div class="panel-heading center">Course</div>
												<div class="panel-body">																					
													<div class="form-group">																																	
														<select id="discipline" name="discipline" class="discipline_options form-control">

															<option value="Computer Engineering"';
															if(isset($_POST["submit"])|| isset($_POST['submit_criteria'])) 
																if($_POST["discipline"] == "Computer Engineering") 
																	echo "selected";
															echo '>Computer Engineering</option>

															<option value="Electronics"';
															if(isset($_POST["submit"])|| isset($_POST['submit_criteria']))
																if($_POST["discipline"] == "Electronics") 
																	echo "selected";
															echo '>Electronics</option>

															<option value="Mechanical"';
															if(isset($_POST["submit"])|| isset($_POST['submit_criteria'])) 
																if($_POST["discipline"] == "Mechanical") 
																	echo "selected";
															echo '>Mechanical</option>

															<option value="Mathematics"'; 
															if(isset($_POST["submit"])|| isset($_POST['submit_criteria'])) 
																if($_POST["discipline"] == "Mathematics") 
																	echo "selected";
															echo '>Mathematics</option>

															<option value="Physics"';
															if(isset($_POST["submit"])|| isset($_POST['submit_criteria'])) 
																if($_POST["discipline"] == "Physics") 
																	echo "selected";
															echo '>Physics</option>

														</select>												
													</div>			

													<div class="center extraMargin">
														<button name="submit" type="submit" class="btn btn-block btn-success">Submit</button>	
													</div>					
												</div>											
											</div>
										</div>										
									</div>
								</div>
							</div>		
							
						
					';
				}
			?>		

			<?php
				if(isset($_POST['submit']) || isset($_POST['submit_criteria']))
				{
					$discipline = $_POST['discipline'];

					if(isset($_POST['submit_criteria']))
					{
						$reset_ug = -1;
						$reset_pg = -1;
						$reset_age = -1;

						$stream = $_POST['discipline'];		

						$ug_min_cgpa = $_POST['ug_min_cgpa'];
						$ug_min_percentage = $_POST['ug_min_percentage'];					

						$pg_min_percentage = $_POST['pg_min_percentage'];
						$pg_min_cgpa = $_POST['pg_min_cgpa'];
						
						$min_age = $_POST['age'];	
					}

					echo "<script>$('#first_step').collapse('hide');</script>";

					echo '
					<div class="panel panel-default collapseMargin">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#second_step" aria-expanded="true" aria-controls="collapseOne">
									Set Shorlisting Criteria:
								</a>
							</h4>
						</div>
						<div id="second_step" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">																					
							<div class="panel-body">							
								<p class="requireTag col-md-offset-5 col-md-2 row">*require fields</p>							
								<div class="row col-md-offset-2 col-md-4 topMargin" >
									<div class="panel panel-info">					
										<div class="panel-heading center">Under Graduate(UG)</div>
										<div class="panel-body">										
											<div class="form-group betweenMargin">
												<div class="row">
													<label class="col-md-6">Minimun CGPA*</label>																		
												</div>	
												<input name="ug_min_cgpa" id="ug_min_cgpa" class="form-control" placeholder="CGPA"
												value=';
												if(isset($_POST['submit_criteria']))
												{
													if(!empty(trim($ug_min_cgpa)))
													{
														echo $ug_min_cgpa;
													}
												}
												echo '>
											</div>
											<div class="form-group">
												<div class="row">
													<label class="col-md-6">Minimum Percentage*</label>												
												</div>											
												<input name="ug_min_percentage" class="form-control" placeholder="Percentage"
												value=';
												if(isset($_POST['submit_criteria']))
												{
													if(!empty(trim($ug_min_percentage)))
													{
														echo $ug_min_percentage;
													}
												}
												echo '>
											</div>																													
										</div>										
									</div>	
									';
										if(isset($_POST['submit_criteria']))
										{
											if(empty(trim($ug_min_cgpa)) && empty(trim($ug_min_percentage)))									
											{
												echo "<div class='alert alert-danger' role='alert'>
													<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
													<span class='sr-only'>Error:</span>


													Enter the min. cgpa and min. percentage!
													</div>";
											}
											elseif(empty(trim($ug_min_cgpa)))									
											{
												echo "<div class='alert alert-danger' role='alert'>
													<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
													<span class='sr-only'>Error:</span>


													Enter the min. cgpa!
													</div>";
											}
											elseif(empty(trim($ug_min_percentage)))									
											{
												echo "<div class='alert alert-danger' role='alert'>
													<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
													<span class='sr-only'>Error:</span>


													Enter the min. percentage!
													</div>";
											}	
											else
											{
												$reset_ug = 1;
											}
										}								
									echo'
								</div>
								<div class="col-md-offset-0 col-md-4 topMargin" >
									<div class="panel panel-info">					
										<div class="panel-heading center">Post Graduate(PG)</div>
										<div class="panel-body">										
											<div class="form-group betweenMargin">
												<div class="row">
													<label class="col-md-8">Minimun CGPA*</label>																		
												</div>	
												<input name="pg_min_cgpa" class="form-control" placeholder="CGPA"
												value=';
												if(isset($_POST['submit_criteria']))
												{
													if(!empty(trim($pg_min_cgpa)))
													{
														echo $pg_min_cgpa;
													}
												}
												echo '>
											</div>
											<div class="form-group">
												<div class="row">
													<label class="col-md-6">Minimum Percentage*</label>
													<label class="col-md-6"></label>
												</div>
												<input name="pg_min_percentage" class="form-control" placeholder="Percentage"
												value=';
												if(isset($_POST['submit_criteria']))
												{
													if(!empty(trim($pg_min_percentage)))
													{
														echo $pg_min_percentage;
													}
												}
												echo '>
											</div>																				
										</div>										
									</div>
									';
										if(isset($_POST['submit_criteria']))
										{
											if(empty(trim($pg_min_cgpa)) && empty(trim($pg_min_percentage)))									
											{
												echo "<div class='alert alert-danger' role='alert'>
													<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
													<span class='sr-only'>Error:</span>


													Enter the min. cgpa and min. percentage!
													</div>";
											}
											elseif(empty(trim($pg_min_cgpa)))									
											{
												echo "<div class='alert alert-danger' role='alert'>
													<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
													<span class='sr-only'>Error:</span>


													Enter the min. cgpa!
													</div>";
											}
											elseif(empty(trim($pg_min_percentage)))									
											{
												echo "<div class='alert alert-danger' role='alert'>
													<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
													<span class='sr-only'>Error:</span>


													Enter the min. percentage!
													</div>";
											}	
											else
											{
												$reset_pg = 1;
											}
										}								
									echo'			
								</div>
								<div class="form-group col-md-offset-5 col-md-2 topMargin">
									<div class="row">
										<label class="col-md-6">Age*</label>
										<label class="col-md-6"></label>
									</div>
									<input name="age" class="form-control" placeholder="Age"
									value=';
									if(isset($_POST['submit_criteria']))
									{
										echo $min_age;
									}
									echo '>
								</div>
								';
								if(isset($_POST['submit_criteria']))
								{	
									if(empty(trim($min_age)))									
									{
										echo "<div class='col-md-offset-5 col-md-2 alert alert-danger' role='alert'>
											<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
											<span class='sr-only'>Error:</span>


											Enter the min. age!
											</div>";
									}
									else
									{
										$reset_age = 1;
									}
								}
								echo'		
								<div class="col-md-offset-5 col-md-2 center topMargin">
									<button id="submit_criteria" name="submit_criteria" type="submit" class="btn btn-block btn-success">Submit</button>
								</div>																		
							</div>
						</div>
					</div>
					';				
				}

				if(isset($_POST['submit_criteria']) && $reset_ug== 1 && $reset_pg ==1 && $reset_age == 1 && isset($_SESSION['adminUserName']))
				{		

					echo "<script>$('#second_step').collapse('hide');</script>";
					//global $ug_min_cgpa,$ug_min_percentage,$pg_min_cgpa,$pg_min_percentage,$age;
					include("semester_database_connection.php");
					sem_connection($_SESSION['dbName']);
					
					global $semDbConnection;

					$query = "select ru.userId,pi.firstName,pi.lastName,ru.emailAddress,pi.currentAddress,pi.currentDistrict,pi.currentState,pi.currentPincode from registered_users as ru inner join personal_info as pi on pi.userId=ru.userId  where discipline='".$discipline."'";
					$resultQuery = mysqli_query($semDbConnection,$query);
					if($resultQuery)
					{
						$resultRows = mysqli_num_rows($resultQuery);
						if($resultRows == 0)
						{
							echo "<script>alert('no results!')</script>";
						}
						else
						{
							echo '						
								<div class="panel panel-default collapseMargin">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#third_step" aria-expanded="true" aria-controls="collapseOne">
												Shorlisted Applications:
											</a>
										</h4>
									</div>
									<div id="third_step" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">																															
										<div class="panel-body">
											<table class="table table-striped  topMargin">
												<tr>
													<td><strong><center>Sr. No.</center></strong></td>
													<td><strong><center>Apln. No.</center></strong></td>
													<td><strong>Full Name</strong></td>
													<td><strong>Email-Id</strong></td>
													<td><strong>Address for communication</strong></td>
												</tr>';
												$count = 1;
												while($array = mysqli_fetch_array($resultQuery))
												{											
													echo '<tr>
														<td class="col-md-1"><center>'.$count.'.</center></td>
														<td class="col-md-1"><a target="_blank" href=personal_info.php?app_no='.$array['userId'].
															'><center>'.$array['userId'].'</center></a>
														</td>
														<td class="col-md-3">'.$array['firstName'].' '.$array['lastName'].'</td>
														<td class="col-md-3"><a href="mailto:#">'.$array['emailAddress'].'</a></td>
														<td class="col-md-4">
															'.
															$array['currentAddress'].', '.
															$array['currentDistrict'].', '.
															$array['currentState'].'-'.
															$array['currentPincode']
															.'
														</td>
													</tr>';
													$count++;
												}
											echo'
											</table>
										</div>
									</div>
								</div>
							</div>';
						}
					}
					else
					{
						echo mysqli_error($semDbConnection);
					}					
				}	
			?>			
		</form>				
	</body>	
</html>
<script type="text/javascript">
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
</script>
