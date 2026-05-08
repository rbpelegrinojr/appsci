<?php include '../include/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo "string"; ?></title>


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

  <script type="text/javascript" src="https://demo.dashboardpack.com/adminty-html/files/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body class="fix-menu">
<style type="text/css">
	.login-block .auth-box{
		max-width: 600px;
	}
</style>
  <section class="login-block">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <form class="md-float-material form-material" action="register_view.php" method="POST">
            <div class="text-center">
              <img src="https://demo.dashboardpack.com/adminty-html/files/assets/images/logo.png" alt="logo.png">
            </div>
            <div class="auth-box card">
              <div class="card-block">
                <div class="row m-b-20">
                  <div class="col-md-12">
                    <h3 class="text-center">Faculty Sign up</h3>
                  </div>
                </div>
                <?php include '../controller/register.php'; ?>
                <div class="form-group form-primary">
                  <span class="form-bar">First Name</span>
                  <input type="text" name="fname" class="form-control" placeholder="Type Here..." value="<?php if(isset($_REQUEST['btnRegStud'])){ echo $_REQUEST['fname']; }else {} ?>">
                </div>
                
                <div class="form-group form-primary">
                  <span class="form-bar">Middle Name</span>
                  <input type="text" name="mname" class="form-control" placeholder="Type Here..." value="<?php if(isset($_REQUEST['btnRegStud'])){ echo $_REQUEST['mname']; }else {} ?>">
                </div>

                <div class="form-group form-primary">
                  <span class="form-bar">Last Name</span>
                  <input type="text" name="lname" class="form-control" placeholder="Type Here..." value="<?php if(isset($_REQUEST['btnRegStud'])){ echo $_REQUEST['lname']; }else {} ?>">
                </div>

                <div class="row form-group form-primary">
                	<div class="col-md-6">
	                  <span class="form-bar">School</span>
	                  <select class="form-control" id="school_id" name="school_id" required="" style="font-size: 13px;">
                      <option value="">-Select School-</option>
                      <?php
                      $qSchool = mysqli_query($con, "SELECT * FROM schools_tbl ORDER BY school_name ASC");
                      while ($rSchool = mysqli_fetch_assoc($qSchool)) {
                        ?>
                        <option value="<?php echo $rSchool['school_id']; ?>" title="<?php echo $rSchool['school_name']; ?>"><?php echo $rSchool['school_abr']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
	                </div>
	                <div class="col-md-6">
	                  <span class="form-bar">Department</span>
	                  <select class="form-control" id="department_id" name="department_id" required="" style="font-size: 13px;">
                      <option value="">-Select Department-</option>
                    </select>
	                </div>
                </div>

                <div class="row form-group form-primary">
                	<div class="col-md-6">
	                  <span class="form-bar">Email</span>
	                  <input type="text" name="email" class="form-control" placeholder="Type Here..." value="<?php if(isset($_REQUEST['btnRegStud'])){ echo $_REQUEST['email']; }else {} ?>">
	                </div>
	                <div class="col-md-6">
                  <span class="form-bar">Contact Number</span>
	                  <input type="text" name="contact_number" class="form-control" placeholder="Type Here..." value="<?php if(isset($_REQUEST['btnRegStud'])){ echo $_REQUEST['contact_number']; }else {} ?>">
	                </div>
                </div>

                <div class="row form-group form-primary">
                	<div class="col-md-6">
	                  <span class="form-bar">Username</span>
	                  <input type="text" name="username" class="form-control" placeholder="Type Here..." value="<?php if(isset($_REQUEST['btnRegStud'])){ echo $_REQUEST['username']; }else {} ?>">
	                </div>
	                <div class="col-md-6">
	                	<span class="form-bar">Password</span>
	                  <input type="password" name="password" class="form-control" placeholder="Type Here...">
	                </div>
                </div>

                <div class="form-group form-primary">
                  <span class="form-bar">Confirm Password</span>
                  <input type="password" name="confirm_password" class="form-control" placeholder="Type Here...">
                </div>
                
                <div class="row m-t-25 text-left">
                  <div class="col-12">
                    <div class="checkbox-fade fade-in-primary d-">
                    </div>
                    <div class="forgot-phone text-right f-right">
                      <a href="login_view.php" class="text-right f-w-600"> Sign In</a>
                    </div>
                  </div>
                </div>
                <div class="row m-t-30">
                  <div class="col-md-12">
                    <input type="submit" value="Register" name="btnRegFac" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">
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
  <script type="text/javascript">
    $(document).ready(function () {
      $('#school_id').change(function () {
        var school_id = $('#school_id').val();
        $.ajax({
          url:'departments.php',
          method:'POST',
          data:{
            school_id:school_id
          },
          success:function (viewDep) {
            $('#department_id').html(viewDep);
          }
        });
      });
    })
  </script>
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