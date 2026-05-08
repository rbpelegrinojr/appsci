<?php
include('../include/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answers']) && isset($_POST['member_id'])) {
    $member_id = intval($_POST['member_id']);
    $answers = $_POST['answers'];
    $score = 0;
    $total = count($answers);

    foreach ($answers as $question_id => $answer) {
        $question_id = intval($question_id);
        $answer = mysqli_real_escape_string($con, trim($answer));

        $query = mysqli_query($con, "SELECT correct_answer FROM questions_tbl WHERE question_id = $question_id");
        $row = mysqli_fetch_assoc($query);
        $correct_answer = trim($row['correct_answer']);

        $is_correct = (strtolower($answer) === strtolower($correct_answer)) ? 1 : 0;
        if ($is_correct) $score++;

        mysqli_query($con, "INSERT INTO answers_tbl (member_id, question_id, answer_text, is_correct) VALUES ('$member_id', '$question_id', '$answer', '$is_correct')");
    }

    // Optional: Store the total score in another table or redirect with a message
    header("Location: ../assessment_result.php?score=$score&total=$total");
    exit();
} else {
    echo "Invalid submission.";
}
?>
