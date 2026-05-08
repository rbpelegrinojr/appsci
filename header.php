<?php
include 'include/db.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$member_id = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : null;
$resUsers = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE member_id = '$member_id'"));

if ($member_id === null) {
    //echo "Member ID is not set.";
}else{
    // $resRankCheck = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM rankings WHERE user_id = '$member_id'"));

    // if (empty($resRankCheck['user_id'])) {
    //     header('location: assessment_form_view.php');
    // }else{
    //     echo "Good";
    // }
}
// $resRankCheck = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM rankings WHERE user_id = '$member_id'"));

    // if (empty($resRankCheck['user_id'])) {
    //     header('location: assessment_form_view.php');
    // }else{
    //     echo "Good";
    // }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AppSci</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css">
        .back-button {
    position: fixed;
    bottom: 50px; /* Position above the back-to-top button */
    left: 100px;
    z-index: 999;
    border-radius: 50%;
    color: #fff; /* Bootstrap secondary color */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.back-button:hover {
    background-color: #6c757d;
    color: #fff;
}

.for-button {
    position: fixed;
    bottom: 50px; /* Position above the back-to-top button */
    right: 100px;
    z-index: 999;
    border-radius: 50%;
    color: #fff; /* Bootstrap secondary color */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.for-button:hover {
    background-color: #6c757d;
    color: #fff;
}

    </style>
</head>

<body>
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
            <!-- <h1 class="m-0 text-primary">AppSci</h1> -->
            <span class="navbar-brand-text text-primary fw-bold fs-5 text-center text-lg-start">AppSci</span>
            <!-- <h1 class="m-0 text-primary fs-4 text-wrap text-center text-lg-start">AppSci</h1> -->
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="quarter_view.php" class="nav-item nav-link">Modules</a>
                <a href="profile_view.php" class="nav-item nav-link">Profile</a>
                <?php if (isset($_SESSION['member_id'])): ?>
                    <!-- If user is logged in, show Logout -->
                    <a href="logout.php" class="nav-item nav-link">
                        Logout <i class="fa fa-sign-out ms-3"></i>
                    </a>
                <?php else: ?>
                    <!-- If user is NOT logged in, show Login -->
                    <a href="login_view.php" class="nav-item nav-link">
                        Login <i class="fa fa-arrow-right ms-3"></i>
                    </a>
                <?php endif; ?>
            </div>

            <?php if (isset($_SESSION['member_id'])): ?>
                <!-- If user is logged in, show Logout -->
                <!-- <a href="logout.php" class="btn btn-danger rounded-0 py-4 px-lg-5 d-none d-lg-block">
                    Logout <i class="fa fa-sign-out ms-3"></i>
                </a> -->
            <?php else: ?>
                <!-- If user is NOT logged in, show Login -->
                <!-- <a href="login_view.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
                    Login <i class="fa fa-arrow-right ms-3"></i>
                </a> -->
            <?php endif; ?>
        </div>
    </nav>