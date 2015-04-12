<html>
<form method="post" action="overwrite.php">
			
	<div class="modal fade" id="overwrite_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Alert!</h4>
				</div>
				<div class="modal-body">
					The database of  semester of year is already active. Press continue to deactivate this and activate the database of  semester and year 
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" name="submit" class="btn btn-primary" data-dismiss="modal">Continue</button>								
				</div>
			</div>
		</div>
	</div>	
			


	<?php
		function overwrite_modal($y,$m)
		{
			echo "<script type='text/javascript'>$('#overwrite_modal').modal('show')</script>";
		}

		echo var_dump($_POST['submit']);
		if(isset($_POST['overwrite']))			
		{

			echo "<script>alert('hi');</script";
		}	
	?>
</form>	
</html>
