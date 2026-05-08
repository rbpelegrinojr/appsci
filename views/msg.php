<?php
include '../include/db.php';
session_start();
$g_id = $_SESSION['g_id'];
$s_id = $_SESSION['s_id'];
$uid = $_SESSION['uid'];
$qMsg = mysqli_query($con, "SELECT * FROM messages_tbl WHERE selected_group_id = '$s_id' AND group_id = '$g_id' ORDER BY message_id DESC");

if ($rows = mysqli_num_rows($qMsg) > 0) {
	while ($rMsg = mysqli_fetch_assoc($qMsg)) {
	$memRes = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE member_id = '{$rMsg['member_id']}'"));

	if ($rMsg['member_id'] != $uid) {
		?>
		<div class="single_message_chat">
			<div class="message_pre_left">
				<div class="message_preview_thumb">
					<img src="img/empty.jpg" alt="">
				</div>
				<div class="messges_info">
					<h4><?php echo $memRes['fname'].' '.$memRes['lname']; ?></h4>
					<p><?php echo $rMsg['date_sent'].' '.$rMsg['time_sent']; ?></p>
				</div>
			</div>
			<div class="message_content_view red_border">
				<p style="color: black;"><?php echo $rMsg['message_content']; ?></p>
			</div>
		</div>
		<?php
	}elseif ($rMsg['member_id'] == $uid) {
		?>

		<div class="single_message_chat sender_message">
			<div class="message_pre_left">
				<div class="messges_info">
					<h4><?php echo $memRes['fname'].' '.$memRes['lname']; ?></h4>
					<p><?php echo $rMsg['date_sent'].' '.$rMsg['time_sent']; ?></p>
				</div>
				<div class="message_preview_thumb">
					<img src="img/empty.jpg" alt="">
				</div>
			</div>
			<div class="message_content_view">
				<p style="color: white;"><?php echo $rMsg['message_content']; ?></p>
			</div>
		</div>

		<?php
	}

}

}else{
	?>
	<div class="alert alert-warning">
		<label>No Messages Available</label>
	</div>
	<?php
}


?>