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
	<div class="col-lg-12">
		<h6>Research Status: 
			<?php
			if ($resResearch['research_status'] == '0') {
				echo "<b>Pending</b>";
			}elseif ($resResearch['research_status'] == '1') {
				echo "<b>Proposed</b>";
			}elseif ($resResearch['research_status'] == '2') {
				echo "<b>Ongoing</b> | <b>Date Approved:</b> ".$resResearch['research_approved'];
			}elseif ($resResearch['research_status'] == '3') {
				echo "<b>Done/Published</b>";
			}
			?>
		</h6>
		<?php

		if ($resInfo['group_role'] == '1') {
			if ($resResearch['research_status'] == '0') {
				?>
				<a href="edit_research_pending_view.php?r_id=<?php echo $resResearch['research_id']; ?>" class="btn btn-primary">Edit</a>
				<?php
			}elseif ($resResearch['research_status'] == '1') {
				?>
				<a href="edit_research_pending_view.php?r_id=<?php echo $resResearch['research_id']; ?>" class="btn btn-primary">Edit</a>
				<?php
			}elseif ($resResearch['research_status'] == '2') {
				?>
				<a href="edit_ongoing_research_view.php?r_id=<?php echo $resResearch['research_id']; ?>" class="btn btn-primary">Edit</a>
				<?php
				if (empty($resResearch['research_file'])) {
					?>
					<button class="btn btn-warning" disabled="true">Edit and Upload File First</button>
					<?php
				}else{
					?>
					<a href="<?php echo $resResearch['research_file']; ?>" class="btn btn-success" target="_blank">Download Documentation</a>
					<?php
				}
			}elseif ($resResearch['research_status'] == '3') {
				?>
				<a href="edit_ongoing_research_view.php?r_id=<?php echo $resResearch['research_id']; ?>" class="btn btn-primary">Edit</a>
				<?php
				if (empty($resResearch['research_file'])) {
					?>
					<button class="btn btn-warning" disabled="true">Edit and Upload File First</button>
					<?php
				}else{
					?>
					<a href="<?php echo $resResearch['research_file']; ?>" class="btn btn-success" target="_blank">Download Documentation</a>
					<?php
				}
			}
		}else{

		}

		
		?>
		<br><br>
		
		<div class="card_box position-relative  mb_30 white_bg">
			<div class="white_box_tittle parpel_bg" style="padding: 10px;">
				<div class="main-title2 ">
					<center><h1 class="mb-2 nowrap text_white"><?php echo $resResearch['research_title']; ?>
					</h1></center>
				</div>
			</div>
			<div class="row">
				<div class="box_body col-md-6">
					<h4>Description</h4>
					<p class="f-w-400 "><?php echo $resResearch['research_description']; ?></p>
				</div>
				<div class="box_body col-md-6">
					<h4>Abstract</h4>
					<p class="f-w-400 "><?php echo $resResearch['research_abstract']; ?></p>
				</div>
			</div>
			
			<!-- <div class="card_footer parpel_bg">
				<h6 class="text_white">Card Footer</h6>
			</div> -->
		</div>
		
	</div>

	<div class="table-responsive" style="display: none;">
		<a href="add_chapter_view.php?r_id=<?php echo $resResearch['research_id']; ?>" style="color: white;" class="btn btn-info">Add Chapters</a> 
		<?php
		if ($resInfo['group_role'] == '1') {
			?>
			<a href="pending_chapters.php?r_id=<?php echo $resResearch['research_id']; ?>" style="color: white;" class="btn btn-primary">Pending Chapters</a>
			<?php
		}else{

		}
		?>

		<br><br>
				<table class="table" id="myTable">
					<thead>
						<tr>
							<th>Chapter</th>
							<th>Title</th>
							<th>Author</th>
							<th>Group</th>
							<?php
							if ($resInfo['group_role'] == '1') {
								?>
								<th>Action</th>
								<?php
							}else{

							}
							?>
							
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($con, "SELECT * FROM research_chapters_tbl WHERE research_id = '{$resResearch['research_id']}' AND chapter_status = '1'");
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
							<tr>
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
									<?php
									if ($resInfo['group_role'] == '1') {
										?>
										<td>
										<a href="edit_chapter_view.php?r_c_id=<?php echo $row['research_chapter_id']; ?>">Edit</a></td>
										<?php
									}else{

									}
									?>
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

<?php include 'footer.php'; ?>