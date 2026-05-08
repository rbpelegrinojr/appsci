<?php include 'header.php'; ?>
<style type="text/css">
  .modal-backdrop {
    position: relative;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: #000;
}
</style>
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
      <div class="row">

        <div class="col-12">
          <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
            <div class="page_title_left d-flex align-items-center">
              <h3 class="f_s_25 f_w_700 dark_text mr_30">Announcements</h3>
              <ol class="breadcrumb page_bradcam mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Announcements</li>
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

      <div class="row ">
<div class="col-lg-12">
    <div class="card_box box_shadow position-relative mb_30">
      <div class="white_box_tittle ">
        <div class="main-title2 ">
          <a href="" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#add_announcement">Add</a>
          <h4 class="mb-2 nowrap">My Announcements</h4>
        </div>
      </div>
      <div class="box_body">
        <div class="default-according" id="accordion1">
        

          <?php
          $rNumRs = mysqli_num_rows(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE teacher_id = '$uid'"));

          if ($rNumRs > 0) {
            ?>
            <?php
            //$resSelect = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE group_id = '{$resInfo['group_id']}' AND batch_year = '2022'"));
            $query = mysqli_query($con, "SELECT * FROM announcements_tbl WHERE selected_group_id = '{$rS['selected_group_id']}' AND teacher_id = '$uid'");
            if ($rows = mysqli_num_rows($query) > 0) {
              # code...
            }else{
              ?>
              <div class="col-lg-12">
                <div class="white_box mb_30">
                  <!-- <div class="box_header ">
                    <div class="main-title">
                      <h3 class="mb-0">Syste</h3>
                    </div>
                  </div> -->
                  <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Sorry!</h4>
                    <h3>No Announcements Available</h3>
                    <hr>
                    <!-- <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> -->
                  </div>
                </div>
                
              </div>
              <?php
            }
            while ($row = mysqli_fetch_assoc($query)) {
              ?>
    
            <div class="card">
              <div class="card-header pink_bg" id="headingFour">
                <h5 class="mb-0" style="color: white;">
                  <a class="btn text_white collapsed" data-bs-toggle="collapse" data-bs-target="#announcement<?php echo $row['announcement_id']; ?>" aria-expanded="false" aria-controls="collapseFour"><?php echo $row['announcement_title']; ?> - <small style="font-size: 10px;"><?php echo $row['announcement_date_created'].' / '.$row['announcement_time_created']; ?></small></a>
                </h5>
              </div>
              <div class="collapse" id="announcement<?php echo $row['announcement_id']; ?>" aria-labelledby="headingOne" data-parent="#accordion1" style="">
                <div class="card-body"><?php echo $row['announcement_content']; ?></div>
              </div>
            </div>
              <?php
            }
            ?>
            <?php
          }else{
            ?>
            <div class="col-lg-12">
                <div class="white_box mb_30">
                  <!-- <div class="box_header ">
                    <div class="main-title">
                      <h3 class="mb-0">Syste</h3>
                    </div>
                  </div> -->
                  <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Sorry!</h4>
                    <h3>Please select your designated group first, go to your profile.</h3>
                    <hr>
                    <!-- <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> -->
                  </div>
                </div>
                
              </div>
            <?php
          }
          ?>

        </div>
      </div>
    </div>
  </div>
  <form action="controller/save_data.php" method="POST">
  <div class="modal fade" id="add_announcement" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Advicee Announcement</h5>
            <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button> -->
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="col-md-12">
                <input type="hidden" name="teacher_id" value="<?php echo $resInfo['teacher_id']; ?>">
                <label>Announcement Title</label>
                <input type="text" name="announcement_title" class="form-control" required="" placeholder="Type Here...">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label>Announcement Content</label>
                <textarea class="form-control" name="announcement_content" required="" placeholder="Type Here..."></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label>Select Group</label>
                <select class="form-control" name="selected_group_id" required="">
                  <option value="">-Select-</option>
                  <?php
                  $qG = mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE teacher_id = '{$resInfo['teacher_id']}'");
                  while ($rG = mysqli_fetch_assoc($qG)) {
                    $rGroups = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM groups_tbl WHERE group_id = '{$rG['group_id']}'"));
                    ?>
                    <option value="<?php echo $rG['selected_group_id']; ?>"><?php echo $rGroups['group_name']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" name="btnAddAnnouncement" class="btn btn-primary" value="Save">
          </div>
        </div>
        
      </div>
    </div>
  </form>
<?php include 'footer.php'; ?>