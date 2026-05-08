<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="css/profile_style.css">
<div class="row">

  <div class="col-12">
    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
      <div class="page_title_left d-flex align-items-center">
        <h3 class="f_s_25 f_w_700 dark_text mr_30">My Profile</h3>
        <ol class="breadcrumb page_bradcam mb-0">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">My Profile</li>
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
<style type="text/css">

    /* Large devices (laptops/desktops, 992px and up) */
    @media only screen and (min-width: 992px) {
        .card-settings{
            margin-top: 6%;
        }
    } 
    /* Extra large devices (large laptops and desktops, 1200px and up) */
    @media only screen and (min-width: 1200px) {
      .card-settings{
            margin-top: 6%;
        }
    }
    /* Extra small devices (phones, 600px and down) */
    @media only screen and (max-width: 600px) {
      .card-settings{
            margin-top: 50%;
        }
    }
    
</style>
<style type="text/css">

    /* Large devices (laptops/desktops, 992px and up) */
    @media only screen and (min-width: 992px) {
        .cap-img{
         height: 150px; width:180px;
        }
        .results{
            margin-top: 5.4%; margin-left: 5%;
        }
        .my_camera{
            height: 200px; width: 200px; margin-left: 5%;
        }

        .main-cam-div{
            margin-left: 2%;
        }
    }

    /* Extra large devices (large laptops and desktops, 1200px and up) */
    @media only screen and (min-width: 1200px) {
      .cap-img{
         height: 150px; width:180px;
        }
        .results{
            margin-top: 5.4%; margin-left: 5%;
        }
        .my_camera{
            height: 200px; width: 200px; margin-left: 5%;
        }

        .main-cam-div{
            margin-left: 2%;
        }
    }


    /* Extra small devices (phones, 600px and down) */
    @media only screen and (max-width: 600px) {
      .cap-img{
         height: 150px; width:200px;
        }
        .results{
            margin-top: 5.4%; margin-left: 5%;
        }
        .my_camera{
            height: 200px; width: 200px; margin-left: 5%;
        }
        .main-cam-div{
            margin-left: 13%;
        }
    }

    /* Small devices (portrait tablets and large phones, 600px and up) */
    @media only screen and (min-width: 600px) {
      .cap-img{
         height: 150px; width:200px;
        }
        .results{
            margin-top: 5.4%; margin-left: 5%;
        }
        .my_camera{
            height: 200px; width: 200px; margin-left: 5%;
        }
        .main-cam-div{
            margin-left: 10%;
        }
    }

    @media only screen and (min-width: 1366px) {
      .cap-img{
         height: 150px; width:180px;
        }
        .results{
            margin-top: 5.4%; margin-left: 5%;
        }
        .my_camera{
            height: 200px; width: 200px; margin-left: 5%;
        }
        .main-cam-div{
            margin-left: 2%;
        }
    }

</style>
<div data-growl="container" class="alert alert-warning alert-dismissable growl-animated animated fadeInDown" role="alert" data-growl-position="top-right" style="position: fixed; margin: 0px; z-index: 999999; display: inline-block; top: 30px; right: 30px; display: none;" id="unameEx">
    <span data-growl="message">Username Already Exist</span>
  </div>

  <div data-growl="container" class="alert alert-warning alert-dismissable growl-animated animated fadeInDown" role="alert" data-growl-position="top-right" style="position: fixed; margin: 0px; z-index: 999999; display: inline-block; top: 30px; right: 30px; display: none;" id="numEx">
    <span data-growl="message">Contact Number Already Exist</span>
  </div>

  <div data-growl="container" class="alert alert-warning alert-dismissable growl-animated animated fadeInDown" role="alert" data-growl-position="top-right" style="position: fixed; margin: 0px; z-index: 999999; display: inline-block; top: 30px; right: 30px; display: none;" id="emailEx">
    <!-- <span data-growl="title"> Bootstrap Growl </span> -->
    <span data-growl="message">Email Already Exist</span>
  </div>

  <div data-growl="container" class="alert alert-danger alert-dismissable growl-animated animated fadeInDown" role="alert" data-growl-position="top-right" style="position: fixed; margin: 0px; z-index: 999999; display: inline-block; top: 30px; right: 30px; display: none;" id="fillin">
    <!-- <span data-growl="title"> Bootstrap Growl </span> -->
    <span data-growl="message">Fields Cannot be Empty</span>
  </div>

  <div data-growl="container" class="alert alert-success alert-dismissable growl-animated animated fadeInDown" role="alert" data-growl-position="top-right" style="position: fixed; margin: 0px; z-index: 999999; display: inline-block; top: 30px; right: 30px; display: none;" id="success-save">
    <span data-growl="title"> Data Saved. </span>
    <span data-growl="message"> </span>
  </div>
<div class="main-content card-settings">
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a >
                    <img src="<?php if(empty($resInfo['profile_image'])){ echo '../../profile_images/empty.jpg'; }else{ echo $resInfo['profile_image']; } ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4" data-toggle="modal" data-target="#cameraModal">Change</a>

              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  <?php echo $resInfo['fname'].' '.$resInfo['lname']; ?><span class="font-weight-light"></span>
                </h3>
                <div class="h5 font-weight-300">
                  <!-- <i class="ni location_pin mr-2"></i>Bucharest, Romania -->
                </div>
                <!-- <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Position - <?php echo $resPos['position_name']; ?>
                </div> -->
                <div>
                  <?php
                  if ($resInfo['group_role'] == '1') {
                    echo "Leader";
                  }elseif ($resInfo['group_role'] == '2') {
                    echo "Member";
                  }
                  ?>
                </div>
                <hr class="my-4">
                
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My Information</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div>
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">First Name</label>
                        <input type="text" id="fname" class="form-control form-control-alternative" placeholder="Username" value="<?php echo $resInfo['fname']; ?>" readonly="">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Middle Name</label>
                        <input type="email" id="mname" class="form-control form-control-alternative" value="<?php echo $resInfo['mname']; ?>" readonly="">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Last Name</label>
                        <input type="email" id="lname" class="form-control form-control-alternative" value="<?php echo $resInfo['lname']; ?>" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Username</label>
                        <input type="text" id="username" class="form-control form-control-alternative" placeholder="Username" value="<?php echo $resInfo['username']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Password</label>
                        <input type="password" id="password" class="form-control form-control-alternative" placeholder="Password" value="<?php echo $resInfo['password']; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">Contact Number</label>
                        <input type="text" id="contact_number" class="form-control form-control-alternative" placeholder="Contact Number" value="<?php echo $resInfo['contact_number']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">Email</label>
                        <input type="text" id="email" class="form-control form-control-alternative" placeholder="Email" value="<?php echo $resInfo['email']; ?>">
                      </div>
                    </div>
                    <input type="hidden" id="member_id" value="<?php echo $resInfo['member_id']; ?>">
                    
                  </div>
                </div>
                <hr class="my-4">
                <!-- Description -->
                <div class="pl-lg-4">
                  <div class="form-group focused">
                    <input type="submit" id="btnEdit" value="Save" class="btn btn-primary" style="float: right;">
                    
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php'; ?>