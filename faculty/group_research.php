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
							<h3 class="f_s_25 f_w_700 dark_text mr_30">Group Research</h3>
							<ol class="breadcrumb page_bradcam mb-0">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
								<li class="breadcrumb-item active">Group Research</li>
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
<?php

$resResearch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM archive_research_tbl WHERE selected_group_id = '{$_REQUEST['s_id']}' AND batch_year = '2022' ORDER BY archive_research_id DESC"));

if ($rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM archive_research_tbl WHERE selected_group_id = '{$_REQUEST['s_id']}' AND batch_year = '2022'")) > 0) {

	?>
	<div class="col-lg-12">
		<div class="card_box position-relative  mb_30 white_bg">
			<div class="white_box_tittle parpel_bg">
				<div class="main-title2 ">
					<h4 class="mb-2 nowrap text_white"><?php echo $resResearch['research_title']; ?></h4>
				</div>
			</div>
			<div class="box_body">
				<p class="f-w-400 "><?php echo $resResearch['research_description']; ?></p>
			</div>
			<!-- <div class="card_footer parpel_bg">
				<h6 class="text_white">Card Footer</h6>
			</div> -->
		</div>
		<a href="<?php echo $resResearch['research_file']; ?>" target="_blank" class="btn btn-success">Download Documentation</a>
		<?php
		$rowsComments = mysqli_num_rows(mysqli_query($con, "SELECT * FROM research_comments_tbl WHERE research_id = '{$resResearch['archive_research_id']}' AND teacher_id = '$uid'"));
		if ($rowsComments > 0) {
			?>
			<a href="#" data-bs-toggle="modal" data-bs-target="#view_comment_modal<?php echo $resResearch['archive_research_id']; ?>"  class="btn btn-info" style="color: white;">View Comment(<?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM research_comments_tbl WHERE research_id = '{$resResearch['archive_research_id']}'")); ?>)</a>
			<div class="modal fade" id="view_comment_modal<?php echo $resResearch['archive_research_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle"><?php echo $resResearch['research_title']; ?> Comments</h5>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<?php
							$qCom = mysqli_query($con, "SELECT * FROM research_comments_tbl WHERE research_id = '{$resResearch['archive_research_id']}'");
							if ($rowsComs = mysqli_num_rows($qCom) > 0) {
								# code...
							}else{
								?>
								<div class="col-lg-12">
									<div class="white_box mb_30">
										<div class="alert alert-warning" role="alert">
											<p>No comments Available.</p>
											<hr>
											<!-- <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> -->
										</div>
									</div>
									
								</div>
								<?php
							}
							while ($rCom = mysqli_fetch_assoc($qCom)) {
								$rTeach = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM teachers_tbl WHERE teacher_id = '{$rCom['teacher_id']}'"));
								?>
								<div class="">
									<label>Professor <?php echo $rTeach['fname'].' '.$rTeach['lname']; ?> | <small><?php echo $rCom['date_commented'].' '.$rCom['time_commented']; ?></small></label>
									<p><?php echo $rCom['comment']; ?></p>
								</div>
								<hr>
								<?php
							}
							?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<?php
		}else{

		}
		?>
		<a href="#" data-bs-toggle="modal" data-bs-target="#comment_modal<?php echo $resResearch['archive_research_id']; ?>"  class="btn btn-info" style="color: white;">Comment</a>
		<form action="controller/save_data.php" method="POST">
		<div class="modal fade" id="comment_modal<?php echo $resResearch['archive_research_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle"><?php echo $resResearch['research_title']; ?> Comments</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Comment</label>
							<textarea class="form-control" name="comment"></textarea>
							<input type="hidden" name="teacher_id" value="<?php echo $uid; ?>">
							<input type="hidden" name="research_id" value="<?php echo $resResearch['archive_research_id'] ?>">
							<input type="hidden" name="s_id" value="<?php echo $_REQUEST['s_id']; ?>">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<input type="submit" name="btnAddComment" value="Save" class="btn btn-info">
					</div>
				</div>
			</div>
		</div>
		</form>
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