<?php
date_default_timezone_set('Asia/Manila');

function appsci_column_exists($con, $table, $column) {
	if (!preg_match('/^[A-Za-z0-9_]+$/', $table) || !preg_match('/^[A-Za-z0-9_]+$/', $column)) {
		error_log('AppSci DB migration check skipped for invalid identifier: ' . $table . '.' . $column . '.');
		return false;
	}

	try {
		$stmt = mysqli_prepare(
			$con,
			'SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ? LIMIT 1'
		);
		if (!$stmt) {
			error_log('AppSci DB migration check prepare failed for ' . $table . '.' . $column . '.');
			return false;
		}

		mysqli_stmt_bind_param($stmt, 'ss', $table, $column);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
	} catch (Throwable $e) {
		error_log('AppSci DB migration check failed for ' . $table . '.' . $column . '.');
		return false;
	}
	return ($result && mysqli_num_rows($result) > 0);
}

function appsci_run_migration($con, $sql, $label) {
	try {
		if (!mysqli_query($con, $sql)) {
			error_log('AppSci DB migration failed for ' . $label . ' (errno ' . mysqli_errno($con) . ').');
		}
	} catch (Throwable $e) {
		error_log('AppSci DB migration exception for ' . $label . '.');
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
