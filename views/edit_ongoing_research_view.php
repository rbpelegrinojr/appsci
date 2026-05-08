<?php include 'header.php'; ?>
<?php $resResearch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_tbl WHERE research_id = '{$_REQUEST['r_id']}'")); ?>
<?php $resSel = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE group_id = '{$resInfo['group_id']}' AND member_id = '{$resInfo['member_id']}'")); ?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<div class="col-lg-12">
	<div class="white_card card_height_100 mb_30">
		<div class="white_card_header">
			<div class="box_header m-0">
				<div class="main-title">
					<h3 class="m-0">Edit Research</h3>
				</div>
			</div>
		</div>
		<div class="white_card_body">
			
			<form action="edit_ongoing_research_view.php?r_id=<?php echo $_REQUEST['r_id']; ?>" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="research_id" value="<?php echo $_REQUEST['r_id']; ?>">
				<?php include 'controller/save_data.php'; ?>
				<div class="row">
					<div class="mb-3 col-md-6">
						<label class="form-label" for="exampleInputEmail1">Research Title</label>
						<input type="text" name="research_title" class="form-control" aria-describedby="emailHelp" placeholder="Type Here..." required="" value="<?php echo $resResearch['research_title']; ?>">
					</div>
					<div class="mb-3 col-md-6">
						<label class="form-label" for="exampleInputEmail1">Research Documentation File</label>
						<input type="file" name="research_file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Insert File" required="">
					</div>
				</div>
				<div class="mb-3">
					<label class="form-label" for="exampleInputPassword1"><b>Description</b></label>
					<textarea id="Article_editor" name="research_description"><?php echo $resResearch['research_description']; ?></textarea>
				</div>
				<div class="mb-3">
					<label class="form-label" for="exampleInputPassword1"><b>Abstract</b></label>
					<textarea id="Abstract_editor" name="research_abstract"><?php echo $resResearch['research_abstract']; ?></textarea>
				</div>
				<input type="submit" name="btnEditOngoingResearch" class="btn btn-primary col-md-12" value="SAVE">
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	CKEDITOR.replace('Article_editor');
	CKEDITOR.replace('Abstract_editor');
</script>
<?php include 'footer.php'; ?>