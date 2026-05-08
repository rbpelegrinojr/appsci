<?php include 'header.php'; ?>

<?php
$query = mysqli_query($con, "SELECT * FROM requirements_tbl WHERE member_id = '$member_id'");
?>

<!-- Search Start -->
<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <form method="GET" action="">
            <div class="row g-2">
                <!-- Add search filters or other elements if needed -->
            </div>
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">MY APPLICATIONS</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <?php
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            // Get job details
                            $rReq = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM jobs_tbl WHERE job_id = '{$row['job_id']}'"));
                            
                            // Define status map
                            $statusMap = [
                                0 => 'Pending',
                                1 => 'Approved',
                                2 => 'Completed',
                                3 => 'Cancelled'
                            ];
                            
                            // Get the human-readable status
                            $statusText = isset($statusMap[$row['applicant_status']]) ? $statusMap[$row['applicant_status']] : 'Unknown';
                    ?>
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="images/banner.png" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">
                                        <a href="#">
                                            <?php echo $rReq['position']; ?>
                                        </a>
                                    </h5>
                                    <p class="mb-1"><strong>Salary:</strong> <?php echo $rReq['salary']; ?></p>
                                    <p class="mb-1"><strong>Experience:</strong> <?php echo $rReq['experience']; ?></p>
                                    <p class="mb-1"><strong>Training:</strong> <?php echo $rReq['training']; ?></p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <!-- Display the applicant status -->
                                    <span class="badge <?php 
                                        echo $row['applicant_status'] == 0 ? 'bg-warning' :
                                             ($row['applicant_status'] == 1 ? 'bg-success' :
                                              ($row['applicant_status'] == 2 ? 'bg-primary' : 'bg-danger'));
                                    ?>"><?php echo $statusText; ?></span>
                                </div>
                                <small class="text-truncate">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    Date Submitted: <?php echo $row['date_uploaded']; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                    ?>
                    <br>
                    <center><div class="alert alert-danger"><label>No Data Available</label></div></center>
                    <?php
                    }
                    ?>
                    <!-- <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jobs End -->

<?php include 'footer.php'; ?>
