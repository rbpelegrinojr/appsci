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
<div class="row">

	<div class="col-12">
		<div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
			<div class="page_title_left d-flex align-items-center">
				<h3 class="f_s_25 f_w_700 dark_text mr_30">Research</h3>
				<ol class="breadcrumb page_bradcam mb-0">
					<li class="breadcrumb-item"><a href="our_research_view.php">Home</a></li>
					<li class="breadcrumb-item active">Research</li>
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
<?php
$resSelectedGroup = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE group_id = '{$resInfo['group_id']}' AND batch_year = '{$resInfo['school_batch']}'"));

$resResearch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_tbl WHERE selected_group_id = '{$resSelectedGroup['selected_group_id']}' AND research_status != '4'"));

if ($rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM research_tbl WHERE selected_group_id = '{$resSelectedGroup['selected_group_id']}' AND research_status != '4'")) > 0) {

	?>
	

	<div class="table-responsive">
		<a href="our_research_view.php" style="color: white;" class="btn btn-info">Back</a>
		<br><br>
				<table class="table" id="myTable">
					<thead>
						<tr class="text-center">
							<th>Chapter</th>
							<th>Title</th>
							<th>Author</th>
							<th>Group</th>
							<th>Action</th>
							<th>View</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($con, "SELECT * FROM research_chapters_tbl WHERE research_id = '{$resResearch['research_id']}' AND chapter_status = '0'");
						if ($rowsChap = mysqli_num_rows($query) > 0) {
							# code...
						}else{
							?>
							<div class="alert alert-warning">No Data.</div>
							<?php
						}
						while ($row = mysqli_fetch_assoc($query)) {
							$rC = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM course_tbl WHERE course_id = '{$resInfo['course_id']}'"));
							$rS = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM section_tbl WHERE section_id = '{$resInfo['section_id']}'"));
							$rG = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM groups_tbl WHERE group_id = '{$resInfo['group_id']}'"));
							$resRes = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_tbl WHERE research_id = '{$row['research_id']}'"));
							?>
							<tr class="text-center">
								<td><?php echo 'Chapter '.$row['chapter_no']; ?></td>
								<td><?php echo $row['chapter_title']; ?></td>
								<td>
									<?php
									$qChapAuth = mysqli_query($con, "SELECT * FROM research_chapter_authors_tbl WHERE research_chapter_id = '{$row['research_chapter_id']}'");
									while ($rChapAuth = mysqli_fetch_assoc($qChapAuth)) {
										$rMem = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE member_id = '{$rChapAuth['member_id']}'"));
										echo $rMem['fname'].' '.$rMem['lname'].', ';
									}
									?>
								</td>
								<td><?php echo $rG['group_name']; ?></td>
								<td>
									<?php
									if ($resInfo['group_role'] == '1') {
										?>
										<a href="#" onclick="approveChap(<?php echo $row['research_chapter_id']; ?>);"><span class="ti-thumb-up">Approve</span></a> | <a href="#" onclick="disapproveChap(<?php echo $row['research_chapter_id']; ?>);"><span class="ti-thumb-down">Disapprove</span></a>
										<?php
									}else{

									}
									?>
									
								</td>
								<td><a href="view_chapter.php?c_id=<?php echo $row['research_chapter_id']; ?>"><span class="ti-eye"></span></a></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>

	<?php
	
}else{
	?>
	<div class="col-lg-12">
		<div class="white_box mb_30">
			<!-- <div class="box_header ">
				<div class="main-title">
					<h3 class="mb-0">Syste</h3>
				</div>
			</div> -->
			<div class="alert alert-warning" role="alert">
				<h4 class="alert-heading">Sorry!</h4>
				<p>You don't have available research.</p>
				<hr>
				<!-- <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> -->
			</div>
		</div>
		
	</div>
	<?php
}
?>
<script type="text/javascript">
	function approveChap(c_id) {
		if (confirm('Approve Chapter?')) {
			window.location.href='controller/approve.php?c_id='+c_id+'&btnApproveChap=1';
		}
	}

	function disapproveChap(c_id) {
		if (confirm('Disapprove Chapter')) {
			window.location.href='controller/approve.php?c_id='+c_id+'&btnDispproveChap=1';
		}
		
	}
</script>
<?php include 'footer.php'; ?>