<?php include 'header.php'; ?>
<div class="row">

	<div class="col-12">
		<div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
			<div class="page_title_left d-flex align-items-center">
				<h3 class="f_s_25 f_w_700 dark_text mr_30">Add Proposed Research</h3>
				<ol class="breadcrumb page_bradcam mb-0">
					<li class="breadcrumb-item"><a href="our_research_view.php">Home</a></li>
					<!-- <li class="breadcrumb-item active">Add Proposed Research</li> -->
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
<?php $resSel = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE group_id = '{$resInfo['group_id']}' AND member_id = '{$resInfo['member_id']}'")); ?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<div class="col-lg-12">
	<div class="white_card card_height_100 mb_30">
		<div class="white_card_header">
			<div class="box_header m-0">
				<div class="main-title">
					<h3 class="m-0">Add Proposed Research</h3>
				</div>
			</div>
		</div>
		<div class="white_card_body">
			
			<form action="add_research_view.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="member_id" value="<?php echo $resInfo['member_id']; ?>">
				<input type="hidden" name="selected_group_id" value="<?php echo $resSel['selected_group_id']; ?>">
				<?php include 'controller/save_data.php'; ?>
				<div class="row">
					<div class="mb-3 col-md-12">
						<label class="form-label" for="exampleInputEmail1">Research Title</label>
						<input type="text" name="research_title" class="form-control" aria-describedby="emailHelp" placeholder="Type Here...">
					</div>
					<!-- <div class="mb-3 col-md-6">
						<label class="form-label" for="exampleInputEmail1">Research Documentation File</label>
						<input type="file" name="research_file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Insert File">
					</div> -->
				</div>
				<div class="mb-3">
					<label class="form-label" for="exampleInputPassword1">Description</label>
					<textarea id="Article_editor" name="research_description"></textarea>
				</div>
				<input type="submit" name="btnSaveResearch" class="btn btn-primary col-md-12" value="Submit">
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	CKEDITOR.replace('Article_editor');
</script>
<?php include 'footer.php'; ?>