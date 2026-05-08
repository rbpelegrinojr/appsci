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
    header('location: login/login_view.php');
}
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


$resInfo = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM admin_tbl WHERE admin_id = '$uid'"));

if ($username != $resInfo['username'] || empty($resInfo['username'])) {
	$username = null;
    $username = '';
    session_destroy();
    header('location: login/login_view.php');
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>App Sci</title>
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

<link rel="stylesheet" href="css/style1.css" />
<link rel="stylesheet" href="https://demo.dashboardpack.com/user-management-html/css/colors/default.css" id="colorSkinCSS">

<!-- <script src="https://demo.dashboardpack.com/user-management-html/js/jquery1-3.4.1.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="crm_body_bg">

<!-- <style type="text/css">
	sidebar #sidebar_menu>li a.active {
    color: #f65365;
    background: #f8fafc;
    border-radius: 15px;
}
</style> -->

<nav class="sidebar dark_sidebar">
	<div class="logo d-flex justify-content-between">
		<!-- <a class="large_logo" href="index.php"><img src="https://demo.dashboardpack.com/user-management-html/img/logo_white.png" alt=""></a>
		<a class="small_logo" href="index.php"><img src="https://demo.dashboardpack.com/user-management-html/img/mini_logo.png" alt=""></a> -->
		<div class="sidebar_close_icon d-lg-none">
			<i class="ti-close"></i>
		</div>
	</div>
	<ul id="sidebar_menu">
		<li class="">
			<a href="index.php" aria-expanded="false">
				<div class="nav_icon_small">
					<span class=""></span>
					<img src="https://demo.dashboardpack.com/user-management-html/img/menu-icon/16.svg" alt="">
				</div>
				<div class="nav_title">
					<span>Dashboard</span>
				</div>
			</a>
		</li>
		<li class="">
			<a href="module_list.php" aria-expanded="false">
				<div class="nav_icon_small">
					<span class=""></span>
					<img src="https://demo.dashboardpack.com/user-management-html/img/menu-icon/20.svg" alt="">
				</div>
				<div class="nav_title">
					<span>Modules</span>
				</div>
			</a>
		</li>
		<li class="">
			<a href="users_view.php" aria-expanded="false">
				<div class="nav_icon_small">
					<span class=""></span>
					<img src="https://demo.dashboardpack.com/user-management-html/img/menu-icon/5.svg" alt="">
				</div>
				<div class="nav_title">
					<span>Users</span>
				</div>
			</a>
		</li>
		<li class="">
			<a href="archived_users_view.php" aria-expanded="false">
				<div class="nav_icon_small">
					<span class=""></span>
					<img src="https://demo.dashboardpack.com/user-management-html/img/menu-icon/5.svg" alt="">
				</div>
				<div class="nav_title">
					<span>Archived Students</span>
				</div>
			</a>
		</li>
		<!-- <li class="">
			<a class="has-arrow" href="#" aria-expanded="false">
				<div class="nav_icon_small">
					<span class="fa fa-users"></span>
				</div>
				<div class="nav_title">
					<span>Members </span>
				</div>
			</a>
			<ul>
				<li><a href="teachers_view.php">Teachers</a></li>
				<li><a href="students_view.php">Students</a></li>
			</ul>
		</li> -->
		
		<!-- <li class="">
			<a href="index.php" aria-expanded="false">
				<div class="nav_icon_small">
					<span class="fa fa-book"></span>
					
				</div>
				<div class="nav_title">
					<span>Reports</span>
				</div>
			</a>
		</li>
		<li class="">
			<a href="index.php" aria-expanded="false">
				<div class="nav_icon_small">
					<span class="fa fa-cog"></span>
					
				</div>
				<div class="nav_title">
					<span>System Settings</span>
				</div>
			</a>
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
						<h3>App Sci</h3>
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
									<p>Administrator</p>
									<h5>Administrator</h5>
								</div>
								<div class="profile_info_details">
									<!-- <a href="my_profile_view.php">My Profile </a>
									<a href="select_groups_view.php">Select Groups</a> -->
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

	<!-- <div class="main_content_iner overly_inner ">
		<div class="container-fluid p-0 ">
			<div class="row">

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

			<div class="row "> --> <!-- Header -->