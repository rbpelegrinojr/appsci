<?php include 'header.php'; ?>
<?php $resRChapter = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_chapters_tbl WHERE research_chapter_id = '{$_REQUEST['r_c_id']}'"));
$resResearch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_tbl WHERE research_id = '{$resRChapter['research_id']}'"));
?>
<?php $resSel = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE group_id = '{$resInfo['group_id']}' AND member_id = '{$resInfo['member_id']}'")); ?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<div class="col-lg-12">
	<div class="white_card card_height_100 mb_30">
		<div class="white_card_header">
			<div class="box_header m-0">
				<div class="main-title">
					<h3 class="m-0">Edit Chpater for <?php echo $resResearch['research_title']; ?></h3>
				</div>
			</div>
		</div>
		<div class="white_card_body">
			
			<form action="edit_chapter_view.php?r_c_id=<?php echo $resRChapter['research_chapter_id']; ?>" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="research_chapter_id" value="<?php echo $resRChapter['research_chapter_id']; ?>">
				<?php include 'controller/save_data.php'; ?>
				<div class="row">
					<div class="mb-3 col-md-4">
						<label class="form-label" for="exampleInputEmail1">Chapter Title</label>
						<input type="text" name="chapter_title" class="form-control" aria-describedby="emailHelp" placeholder="Type Here..." required="" value="<?php echo $resRChapter['chapter_title']; ?>">
					</div>
					<div class="mb-3 col-md-4">
						<label class="form-label" for="exampleInputEmail1">Chapter</label>
						<select class="form-control" name="chapter_no" required="">
							<option value="<?php echo $resRChapter['chapter_no']; ?>">Chapter <?php echo $resRChapter['chapter_no']; ?></option>
							<option value="1">Chapter 1</option>
							<option value="2">Chapter 2</option>
							<option value="3">Chapter 3</option>
							<option value="4">Chapter 4</option>
							<option value="5">Chapter 5</option>
							<option value="6">Chapter 6</option>
							<option value="N/A">N/A</option>
						</select>
					</div>
					<div class="mb-3 col-md-4">
						<label class="form-label" for="exampleInputEmail1">Chapter Documentation File</label>
						<input type="file" name="chapter_file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Insert File">
					</div>
				</div>
				<div class="mb-3">
					<label class="form-label" for="exampleInputPassword1"><b>Abstract</b></label>
					<textarea id="Abstract_editor" name="chapter_abstract"><?php echo $resRChapter['chapter_abstract']; ?></textarea>
				</div>
				<input type="submit" name="btnEditChapter" class="btn btn-primary col-md-12" value="SAVE">
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	CKEDITOR.replace('Article_editor');
	CKEDITOR.replace('Abstract_editor');
</script>
<?php include 'footer.php'; ?>