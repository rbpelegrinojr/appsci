<?php
include '../include/db.php';
if (isset($_REQUEST['btnSaveResearch'])) {

	$member_id = $_REQUEST['member_id'];
	//$group_id = $_REQUEST['group_id'];
	$selected_group_id = $_REQUEST['selected_group_id'];
	
	$research_title = mysqli_escape_string($con, $_REQUEST['research_title']);
	//$research_file = mysqli_escape_string($con, $_FILES['research_file']['name']);
	$research_description = mysqli_escape_string($con, $_REQUEST['research_description']);
	// $tmpName = $_FILES['research_file']['tmp_name'];
	// move_uploaded_file($tmpName, '../research_files_dir/'.$research_file);
	// $url = "";

	$research_date_created = date('Y-m-d');

	// if (empty($research_file)) {
	// 	$url = "";
	// }else{
	// 	$url = "http://localhost/archive_system/research_files_dir/".$research_file;
	// }
	//$resSelectGroup = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE selected_group_id = '$selected_group_id'"));
	$query = mysqli_query($con, "INSERT INTO research_tbl (member_id, selected_group_id, research_title, research_description, research_created, research_status) VALUES ('$member_id', '$selected_group_id', '$research_title', '$research_description', '$research_date_created', '1')");

	if ($query) {
		?>
		<script type="text/javascript">
			alert('Research Added');
			window.location.href='our_research_view.php';
		</script>
		<?php
	}else{
		?>
		<div class="alert alert-warning background-warning">
			<strong>Something went wrong!</strong>
		</div>
		<?php
	}

}elseif (isset($_REQUEST['btnEditResearch'])) {
	$research_id = $_REQUEST['research_id'];
	$research_title = mysqli_escape_string($con, $_REQUEST['research_title']);

	$research_description = mysqli_escape_string($con, $_REQUEST['research_description']);

	$query = mysqli_query($con, "UPDATE research_tbl SET research_title = '$research_title', research_description = '$research_description' WHERE research_id = '$research_id'");

	if ($query) {

		?>
		<script type="text/javascript">
			alert('Research Edited');
			window.location.href='our_research_view.php';
		</script>
		<?php

	}else{
		?>
		<div class="alert alert-warning background-warning">
			<strong>Something went wrong!</strong>
		</div>
		<?php
	}
}elseif (isset($_REQUEST['btnEditOngoingResearch'])) {
	$research_id = mysqli_escape_string($con, $_REQUEST['research_id']);
	$research_title = mysqli_escape_string($con, $_REQUEST['research_title']);
	$research_file = mysqli_escape_string($con, $_FILES['research_file']['name']);
	$research_description = mysqli_escape_string($con, $_REQUEST['research_description']);
	$research_abstract = mysqli_escape_string($con, $_REQUEST['research_abstract']);

	$tmpName = $_FILES['research_file']['tmp_name'];
	move_uploaded_file($tmpName, '../research_files_dir/'.$research_file);
	$url = "";

	if (empty($research_file)) {
		$url = "";
	}else{
		$url = "http://localhost/archive_system/research_files_dir/".$research_file;
	}

	$query = mysqli_query($con, "UPDATE research_tbl SET research_title = '$research_title', research_description = '$research_description', research_abstract = '$research_abstract', research_file = '$url' WHERE research_id = '$research_id' ");

	if ($query) {

		?>
		<script type="text/javascript">
			alert('Research Edited');
			window.location.href='our_research_view.php';
		</script>
		<?php

	}else{
		?>
		<div class="alert alert-warning background-warning">
			<strong>Something went wrong!</strong>
		</div>
		<?php
	}

}elseif (isset($_REQUEST['btnAddChapter'])) {
	$research_id = mysqli_escape_string($con, $_REQUEST['research_id']);
	$chapter_title = mysqli_escape_string($con, $_REQUEST['chapter_title']);
	$chapter_no = mysqli_escape_string($con, $_REQUEST['chapter_no']);
	$chapter_file = mysqli_escape_string($con, $_FILES['chapter_file']['name']);
	$member_id = mysqli_escape_string($con, $_REQUEST['member_id']);
	$chapter_abstract = mysqli_escape_string($con, $_REQUEST['chapter_abstract']);

	$date_now = date('Y-m-d');

	$tmpName = $_FILES['chapter_file']['tmp_name'];
	move_uploaded_file($tmpName, '../research_files_dir/'.$chapter_file);
	$url = "";

	if (empty($chapter_file)) {
		$url = "";
	}else{
		$url = "http://localhost/archive_system/research_files_dir/".$chapter_file;
	}

	$resEx = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_chapters_tbl WHERE research_id = '$research_id' AND chapter_title = '$chapter_title'"));

	if ($resEx['research_id'] != $research_id && $resEx['chapter_title'] != $chapter_title) {
		$query = mysqli_query($con, "INSERT INTO research_chapters_tbl (research_id, chapter_no, chapter_title, chapter_abstract, chapter_file, chapter_created) VALUES ('$research_id', '$chapter_no', '$chapter_title', '$chapter_abstract', '$url', '$date_now')");

		if ($query) {
			$resAutho = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_chapter_authors_tbl WHERE member_id = '$member_id'"));

			//if ($resAutho['member_id'] != $member_id) {

				$rRes = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_chapters_tbl WHERE research_id = '$research_id' AND chapter_no = '$chapter_no' AND chapter_title = '$chapter_title'"));
				
				$qA = mysqli_query($con, "INSERT INTO research_chapter_authors_tbl (research_id, research_chapter_id, member_id) VALUES ('$research_id', '{$rRes['research_chapter_id']}', '$member_id')");

				if ($qA) {
					?>
					<script type="text/javascript">
						alert('Chapter <?php echo $chapter_no ?> Added');
						window.location.href='our_research_view.php';
					</script>
					<?php
				}

			// }else{
			// 	?>
			 	<script type="text/javascript">
			// 		alert('Chapter <?php echo $chapter_no ?> Added');
			// 		window.location.href='our_research_view.php';
			// 	</script>
			 	<?php
			// }
		}
	}else{
		?>
	 	<script type="text/javascript">
	 		alert('Chapter Title Already Exist');
	 		window.location.href='our_research_view.php';
	 	</script>
	 	<?php
	}

}elseif (isset($_REQUEST['btnEditChapter'])) {
	$research_chapter_id = mysqli_escape_string($con, $_REQUEST['research_chapter_id']);
	$chapter_title = mysqli_escape_string($con, $_REQUEST['chapter_title']);
	$chapter_no = mysqli_escape_string($con, $_REQUEST['chapter_no']);
	$chapter_file = $_FILES['chapter_file']['name'];
	$chapter_abstract = mysqli_escape_string($con, $_REQUEST['chapter_abstract']);

	$tmpName = $_FILES['chapter_file']['tmp_name'];
	move_uploaded_file($tmpName, '../research_files_dir/'.$chapter_file);
	$url = "";

	$resChap = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_chapters_tbl WHERE research_chapter_id = '$research_chapter_id'"));

	if (empty($chapter_file)) {
		$url = $resChap['chapter_file'];
	}else{
		$url = "http://localhost/archive_system/research_files_dir/";
	}

	$resEx = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_chapters_tbl WHERE research_chapter_id = '$research_chapter_id' AND chapter_no = '$chapter_no' AND chapter_title = '$chapter_title' AND research_chapter_id != '$research_chapter_id'"));

	if ($resEx['research_chapter_id'] != $research_chapter_id && $resEx['chapter_title'] != $chapter_title) {
		
		$query = mysqli_query($con, "UPDATE research_chapters_tbl SET chapter_title = '$chapter_title', chapter_no = '$chapter_no', chapter_file = '$url', chapter_abstract = '$chapter_abstract' WHERE research_chapter_id = '$research_chapter_id'");

		if ($query) {
			?>
			<script type="text/javascript">
				alert('Chapter <?php echo $chapter_no; ?> Edited');
				window.location.href='our_research_view.php';
			</script>
			<?php
		}

	}else{
		?>
		<script type="text/javascript">
			alert('Chapter Already Exist');
			window.location.href='our_research_view.php';
		</script>
		<?php
	}

}
?>