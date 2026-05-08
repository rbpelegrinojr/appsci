<?php
include 'db_connection.php';

if (isset($_POST['add_question'])) {
    $module_id = $_POST['module_id'];
    $question_text = mysqli_real_escape_string($con, $_POST['question_text']);
    $question_type = $_POST['question_type'];
    $correct_answer = mysqli_real_escape_string($con, $_POST['correct_answer']);
    $options = isset($_POST['options']) ? mysqli_real_escape_string($con, $_POST['options']) : '';

    $query = "INSERT INTO questions_tbl (module_id, question_text, question_type, options, correct_answer)
              VALUES ('$module_id', '$question_text', '$question_type', '$options', '$correct_answer')";

    if (mysqli_query($con, $query)) {
        header("Location: quiz_creation.php?module_id=$module_id&success=Question added successfully");
    } else {
        header("Location: quiz_creation.php?module_id=$module_id&error=Error adding question");
    }
}
?>
