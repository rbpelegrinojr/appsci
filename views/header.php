<?php
session_start();
include '../include/db.php';
$username = $_SESSION['username'];
$uid = $_SESSION['uid'];

if (empty($username)) {
	header('location: login_view.php');
}
if (isset($_REQUEST['btnLogout'])) {
    $username = null;
    $username = '';
    session_destroy();
    header('location: login_view.php');
}
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


$resInfo = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE member_id = '$uid'"));
$rS = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE group_id = '{$resInfo['group_id']}' AND member_id = '{$resInfo['member_id']}'"));
$_SESSION['s_id'] = $rS['selected_group_id'];
$_SESSION['g_id'] = $resInfo['group_id'];
if ($username != $resInfo['username'] || empty($resInfo['username'])) {
	$username = null;
    $username = '';
    session_destroy();
    header('location: login_view.php');
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Archiving Management System</title>
<link rel="stylesheet" type="text/css" href="css/themify-icons/themify-icons.css">
<link rel="icon" href="https://demo.dashboardpack.com/user-management-html/img/mini_logo.png" type="image/png">

<link rel="stylesheet" href="css/bootstrap1.min.css" />

<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/vendors/themefy_icon/themify-icons.css" />

<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/vendors/niceselect/css/nice-select.css" />

<link rel="stylesheet" href="css/gijgo.min.css" />

<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/vendors/font_awesome/css/all.min.css" />
<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/vendors/tagsinput/tagsinput.css" />

<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/vendors/vectormap-home/vectormap-2.0.2.css" />

<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/vendors/scroll/scrollable.css" />

<!-- <link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/vendors/datatable/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/vendors/datatable/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/vendors/datatable/css/buttons.dataTables.min.css" /> -->


<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/vendors/material_icon/material-icons.css" />

<link rel="stylesheet" href="css/metisMenu.css">

<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/css/style1.css" />
<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/css/colors/default.css" id="colorSkinCSS">

<script src="https://demo.dashboardpack.com/user-management-html/js/jquery1-3.4.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="crm_body_bg" onload="content_load();">

<!-- <style type="text/css">
	sidebar #sidebar_menu>li a.active {
    color: #f65365;
    background: #f8fafc;
    border-radius: 15px;
}
</style> -->

<nav class="sidebar dark_sidebar">
	<div class="logo d-flex justify-content-between">
		<a class="large_logo" href="index.php"><img src="../images/logo_archive.png" alt=""></a>
		<a class="small_logo" href="index.php"><img src="https://demo.dashboardpack.com/user-management-html/img/mini_logo.png" alt=""></a>
		<div class="sidebar_close_icon d-lg-none">
			<i class="ti-close"></i>
		</div>
	</div>
	<ul id="sidebar_menu">
		

		<?php
		if ($resInfo['group_role'] == '1') {
			?>
			<li class="">
				<a class="" href="#" aria-expanded="false">
					<div class="nav_icon_small">
						<span class=""></span>
					</div>
					<div class="nav_title">
						<span>Our Research </span>
					</div>
				</a>
				<ul>
					<li><a href="our_research_view.php">View</a></li>
					<?php
					if ($rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM research_tbl WHERE selected_group_id = '{$rS['selected_group_id']}' AND research_status != '4'")) > 0) {
						# code...
					}else{
						?>
						<li><a href="add_research_view.php">Add</a></li>
						<?php
					}
					?>
					<!-- <li><a href="index_3.html">Edit History</a></li> -->
				</ul>
			</li>
			<?php
		}else{
			?>
			<li class="">
				<a href="our_research_view.php" aria-expanded="false">
					<div class="nav_icon_small">
						<span class=""></span>
					</div>
					<div class="nav_title">
						<span>Our Research</span>
					</div>
				</a>
			</li>
			<?php
		}
		?>
		<li class="">
			<a href="members_view.php" aria-expanded="false">
				<div class="nav_icon_small">
					<span class=""></span>
				</div>
				<div class="nav_title">
					<span>My Members</span>
				</div>
			</a>
		</li>

		<!-- <li class="">
		<a class="has-arrow" href="#" aria-expanded="false">
		<div class="nav_icon_small">
		<img src="https://demo.dashboardpack.com/user-management-html/img/menu-icon/dashboard.svg" alt="">
		</div>
		<div class="nav_title">
		<span>User Management </span>
		</div>
		</a>
		<ul>
		<li><a href="index_2.html">Default</a></li>
		<li><a href="index_3.html">Dark Sidebar</a></li>
		<li><a href="index.php">Light Sidebar</a></li>
		</ul>
		</li> -->

	</ul>

