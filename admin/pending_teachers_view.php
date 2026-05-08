<?php include 'header.php'; ?>
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
	<div class="row">

		<div class="col-12">
			<div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
				<div class="page_title_left d-flex align-items-center">
					<h3 class="f_s_25 f_w_700 dark_text mr_30">Pending Accounts</h3>
					<ol class="breadcrumb page_bradcam mb-0">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active">Pending</li>
					</ol>
				</div>
				<div class="page_title_right">
					<div class="page_date_button d-flex align-items-center">
						<img src="img/icon/calender_icon.svg" alt="">
						<?php echo date('F j, Y', strtotime(date('Y-m-d'))); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="row "> <!-- Header -->

<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css">
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<div class="col-lg-12">
	<div class="white_card card_height_100 mb_30">
		<div class="white_card_header">
			<div class="box_header m-0">
				<div class="main-title">
					<h3 class="m-0">Teacher Members</h3>
				</div>
			</div>
		</div>
		<div class="white_card_body">
			<!-- <h6 class="card-subtitle mb_20">Just add the base class <code>.table</code> and <code>&lt;table&gt;</code>.</h6> -->
			<div class="table-responsive">
				<table class="table" id="myTable">
					<thead>
						<tr>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Last Name</th>
							<th>Contact Number</th>
							<th>Email</th>
							<th>School - Department</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($con, "SELECT * FROM teachers_tbl WHERE account_status = '0'");
						while ($row = mysqli_fetch_assoc($query)) {
							$resSchool = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM schools_tbl WHERE school_id = '{$row['school_id']}'"));
							$resDep = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM departments_tbl WHERE department_id = '{$row['department_id']}'"));
							?>
							<tr>
								<td><?php echo $row['fname']; ?></td>
								<td><?php echo $row['mname']; ?></td>
								<td><?php echo $row['lname']; ?></td>
								<td><?php echo $row['contact_number']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $resSchool['school_abr'].' '.$resDep['department_abr']; ?></td>
								<td>
									<a href="#" onclick="approve(<?php echo $row['teacher_id']; ?>);"><span class="badge rounded-pill bg-primary">Approve</span></a> <a href="#" onclick="disaprrove(<?php echo $row['teacher_id']; ?>);"><span class="badge rounded-pill bg-warning">Disapprove</span></a>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready( function () {
		$('#myTable').DataTable();
	});
	function approve(t_id) {
		if (confirm('Approve Teacher?')) {
			window.location.href='controller/save_data.php?t_id='+t_id+'&btnApproveTeacher=1';
		}
	}
	function disaprrove(t_id) {
		if (confirm('Disapprove Teacher?')) {
			window.location.href='controller/save_data.php?t_id='+t_id+'&btnDisapproveTeacher=1';
		}
	}
</script>
<?php include 'footer.php'; ?>