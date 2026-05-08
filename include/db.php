<?php
date_default_timezone_set('ASIA/Manila');

if ($con = mysqli_connect("localhost", "thesissy_appsci", "Sw0rdf1sh@34", "thesissy_appsci")) {

	# code...
}else{

	?>
	<div class="alert alert-warning">
		<strong>Warning:</strong> <?php echo mysqli_error($con); ?>
	</div>
	<?php
}
?>