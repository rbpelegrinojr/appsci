<?php include 'header.php'; ?>
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
      <div class="row">

        <div class="col-12">
          <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
            <div class="page_title_left d-flex align-items-center">
              <h3 class="f_s_25 f_w_700 dark_text mr_30">Dashboard</h3>
              <ol class="breadcrumb page_bradcam mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
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

      <div class="col-xl-12 ">
        <div class="white_card card_height_100 mb_30 user_crm_wrapper">
          <div class="row">
           
            <div class="col-lg-4">
              <div class="single_crm ">
                <div class="crm_head crm_bg_1 d-flex align-items-center justify-content-between">
                  <div class="thumb">
                    <img src="img/crm/customer.svg" alt="">
                  </div>
                  <!-- <i class="fas fa-ellipsis-h f_s_11 white_text"></i> -->
                  <center><h4 style="color: white;">Total Users</h4></center>
                </div>
                <div class="crm_body">
                  <h4><?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM members_tbl")); ?></h4>
                  <!-- <p>Total Job Active</p> -->
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="single_crm">
                <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                  <div class="thumb">
                    <img src="img/crm/infographic.svg" alt="">
                  </div>
                  <!-- <i class="fas fa-ellipsis-h f_s_11 white_text"></i> -->
                  <center><h4 style="color: white;">Total Modules</h4></center>
                </div>
                <div class="crm_body">
                  <h4><?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM modules_tbl")); ?></h4>
                  <p>Total Moduless</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="single_crm">
                <div class="crm_head crm_bg_3 d-flex align-items-center justify-content-between">
                  <div class="thumb">
                    <img src="img/crm/graph.svg" alt="">
                  </div>
                  <center><h4 style="color: black;">Modules Answered</h4></center>
                </div>
                <div class="crm_body">
                  <h4>
                    <?php
                      $answered_modules_query = mysqli_query($con, "
                        SELECT COUNT(DISTINCT q.module_id) AS total_answered_modules
                        FROM answers_tbl a
                        JOIN questions_tbl q ON a.question_id = q.question_id
                      ");
                      $answered_modules = mysqli_fetch_assoc($answered_modules_query);
                      echo $answered_modules['total_answered_modules'];
                    ?>
                  </h4>
                  <p>With At Least 1 Answer</p>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>

      <!--  -->

    </div>
</div>
<?php include 'footer.php'; ?>