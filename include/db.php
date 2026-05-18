<?php
date_default_timezone_set('Asia/Manila');

function appsci_column_exists($con, $table, $column) {
	$table = mysqli_real_escape_string($con, $table);
	$column = mysqli_real_escape_string($con, $column);
	try {
		$result = mysqli_query($con, "SHOW COLUMNS FROM `{$table}` LIKE '{$column}'");
	} catch (Throwable $e) {
		error_log('AppSci DB migration check failed for ' . $table . '.' . $column . ': ' . $e->getMessage());
		return false;
	}
	return ($result && mysqli_num_rows($result) > 0);
}

function appsci_run_migration($con, $sql, $label) {
	try {
		if (!mysqli_query($con, $sql)) {
			error_log('AppSci DB migration failed for ' . $label . ': ' . mysqli_error($con));
		}
	} catch (Throwable $e) {
		error_log('AppSci DB migration exception for ' . $label . ': ' . $e->getMessage());
	}
}

if ($con = mysqli_connect("localhost", "thesissy_appsci", "Sw0rdf1sh@34", "thesissy_appsci")) {
	if (!appsci_column_exists($con, 'members_tbl', 'school_year')) {
		appsci_run_migration($con, "ALTER TABLE members_tbl ADD COLUMN school_year VARCHAR(20) DEFAULT NULL", 'members_tbl.school_year');
	}
	if (!appsci_column_exists($con, 'members_tbl', 'archived')) {
		appsci_run_migration($con, "ALTER TABLE members_tbl ADD COLUMN archived TINYINT(1) NOT NULL DEFAULT 0", 'members_tbl.archived');
	}
	if (!appsci_column_exists($con, 'modules_tbl', 'section')) {
		appsci_run_migration($con, "ALTER TABLE modules_tbl ADD COLUMN section VARCHAR(100) DEFAULT NULL", 'modules_tbl.section');
	}
} else {

	?>
	<div class="alert alert-warning">
		<strong>Warning:</strong> <?php echo mysqli_error($con); ?>
	</div>
	<?php
}


?>
