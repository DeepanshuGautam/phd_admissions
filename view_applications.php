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

		<form method='post' action='view_applications.php'>

			<div class="panel-group content" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Choose:
							</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							Deepanshu
						</div>
					</div>
				</div>
			</div>

			<div class='content'>
				<label id='discipline_label'>Discipline: </label>	

				<select id='discipline' name='discipline' class='discipline_options'>
					<option value='Computer Engineering'<?php if(isset($_POST['submit'])) if($_POST['discipline'] == 'Computer Engineering') echo "selected";?> >Computer Engineering</option>
					<option value='Electronics'<?php if(isset($_POST['submit'])) if($_POST['discipline'] == 'Electronics') echo "selected";?>>Electronics</option>
					<option value='Mechanical'<?php if(isset($_POST['submit'])) if($_POST['discipline'] == 'Mechanical') echo "selected";?>>Mechanical</option>
					<option value='Mathematics'<?php if(isset($_POST['submit'])) if($_POST['discipline'] == 'Mathematics') echo "selected";?>>Mathematics</option>
					<option value='Physics'<?php if(isset($_POST['submit'])) if($_POST['discipline'] == 'Physics') echo "selected";?>>Physics</option>
				</select>

				<input type='submit' name='submit' value='Submit' id='submitB'></input>				
			</div>	
		</form>	
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