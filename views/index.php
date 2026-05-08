<?php include 'header.php';
$resSelect = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE group_id = '{$resInfo['group_id']}' AND batch_year = '{$resInfo['batch_year']}'"));
?>
<div class="row">

	<div class="col-12">
		<div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
			<div class="page_title_left d-flex align-items-center">
				<h3 class="f_s_25 f_w_700 dark_text mr_30">Announcments</h3>
				<ol class="breadcrumb page_bradcam mb-0">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">Announcements</li>
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

<div class="col-lg-12">
		<div class="card_box box_shadow position-relative mb_30">
			<div class="white_box_tittle ">
				<div class="main-title2 ">
					<h4 class="mb-2 nowrap">Announcement From Professor <?php $rT = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM teachers_tbl WHERE teacher_id = '{$resSelect['teacher_id']}'")); echo $rT['fname'].' '.$rT['lname']; ?></h4>
					
				</div>
			</div>
			<div class="box_body">
				<div class="default-according" id="accordion1">
					<?php
					
					$query = mysqli_query($con, "SELECT * FROM announcements_tbl WHERE selected_group_id = '{$resSelect['selected_group_id']}' ORDER BY announcement_id DESC");
					if ($rows = mysqli_num_rows($query) > 0) {
						# code...
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
									<h3>No Announcements Available</h3>
									<hr>
									<!-- <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> -->
								</div>
							</div>
							
						</div>
						<?php
					}
					while ($row = mysqli_fetch_assoc($query)) {
						?>
	
					<div class="card">
						<div class="card-header pink_bg" id="headingFour">
							<h5 class="mb-0" style="color: white;">
								<a class="btn text_white collapsed" data-bs-toggle="collapse" data-bs-target="#announcement<?php echo $row['announcement_id']; ?>" aria-expanded="false" aria-controls="collapseFour"><?php echo $row['announcement_title']; ?> - <small style="font-size: 10px;"><?php echo $row['announcement_date_created'].' / '.$row['announcement_time_created']; ?></small></a>
							</h5>
						</div>
						<div class="collapse" id="announcement<?php echo $row['announcement_id']; ?>" aria-labelledby="headingOne" data-parent="#accordion1" style="">
							<div class="card-body"><?php echo $row['announcement_content']; ?></div>
						</div>
					</div>
						<?php
					}
					?>

				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>