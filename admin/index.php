<?php
include 'header.php';

// Modules per school year (for chart)
$sy_labels = [];
$sy_counts = [];
$sy_query = mysqli_query($con, "
    SELECT school_year, COUNT(*) AS total_modules
    FROM modules_tbl
    GROUP BY school_year
    ORDER BY school_year DESC
");
while ($sy_row = mysqli_fetch_assoc($sy_query)) {
    $sy_labels[] = $sy_row['school_year'];
    $sy_counts[] = $sy_row['total_modules'];
}

// Count modules without quiz (no questions)
$no_quiz_query = mysqli_query($con, "
    SELECT COUNT(*) AS total_no_quiz
    FROM modules_tbl m
    LEFT JOIN questions_tbl q ON m.module_id = q.module_id
    WHERE q.module_id IS NULL
");
$no_quiz_row = mysqli_fetch_assoc($no_quiz_query);
$total_no_quiz = $no_quiz_row ? $no_quiz_row['total_no_quiz'] : 0;

// Recent modules (last 5)
$recent_modules = mysqli_query($con, "
    SELECT module_name, quarter, school_year, uploaded_at
    FROM modules_tbl
    ORDER BY uploaded_at DESC
    LIMIT 5
");
?>

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
           
            <div class="col-lg-3">
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
            <div class="col-lg-3">
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
            <div class="col-lg-3">
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

            <div class="col-lg-3">
              <div class="single_crm">
                <div class="crm_head crm_bg_4 d-flex align-items-center justify-content-between">
                  <div class="thumb">
                    <img src="img/crm/warning.svg" alt="">
                  </div>
                  <center><h4 style="color: white;">Modules Without Quiz</h4></center>
                </div>
                <div class="crm_body">
                  <h4><?php echo $total_no_quiz; ?></h4>
                  <p>Need Questions</p>
                </div>
              </div>
            </div>



          </div>



        </div>
      </div>

      <!--  -->


      <div class="row mt-4">
    <div class="col-xl-6">
        <div class="white_card mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0">Modules per School Year</h3>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <canvas id="modulesPerSchoolYear"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="white_card mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0">Recent Modules</h3>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Module Name</th>
                                <th>Quarter</th>
                                <th>School Year</th>
                                <th>Uploaded</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($rm = mysqli_fetch_assoc($recent_modules)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($rm['module_name']); ?></td>
                                <td><?php echo htmlspecialchars($rm['quarter']); ?></td>
                                <td><?php echo htmlspecialchars($rm['school_year']); ?></td>
                                <td><?php echo htmlspecialchars($rm['uploaded_at']); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('modulesPerSchoolYear').getContext('2d');

    var labels = <?php echo json_encode($sy_labels); ?>;
    var data   = <?php echo json_encode($sy_counts); ?>;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Modules',
                data: data,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>

<?php include 'footer.php'; ?>
