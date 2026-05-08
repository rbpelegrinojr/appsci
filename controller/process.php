<?php
include '../include/db.php';

// Check if the form is submitted and btnReg is clicked
if (isset($_POST['btnReg'])) {
    // Get form data and sanitize
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $mname = mysqli_real_escape_string($con, $_POST['mname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $school_year = mysqli_real_escape_string($con, $_POST['school_year'] ?? '');
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']); // No hashing

        // Insert new user into database
        $query = "INSERT INTO members_tbl (fname, mname, lname, grade, section, school_year, username, password) 
                  VALUES ('$fname', '$mname', '$lname', '$grade', '$section', '$school_year', '$username', '$password')";

        if (mysqli_query($con, $query)) {
            echo "<script>alert('Registration successful! You can now log in.'); window.location.href='../login_view.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "'); window.location.href='../register_view.php';</script>";
        }
    
}elseif (isset($_POST['btnLogin'])) {
    // Get login credentials
    session_start();
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if username exists and password matches
    $query = "SELECT * FROM members_tbl WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['member_id'] = $row['member_id'];
        $_SESSION['username'] = $row['username'];
        

        header('location: ../index.php');

        //echo "<script>alert('Login successful!'); window.location.href='../index.php';</script>";

    } else {
        echo "<script>alert('Invalid username or password. Please try again.'); window.location.href='../login_view.php';</script>";
    }
}elseif (isset($_POST['btnSubmitAssessment'])) {
    $member_id = $_POST['user_id'];
    $name = $_POST['name'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $certifications = $_POST['certifications'];
    $interview = $_POST['interview'];
    $test_score = '0';

    $total_score = ($education * 0.2) + ($experience * 0.3) + ($certifications * 0.25) + ($interview * 0.15) + ($test_score * 0.1);

    // $conn->query("INSERT INTO users (name) VALUES ('$name')");
    // $user_id = $conn->insert_id;
    $query = mysqli_query($con, "INSERT INTO rankings (user_id, education, experience, certifications, interview, test_score, total_score) VALUES ($member_id, $education, $experience, $certifications, $interview, $test_score, $total_score)");
    //$conn->query("INSERT INTO rankings (user_id, education, experience, certifications, interview, test_score, total_score) VALUES ($user_id, $education, $experience, $certifications, $interview, $test_score, $total_score)");

    if ($query) {
        ?>
        <script type="text/javascript">
            alert('Assessment Submitted Successfully, Please Answer the Assessment Exam.');
            window.location.href='../exam_view.php';
        </script>
        <?php
    }
    //echo "Data Submitted Successfully!";
}
// Close database connection
mysqli_close($con);
?>
