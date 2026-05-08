<?php
include '../../include/db.php';
if (isset($_POST['btnSend'])) {

	$section_id = mysqli_escape_string($con, $_POST['section_id']);
	$course_id = mysqli_escape_string($con, $_POST['course_id']);
	$batch_year = mysqli_escape_string($con, $_POST['batch_year']);
	$group_id = mysqli_escape_string($con, $_POST['group_id']);
	$member_id = mysqli_escape_string($con, $_POST['member_id']);
	$selected_group_id = mysqli_escape_string($con, $_POST['selected_group_id']);
	$message_content = mysqli_escape_string($con, $_POST['message_content']);
	$date_now = date('Y-m-d');
	$time_sent = date('H:i a');

	if ($message_content != '') {
		$query = mysqli_query($con, "INSERT INTO messages_tbl (group_id, member_id, selected_group_id, message_content, date_sent, time_sent) VALUES ('$group_id', '$member_id', '$selected_group_id', '$message_content', '$date_now', '$time_sent')");

		if ($query) {
			echo "sent";
		}
	}else{
		echo "Please type message.";
	}
}
?>