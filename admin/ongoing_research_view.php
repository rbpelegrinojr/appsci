<?php include 'header.php'; ?>
<style type="text/css">
	.modal-backdrop {
    position: relative;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: #000;
}
</style>
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
	<div class="row">

		<div class="col-12">
			<div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
				<div class="page_title_left d-flex align-items-center">
					<h3 class="f_s_25 f_w_700 dark_text mr_30">Research</h3>
					<ol class="breadcrumb page_bradcam mb-0">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
					<h3 class="m-0">Ongoing Research</h3>
				</div>
			</div>
		</div>
		<div class="white_card_body">
			<!-- <h6 class="card-subtitle mb_20">Just add the base class <code>.table</code> and <code>&lt;table&gt;</code>.</h6> -->
			<div class="table-responsive">
				<table class="table" id="myTable">
					<thead>
						<tr>
							<th>Research Title</th>
							<th style="display: none;">Research Adviser</th>
							<th>Group</th>
							<th>Course Section Year Batch</th>
							<th>Date Created</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($con, "SELECT * FROM research_tbl WHERE research_status = '2'");
						while ($row = mysqli_fetch_assoc($query)) {
							$rSelecGroup = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE selected_group_id = '{$row['selected_group_id']}'"));
							$rMem = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE member_id = '{$row['member_id']}'"));
							$resTeach = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM teachers_tbl WHERE teacher_id = '{$rSelecGroup['teacher_id']}'"));
							?>
							<tr>
								<td><?php echo $row['research_title']; ?></td>
								<td style="display: none;"><?php echo $resTeach['fname'].' '.$resTeach['lname']; ?></td>
								
								<td>
									<?php
									$rG = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM groups_tbl WHERE group_id = '{$rSelecGroup['group_id']}'"));
									echo $rG['group_name'];
									?>
								</td>
								<td>
									<?php
									$rCourse = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM course_tbl WHERE course_id = '{$rMem['course_id']}'"));
									$rSec = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM section_tbl WHERE section_id = '{$rMem['section_id']}'"));
									echo $rCourse['course_name'].' - '.$rSec['section_name'].' / ';
									if ($rMem['year_level'] == '1') {
										echo "1st Year";
									}elseif ($rMem['year_level'] == '2') {
										echo "2nd Year";
									}elseif ($rMem['year_level'] == '3') {
										echo "3rd Year";
									}elseif ($rMem['year_level'] == '4') {
										echo "4th Year";
									}
									echo " - ".$rSelecGroup['batch_year'];
									?>
								</td>
								<td><?php echo $row['research_created']; ?></td>
								<td><a href="#" onclick="publishResearch(<?php echo $row['research_id']; ?>);"><span class="badge rounded-pill bg-primary">Publish</span></a>
									<a href="../main/archive_content.php?a_id=<?php echo $row['research_id']; ?>" target="_blank"><span class="badge rounded-pill bg-success">Preview</span></a>
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
	function publishResearch(r_id) {
		if (confirm('Publish Reseach Paper?')) {
			window.location.href='controller/save_data.php?r_id='+r_id+'&btnPublish=1';
		}
	}
</script>
<?php include 'footer.php'; ?>