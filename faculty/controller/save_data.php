<?php
include '../../include/db.php';
if (isset($_REQUEST['btnSelectGroup'])) {
	
	$query = mysqli_query($con, "UPDATE selected_group_tbl SET teacher_id = '{$_REQUEST['t_id']}' WHERE selected_group_id = '{$_REQUEST['s_id']}'");

	if ($query) {
		header('location: ../select_groups_view.php');
	}

}elseif (isset($_REQUEST['btnAddAnnouncement'])) {
	$teacher_id = mysqli_escape_string($con, $_REQUEST['teacher_id']);
	$announcement_title = mysqli_escape_string($con, $_REQUEST['announcement_title']);
	$announcement_content = mysqli_escape_string($con, $_REQUEST['announcement_content']);
	$selected_group_id = mysqli_escape_string($con, $_REQUEST['selected_group_id']);
	$announcement_date_created = date('Y-m-d');
	$announcement_time_created = date('H:i A');

	$query = mysqli_query($con, "INSERT INTO announcements_tbl (teacher_id, selected_group_id, announcement_title, announcement_content, announcement_date_created, announcement_time_created, announement_status) VALUES ('$teacher_id', '$selected_group_id', '$announcement_title', '$announcement_content', '$announcement_date_created', '$announcement_time_created', '1')");

	if ($query) {
		header('location: ../index.php');
	}else{
		?>
		<script type="text/javascript">
			alert(<?php echo mysqli_error($query); ?>);
			window.location.href='../index.php';
		</script>
		<?php
	}

}elseif (isset($_REQUEST['btnAddComment'])) {
	$comment = mysqli_escape_string($con, $_REQUEST['comment']);
	$teacher_id = mysqli_escape_string($con, $_REQUEST['teacher_id']);
	$research_id = mysqli_escape_string($con, $_REQUEST['research_id']);
	$date_now = date('Y-m-d');
	$time_now = date('H:i a');

	$query = mysqli_query($con, "INSERT INTO research_comments_tbl (teacher_id, research_id, comment, date_commented, time_commented) VALUES ('$teacher_id', '$research_id', '$comment', '$date_now', '$time_now')");

	if ($query) {
		header('location: ../group_research.php?s_id='.$_REQUEST['s_id']);
	}

}
?>