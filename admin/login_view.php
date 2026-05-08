<?php
session_start();
if (!empty($_SESSION['username'])) {
  header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>CapSU - Online Job Hiring System</title>


<!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="#">
<meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
<meta name="author" content="#">

<link rel="icon" href="https://demo.dashboardpack.com/adminty-html/files/assets/images/favicon.ico" type="image/x-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://demo.dashboardpack.com/adminty-html/files/bower_components/bootstrap/dist/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="https://demo.dashboardpack.com/adminty-html/files/assets/icon/themify-icons/themify-icons.css">

<link rel="stylesheet" type="text/css" href="https://demo.dashboardpack.com/adminty-html/files/assets/icon/icofont/css/icofont.css">

<link rel="stylesheet" type="text/css" href="css/login/style.css">
</head>
<body class="fix-menu">

  <section class="login-block">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <form class="md-float-material form-material" action="login_view.php" method="POST">
            <div class="text-center">
              <!-- <img src="../images/logo_archive.png" style="width: 400px; height: 100px;" alt="logo.png"> -->
            </div>
            <div class="auth-box card">
              <div class="card-block">
                <div class="row m-b-20">
                  <div class="col-md-12">
                    <h3 class="text-center">Administrator Login</h3>
                  </div>
                </div>
                <?php include '../controller/login.php'; ?>
                <div class="form-group form-primary">
                  <input type="text" name="username" class="form-control" placeholder="Username">
                  <span class="form-bar"></span>
                </div>
                <div class="form-group form-primary">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <span class="form-bar"></span>
                </div>
                <div class="row m-t-25 text-left">
                  <div class="col-12">
                    <div class="checkbox-fade fade-in-primary d-">
                    </div>
                    <div class="forgot-phone text-right f-right">
                      <!-- <a href="forgot_pass.php" class="text-right f-w-600"> Forgot Password?</a> -->
                    </div>
                  </div>
                </div>
                <div class="row m-t-30">
                  <div class="col-md-12">
                    <input type="submit" value="Sign in" name="btnAdminLogin" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">
                  </div>
                </div>
                <hr />
                <div class="row">
                  <div class="col-md-2">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/popper.js/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/popper.js/dist/umd/popper.min.js"></script>

  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>

  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/modernizr/modernizr.js"></script>
  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/modernizr/modernizr.js"></script>

  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/i18next/i18next.min.js"></script>
  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/assets/js/common-pages.js"></script>
</body>
</html>