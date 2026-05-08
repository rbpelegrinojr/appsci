<?php
include 'include/db.php'; // your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $module_id = intval($_POST['module_id']);
    $feedback = trim($_POST['feedback_text']);
    $user_id = $_POST['member_id']; // assuming login session

    if (!empty($feedback)) {
        $stmt = $con->prepare("INSERT INTO feedback_tbl (module_id, member_id, feedback_text, submitted_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $module_id, $user_id, $feedback);
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error submitting feedback.";
        }
    } else {
        echo "Feedback is required.";
    }
}
?>
