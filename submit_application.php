<?php
session_start();
include 'include/db.php';

// Ensure user is logged in
if (!isset($_SESSION['member_id'])) {
    echo "<script>alert('You must log in first to apply.'); window.location.href='login_view.php';</script>";
    exit();
}

// Get user ID from session
$member_id = $_SESSION['member_id'];

// Validate and retrieve job_id
if (!isset($_POST['job_id']) || empty($_POST['job_id'])) {
    echo "<script>alert('Invalid job selection.'); window.location.href='job_content_view.php';</script>";
    exit();
}
$job_id = mysqli_real_escape_string($con, $_POST['job_id']);

// Define allowed file types
$allowed_types = ['pdf', 'doc', 'docx'];

// Handle file uploads
function uploadFile($file, $destination_folder) {
    global $allowed_types;

    $file_name = basename($file['name']);
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Check file type
    if (!in_array($file_ext, $allowed_types)) {
        return false;
    }

    // Create unique file name
    $new_file_name = uniqid() . "_" . $file_name;
    $target_path = $destination_folder . $new_file_name;

    // Move file to destination
    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        return $new_file_name;
    } else {
        return false;
    }
}

// File upload directory
$upload_dir = "uploads/";

// Ensure uploads directory exists
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Upload files
$application_letter = uploadFile($_FILES['application_letter'], $upload_dir);
$tor = uploadFile($_FILES['tor'], $upload_dir);
$resume = uploadFile($_FILES['resume'], $upload_dir);
$diploma = uploadFile($_FILES['diploma'], $upload_dir);
$cover_letter = mysqli_real_escape_string($con, $_POST['cover_letter']);
$date_uploaded = date('Y-m-d');

// Check if all files were uploaded successfully
if (!$application_letter || !$tor || !$resume || !$diploma) {
    echo "<script>alert('Error uploading files. Please upload only PDF or DOC files.'); window.location.href='job_content_view.php?j_id=".$job_id."';</script>";
    exit();
}

// Insert application details into the database
$query = "INSERT INTO requirements_tbl (job_id, member_id, application_letter, tor, resume, diploma, cover_letter, date_uploaded) 
          VALUES ('$job_id', '$member_id', '$application_letter', '$tor', '$resume', '$diploma', '$cover_letter', '$date_uploaded')";

if (mysqli_query($con, $query)) {
    echo "<script>alert('Application submitted successfully!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Error submitting application: " . mysqli_error($con) . "'); window.location.href='job_content_view.php?j_id=".$job_id."';</script>";
}

// Close database connection
mysqli_close($con);
?>
