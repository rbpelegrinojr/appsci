<?php
include '../include/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $job_name = mysqli_real_escape_string($con, $_POST['job_name']);
    $position = mysqli_real_escape_string($con, $_POST['position']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);
    $educational_qualification = mysqli_real_escape_string($con, $_POST['educational_qualification']);
    $eligibility = mysqli_real_escape_string($con, $_POST['eligibility']);
    $experience = mysqli_real_escape_string($con, $_POST['experience']);
    $job_status = mysqli_real_escape_string($con, $_POST['job_status']);

    // Insert data into jobs_tbl
    $query = "INSERT INTO jobs_tbl (job_name, position, salary, educational_qualification, eligibility, experience, job_status, date_posted) 
              VALUES ('$job_name', '$position', '$salary', '$educational_qualification', '$eligibility', '$experience', '$job_status', NOW())";

    if (mysqli_query($con, $query)) {
        // Redirect back to job listings with success message
        header("Location: job_view.php?success=1");
        exit();
    } else {
        // Redirect back with an error message
        header("Location: job_view.php?error=1");
        exit();
    }
}
?>