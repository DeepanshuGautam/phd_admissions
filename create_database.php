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
			function alert_modal($msg)
			{				
				echo'
					<div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Alert!</h4>
								</div>
								<div class="modal-body">
									'.$msg.'
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
					alert_modal("Fill in the year value!");
				}
				else
				{
					$query = "select dbName from db_list where year='".$year."' and semester='".$semester."'";
					$queryResult = mysqli_query($masterDbConnection,$query);
					if($queryResult)
					{
						$queryRows = mysqli_num_rows($queryResult);
						if($semester == 0)
						{
							$sm = "Odd";
							$s = "o";
						}
						else if($semester == 1)
						{
							$sm = "Even";
							$s = "e";
						}

						if($queryRows != 0)
						{

							existing_modal($year,$sm);
						}
						else
						{
							$yrArray = str_split($year,2);							
							$queryCD = "CREATE DATABASE IF NOT EXISTS dm".(string)$yrArray[1].(string)$s."D DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci";
							$queryResultCD = mysqli_query($masterDbConnection,$queryCD);



/*
USE `dm15ed`;

-- --------------------------------------------------------

--
-- Table structure for table `email_confirmation`
--

CREATE TABLE IF NOT EXISTS `email_confirmation` (
`confirmationId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `confirmationLink` varchar(128) NOT NULL,
  `confirmationStatus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `userId` int(11) NOT NULL,
  `organisationName` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `startMonth` varchar(3) NOT NULL,
  `startYear` int(11) NOT NULL,
  `endMonth` varchar(3) NOT NULL,
  `endYear` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE IF NOT EXISTS `password_reset` (
`resetRequestId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `resetLink` varchar(128) NOT NULL,
  `resetStatus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE IF NOT EXISTS `personal_info` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(12) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `fatherName` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `maritalStatus` varchar(50) NOT NULL,
  `physicallyChallenged` tinyint(1) NOT NULL,
  `community` varchar(50) NOT NULL,
  `minority` varchar(50) NOT NULL,
  `primaryEmail` varchar(50) NOT NULL,
  `alternateEmail` varchar(50) NOT NULL,
  `currentAddress` varchar(50) NOT NULL,
  `currentDistrict` varchar(50) NOT NULL,
  `currentState` varchar(50) NOT NULL,
  `currentPincode` varchar(15) NOT NULL,
  `mobileNumber` varchar(15) NOT NULL,
  `permanentAddress` varchar(50) NOT NULL,
  `permanentDistrict` varchar(50) NOT NULL,
  `permanentState` varchar(50) NOT NULL,
  `permanentPincode` varchar(15) NOT NULL,
  `alternateMobileNumber` varchar(15) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE IF NOT EXISTS `qualifications` (
  `userId` int(11) NOT NULL,
  `10_instituteName` varchar(100) NOT NULL,
  `10_degreeName` varchar(100) NOT NULL,
  `10_aggregate` float NOT NULL,
  `10_gradeFormat` varchar(50) NOT NULL,
  `10_yearOfPassing` int(11) NOT NULL,
  `12_instituteName` varchar(100) NOT NULL,
  `12_degreeName` varchar(100) NOT NULL,
  `12_aggregate` float NOT NULL,
  `12_gradeFormat` varchar(50) NOT NULL,
  `12_yearOfPassing` int(11) NOT NULL,
  `ug_university` varchar(100) NOT NULL,
  `ug_degreeName` varchar(100) NOT NULL,
  `ug_aggregate` float NOT NULL,
  `ug_gradeFormat` varchar(50) NOT NULL,
  `ug_yearOfPassing` int(11) NOT NULL,
  `pg_university` varchar(100) NOT NULL,
  `pg_degreeName` varchar(100) NOT NULL,
  `pg_aggregate` float NOT NULL,
  `pg_gradeFormat` varchar(50) NOT NULL,
  `pg_yearOfPassing` int(11) NOT NULL,
  `ug_discipline` varchar(50) NOT NULL,
  `pg_discipline` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE IF NOT EXISTS `registered_users` (
`userId` int(11) NOT NULL,
  `emailAddress` varchar(60) NOT NULL,
  `password` varchar(128) NOT NULL,
  `discipline` varchar(25) NOT NULL,
  `mode` varchar(10) NOT NULL,
  `emailConfirmationStatus` tinyint(1) NOT NULL DEFAULT '0',
  `applicationSubmitStatus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/
											
							//echo $queryCD;
							if($queryResultCD)
							{
								$queryUpdateMasterDB = "insert into phd_admission_master.db_list (dbName,year,semester,activeStatus) values ('dm".(string)$yrArray[1].(string)$s."d',".$year.",".$semester.",0)";
								$updateQueryResult = mysqli_query($masterDbConnection,$queryUpdateMasterDB);
								//echo $queryUpdateMasterDB;
								if($updateQueryResult)
								{
									alert_modal("Database of $sm semester of the year $year has been created successfully");
								}
								else
								{
									echo mysql_error();
								}
							}
							else
							{
								echo mysql_error();
							}
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
	#body{
		width: 98.9%;		
	}
</style>