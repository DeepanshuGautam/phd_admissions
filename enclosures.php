<?php
	$appNo = $_GET['app_no'];
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $appNo; ?>: Enclosures</title>

		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
		<script type="text/javascript" src="js/jquery.min.js"></script>	
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>	

		<link rel="stylesheet" type="text/css" href="align_css.css">
	</head>
	<body>
		<p class="topMargin"><h1><center><?php echo $appNo; ?></center></h1></p>
		<?php include("print_close.php");?>
		<ul class="nav nav-tabs content topMargin">
			<li role="presentation"><a href="personal_info.php?app_no=<?php echo $appNo;?>">Personal Info</a></li>	
			<li role="presentation"><a href="academic_info.php?app_no=<?php echo $appNo;?>">Academic Info</a></li>	
			<li role="presentation" class="active"><a href="enclosures.php?app_no=<?php echo $appNo;?>">Enclosures</a></li>	
		</ul>		
		
		<div class="topMargin content" >															
			<p class="col-md-6"><strong>Full Name</strong></p>
			<p class="col-md-6">Deepanshu Gautam</p>
			<p class="col-md-6"><strong>Gender</strong></p>
			<p class="col-md-6">Male</p>
		</div>					
				
	</body>
</html>
	