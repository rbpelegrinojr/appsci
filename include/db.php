<?php
date_default_timezone_set('ASIA/Manila');

// if () {

// 	// Ensure school_year column exists
// 	mysqli_query($con, "ALTER TABLE members_tbl ADD COLUMN IF NOT EXISTS school_year VARCHAR(20) DEFAULT NULL");
// 	// Ensure archived column exists
// 	mysqli_query($con, "ALTER TABLE members_tbl ADD COLUMN IF NOT EXISTS archived TINYINT(1) NOT NULL DEFAULT 0");
// 	// Ensure modules section column exists
// 	mysqli_query($con, "ALTER TABLE modules_tbl ADD COLUMN IF NOT EXISTS section VARCHAR(100) DEFAULT NULL");

// }else{

// 	?>
// 	<div class="alert alert-warning">
// 		<strong>Warning:</strong> <?php echo mysqli_error($con); ?>
// 	</div>
// 	<?php
// }

$con = mysqli_connect("localhost", "thesissy_appsci", "Sw0rdf1sh@34", "thesissy_appsci")
?>
