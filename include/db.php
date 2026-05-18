<?php
date_default_timezone_set('ASIA/Manila');

function appsci_column_exists($con, $table, $column) {
	$table = mysqli_real_escape_string($con, $table);
	$column = mysqli_real_escape_string($con, $column);
	$result = mysqli_query($con, "SHOW COLUMNS FROM `{$table}` LIKE '{$column}'");
	return ($result && mysqli_num_rows($result) > 0);
}

if ($con = mysqli_connect("localhost", "thesissy_appsci", "Sw0rdf1sh@34", "thesissy_appsci")) {
	try {
		if (!appsci_column_exists($con, 'members_tbl', 'school_year')) {
			mysqli_query($con, "ALTER TABLE members_tbl ADD COLUMN school_year VARCHAR(20) DEFAULT NULL");
		}
		if (!appsci_column_exists($con, 'members_tbl', 'archived')) {
			mysqli_query($con, "ALTER TABLE members_tbl ADD COLUMN archived TINYINT(1) NOT NULL DEFAULT 0");
		}
		if (!appsci_column_exists($con, 'modules_tbl', 'section')) {
			mysqli_query($con, "ALTER TABLE modules_tbl ADD COLUMN section VARCHAR(100) DEFAULT NULL");
		}
	} catch (Throwable $e) {
		// Avoid startup fatal errors in production when DB auto-migration checks fail.
	}
}else{

	?>
	<div class="alert alert-warning">
		<strong>Warning:</strong> <?php echo mysqli_error($con); ?>
	</div>
	<?php
}


?>
