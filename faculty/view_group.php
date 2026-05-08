<?php include 'header.php'; ?>
<div class="main_content_iner overly_inner ">
		<div class="container-fluid p-0 ">
			<div class="row">

				<div class="col-12">
					<div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
						<div class="page_title_left d-flex align-items-center">
							<h3 class="f_s_25 f_w_700 dark_text mr_30">Groups</h3>
							<ol class="breadcrumb page_bradcam mb-0">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
								<li class="breadcrumb-item active">Groups</li>
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

			<div class="row ">
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css">
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<div class="col-lg-12">
	<div class="white_card card_height_100 mb_30">
		<div class="white_card_header">
			<div class="box_header m-0">
				<div class="main-title">
					<h3 class="m-0">My Members</h3>
				</div>
					<a href="group_research.php?s_id=<?php echo $_REQUEST['s_id']; ?>" class="btn btn-primary">View Research</a>
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
							<th>Course & Section</th>
							<th>Group</th>
							<th>Role</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$rSG1 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE selected_group_id = '{$_REQUEST['s_id']}'"));
						$query = mysqli_query($con, "SELECT * FROM members_tbl WHERE group_id = '{$rSG1['group_id']}' AND school_batch = '2022' AND account_status = '1'");
						while ($row = mysqli_fetch_assoc($query)) {
							$rC = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM course_tbl WHERE course_id = '{$row['course_id']}'"));
							$rS = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM section_tbl WHERE section_id = '{$row['section_id']}'"));
							$rG = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM groups_tbl WHERE group_id = '{$row['group_id']}'"));
							?>
							<tr>
								<td><?php echo $row['fname']; ?></td>
								<td><?php echo $row['mname']; ?></td>
								<td><?php echo $row['lname']; ?></td>
								<td><?php echo $rC['course_name'].' '.$rS['section_name']; ?></td>
								<td><?php echo $rG['group_name']; ?></td>
								<td>
									<?php
									if ($row['group_role'] == '1') {
										echo "Leader";
									}elseif ($row['group_role'] == '2') {
										echo "Member";
									}
									?>
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
<script type="text/javascript">
	$(document).ready( function () {
		$('#myTable').DataTable();
	});
</script>
<?php include 'footer.php'; ?>