<?php
include '../../include/db.php';
if (isset($_REQUEST['btnApproveChap'])) {
	
	$query = mysqli_query($con, "UPDATE research_chapters_tbl SET chapter_status = '1' WHERE research_chapter_id = '{$_REQUEST['c_id']}'");

	if ($query) {
		header('location: ../our_research_view.php');
	}

}elseif (isset($_REQUEST['btnDispproveChap'])) {
	$query = mysqli_query($con, "DELETE FROM research_chapters_tbl WHERE research_chapter_id = '{$_REQUEST['c_id']}'");

	if ($query) {
		header('location: ../our_research_view.php');
	}
}
?>