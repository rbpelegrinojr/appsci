<?php include 'header.php'; ?>
<style type="text/css">
	.messages_box_area .messages_chat .single_message_chat .message_content_view.red_border{
		background: #f5f6ff;
		border: none;
	}
	.messages_box_area .messages_chat .single_message_chat .message_content_view{
		background: #884ffb;
	}
</style>
<div class="row">

	<div class="col-12">
		<div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
			<div class="page_title_left d-flex align-items-center">
				<h3 class="f_s_25 f_w_700 dark_text mr_30">Group Chats</h3>
				<ol class="breadcrumb page_bradcam mb-0">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">Group Chats</li>
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
	<div class="messages_box_area">
		<div class="messages_list">
			<div class="white_box ">
				<div class="white_box_tittle list_header">
					<h4>Group Members</h4>
				</div>

				<ul>
					<?php
					$qMem = mysqli_query($con, "SELECT * FROM members_tbl WHERE group_id = '{$rS['group_id']}' AND account_status != '0'");
					while ($rMem = mysqli_fetch_assoc($qMem)) {
						?>
						<li>
							<a >
								<div class="message_pre_left">
									<div class="message_preview_thumb">
										<img src="img/empty.jpg" alt="">
										<!-- <span class="round-10 bg-danger"></span> -->
									</div>
									<div class="messges_info">
										<h4><?php echo $rMem['fname'].' '.$rMem['lname']; ?></h4>
									</div>
								</div>
								<!-- <div class="messge_time">
									<span class="badge rounded-pill bg-success">Active</span>
								</div> -->
							</a>
						</li>
						<?php
					}
					?>

				</ul>
			</div>
		</div>
		<div class="messages_chat mb_30" >
			<div class="white_box ">
				<div class="message_send_field">
					<input type="hidden" id="section_id" value="<?php echo $resInfo['section_id']; ?>">
					<input type="hidden" id="course_id" value="<?php echo $resInfo['course_id']; ?>">
					<input type="hidden" id="batch_year" value="2022">
					<input type="hidden" id="group_id" value="<?php echo $resInfo['group_id']; ?>">
					<input type="hidden" id="member_id" value="<?php echo $resInfo['member_id']; ?>">
					<input type="hidden" id="selected_group_id" value="<?php echo $rS['selected_group_id']; ?>">
					<input type="text" placeholder="Write your message" value="" id="message_content">
					<button class="btn_1" type="submit" id="btnSend">Send</button>
				</div>
				<br>
				<div class="messages_contents" style="overflow-y: scroll;
                height: 700px;">
					
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#btnSend').click(function () {
			var section_id = $('#section_id').val();
			var course_id = $('#course_id').val();
			var batch_year = $('#batch_year').val();
			var group_id = $('#group_id').val();
			var member_id = $('#member_id').val();
			var selected_group_id = $('#selected_group_id').val();
			var message_content = $('#message_content').val();

			$.ajax({
				url:'controller/message_data.php',
				method:'POST',
				data:{
					btnSend:1,
					section_id:section_id,
					course_id:course_id,
					batch_year:batch_year,
					group_id:group_id,
					member_id:member_id,
					selected_group_id:selected_group_id,
					message_content:message_content
				},
				success:function (echoData) {
					if (echoData == 'sent') {
						window.location.href='group_chat_view.php';
					}else{
						alert(echoData);
					}
				}
			});
		});
	});
	function content_load(){
		$(function(){
			$.get("msg.php",function(data){
				$(".messages_contents").html(data);
			});
		});
	}
	setInterval(function(){ content_load() },1000);
</script>
<?php include 'footer.php'; ?>