</nav>
<script type="text/javascript">
function logout(l_id) {
window.location.href='index.php?btnLogout='+l_id+'';
}
</script>
<section class="main_content dashboard_part large_header_bg">
	<div class="container-fluid g-0">
		<div class="row">
			<div class="col-lg-12 p-0 ">
				<div class="header_iner d-flex justify-content-between align-items-center"><!--<div class="header_iner d-flex justify-content-between align-items-center" style="background-color: red;">-->
					<div class="sidebar_icon d-lg-none">
						<i class="ti-menu"></i>
					</div>
					<div class="line_icon open_miniSide d-none d-lg-block">
						<img src="https://demo.dashboardpack.com/user-management-html/img/line_img.png" alt="">
					</div>
					<div class="d-flex align-items-center">
						<h3>E-Archive System</h3>
					</div>
					<!-- <div class="serach_field-area d-flex align-items-center">
						<div class="search_inner">
							<h3>Title</h3>
						</div>
					</div> -->
					<div class="header_right d-flex justify-content-between align-items-center">
						<div class="header_notification_warp d-flex align-items-center">
							<li>
								<!-- <a class="bell_notification_clicker" href="#"> <img src="img/bell.png" alt="">
									<span>10</span>
								</a> -->
								<div class="Menu_NOtification_Wrap">
									<div class="notification_Header">
										<h4>Notifications</h4>
									</div>
									<div class="Notification_body">
										<div class="single_notify d-flex align-items-center">
											<div class="notify_thumb">
												<a href="#"><img src="https://demo.dashboardpack.com/user-management-html/img/staf/2.png" alt=""></a>
											</div>
											<div class="notify_content">
												<a href="#"><h5>Cool Marketing </h5></a>
												<p>Lorem ipsum dolor sit amet</p>
											</div>
										</div>
										<div class="single_notify d-flex align-items-center">
											<div class="notify_thumb">
												<a href="#"><img src="https://demo.dashboardpack.com/user-management-html/img/staf/4.png" alt=""></a>
											</div>
											<div class="notify_content">
												<a href="#"><h5>Awesome packages</h5></a>
												<p>Lorem ipsum dolor sit amet</p>
											</div>
										</div>
										<div class="single_notify d-flex align-items-center">
											<div class="notify_thumb">
												<a href="#"><img src="https://demo.dashboardpack.com/user-management-html/img/staf/3.png" alt=""></a>
											</div>
											<div class="notify_content">
												<a href="#"><h5>what a packages</h5></a>
												<p>Lorem ipsum dolor sit amet</p>
											</div>
										</div>
									</div>

									<!-- <div class="nofity_footer">
									<div class="submit_button text-center pt_20">
									<a href="#" class="btn_1">See More</a>
									</div>
									</div> -->
								</div>
							</li>
							<!-- <li>
								<a class="CHATBOX_open" href="#"> <img src="https://demo.dashboardpack.com/user-management-html/img/staf/3.png" alt=""> <span>2</span> </a>
							</li> -->
						</div>
						<div class="profile_info">
							<img src="<?php echo $resInfo['profile_image']; ?>" alt="#">
							<div class="profile_info_iner">
								<div class="profile_author_name">
									<p>
										<?php
										if ($resInfo['group_role'] == '1') {
											echo "Group Leader";
										}else{
											echo "Group Member";
										}
										?>
									 </p>
									<h5><?php echo $resInfo['fname'].' '.$resInfo['lname']; ?></h5>
								</div>
								<div class="profile_info_details">
									<a href="profile_view.php">My Profile </a>
									<!-- <a href="#">Settings</a> -->
									<a href="#" onclick="logout(1);">Log Out </a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main_content_iner overly_inner ">
		<div class="container-fluid p-0 ">
			<!-- <div class="row">

				<div class="col-12">
					<div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
						<div class="page_title_left d-flex align-items-center">
							<h3 class="f_s_25 f_w_700 dark_text mr_30">Dashboard</h3>
							<ol class="breadcrumb page_bradcam mb-0">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
								<li class="breadcrumb-item active">Analytic</li>
							</ol>
						</div>
						<div class="page_title_right">
							<div class="page_date_button d-flex align-items-center">
								<img src="img/icon/calender_icon.svg" alt="">
								<?php //echo date('F j, Y', strtotime(date('Y-m-d'))); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row "> -->