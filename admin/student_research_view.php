<?php include 'header.php'; ?>
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
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
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
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

$resResearch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM archive_research_tbl WHERE archive_research_id = '{$_REQUEST['r_id']}' ORDER BY archive_research_id DESC"));

if ($rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM archive_research_tbl WHERE archive_research_id = '{$_REQUEST['r_id']}'")) > 0) {

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
		<a target="_blank" href="<?php echo $resResearch['research_file']; ?>" class="btn btn-success">Download Documentation</a>
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
</div>
</div>
<?php include 'footer.php'; ?>