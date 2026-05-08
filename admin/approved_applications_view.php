<?php include 'header.php'; ?>
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
	<div class="row">

		<div class="col-12">
			<div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
				<div class="page_title_left d-flex align-items-center">
					<h3 class="f_s_25 f_w_700 dark_text mr_30">Approved/Completed Applications</h3>
					<ol class="breadcrumb page_bradcam mb-0">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active">Approved</li>
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

	<div class="row">
		<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css">
		<script type="text/javascript" src="DataTables/datatables.min.js"></script>

		<div class="col-lg-12">
			<div class="white_card card_height_100 mb_30">
				<div class="white_card_header">
					<div class="box_header m-0">
						<div class="main-title">
							<h3 class="m-0">Approved/Completed Applications</h3>
						</div>
					</div>
				</div>
				<div class="white_card_body">
					<div class="table-responsive">
						<table class="table" id="myTable">
							<thead>
								<tr>
									<th>Applicant Name</th>
									<th>Contact Number</th>
									<th>Email</th>
									<th>Job Title</th>
									<th>Application Letter</th>
									<th>TOR</th>
									<th>Resume</th>
									<th>Diploma</th>
									<th>Cover Letter</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query = mysqli_query($con, 
									 "SELECT r.requirement_id, r.applicant_status, m.fname, m.mname, m.lname, m.contact_no, m.email, 
								            j.job_name, r.application_letter, r.tor, r.resume, r.diploma, r.cover_letter 
								     FROM requirements_tbl r
								     JOIN members_tbl m ON r.member_id = m.member_id
								     JOIN jobs_tbl j ON r.job_id = j.job_id
								     WHERE r.applicant_status IN (1,2)"
								);
								while ($row = mysqli_fetch_assoc($query)) {
									?>
									<tr>
										<td><?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?></td>
										<td><?php echo $row['contact_no']; ?></td>
										<td><?php echo $row['email']; ?></td>
										<td><?php echo $row['job_name']; ?></td>
										<td><a href="../uploads/<?php echo $row['application_letter']; ?>" target="_blank">View</a></td>
										<td><a href="../uploads/<?php echo $row['tor']; ?>" target="_blank">View</a></td>
										<td><a href="../uploads/<?php echo $row['resume']; ?>" target="_blank">View</a></td>
										<td><a href="../uploads/<?php echo $row['diploma']; ?>" target="_blank">View</a></td>
										<td><?php echo $row['cover_letter']; ?></td>
										<td>
										    <?php if ($row['applicant_status'] == 2): ?>
										        N/A
										    <?php else: ?>
										        <a href="#" onclick="updateStatus(<?php echo $row['requirement_id']; ?>, 2);">
										            <span class="badge rounded-pill bg-success">Complete</span>
										        </a>
										    <?php endif; ?>
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

	function updateStatus(requirement_id, status) {
		let message = '';
		if (status == 1) message = 'Approve this application?';
		else if (status == 2) message = 'Mark this application as completed?';
		else if (status == 3) message = 'Cancel this application?';

		if (confirm(message)) {
			window.location.href = 'controller/save_data.php?requirement_id=' + requirement_id + '&status=' + status;
		}
	}
</script>

<?php include 'footer.php'; ?>
