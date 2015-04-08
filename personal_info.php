<?php
	$appNo = $_GET['app_no'];	
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $appNo; ?> Personal Info</title>

		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
		<script type="text/javascript" src="js/jquery.min.js"></script>	
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>	

		<link rel="stylesheet" type="text/css" href="align_css.css">
	</head>
	<body>
		<p class="topMargin"><h1><center><?php echo $appNo; ?></center></h1></p>
		<center>
		<?php include("print_close.php");?>
		</center>
		<ul class="nav nav-tabs content topMargin">
			<li role="presentation" class="active"><a href="personal_info.php?app_no=<?php echo $appNo;?>">Personal Info</a></li>	
			<li role="presentation"><a href="academic_info.php?app_no=<?php echo $appNo;?>">Academic Info</a></li>	
			<li role="presentation"><a href="enclosures.php?app_no=<?php echo $appNo;?>">Enclosures</a></li>	
		</ul>		
		
		<div class="topMargin content" >															
			<p class="col-md-6"><strong>Full Name</strong></p>
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Gender</strong></p>
			<p class="col-md-6">Male</p>

			<p class="col-md-6"><strong>Date Of Birth</strong></p>	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Father's / Husband's Name</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Nationality</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Marital Status</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Physically Challenged</strong></p> 	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Community</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Personal Email-ID</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Alternate Email-ID</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-12 topMargin"><strong><ins>Present Address</ins></strong></p>			  	
			<p class="col-md-6"><strong>Address</strong></p> 	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>District/City</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>State/UT</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Pincode</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Phone with Area Code</strong></p>			   
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Mobile</strong></p>			    	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-12 topMargin"><strong><ins>Permanent Address</ins></strong></p>			  	
			<p class="col-md-6"><strong>Address</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>District/City</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>State/UT</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Pincode</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Phone with Area Code</strong></p>  	
			<p class="col-md-6">Deepanshu Gautam</p>

			<p class="col-md-6"><strong>Mobile</strong></p>  
			<p class="col-md-6">Deepanshu Gautam</p>

		</div>					
				
	</body>
</html>
	