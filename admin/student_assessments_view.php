<?php
include 'header.php';

$member_id = $_GET['member_id'];

$student_query = mysqli_query($con, "SELECT * FROM members_tbl WHERE member_id = '$member_id'");
$student = mysqli_fetch_assoc($student_query);
?>

<div class="container mt-5">
    <h3>Assessment Results for <?php echo $student['fname'] . ' ' . $student['lname']; ?></h3>

    <?php
    // Get all modules this student has answered questions from
    $module_query = mysqli_query($con, "
        SELECT DISTINCT m.module_id, m.module_name, m.quarter
        FROM modules_tbl m
        JOIN questions_tbl q ON m.module_id = q.module_id
        JOIN answers_tbl a ON q.question_id = a.question_id
        WHERE a.member_id = '$member_id'
        ORDER BY m.quarter ASC, m.module_name ASC
    ");

    if (mysqli_num_rows($module_query) === 0) {
        echo "<div class='alert alert-warning'>No answers found for this student.</div>";
    }

    while ($module = mysqli_fetch_assoc($module_query)) {
        echo "<h4 class='mt-4'>Module: " . htmlspecialchars($module['module_name']) . " (Q" . $module['quarter'] . ")</h4>";

        // Get all answers for this module and student
        $answers_query = mysqli_query($con, "
            SELECT q.question_text, q.correct_answer, a.answer_text, a.is_correct, a.submitted_at
            FROM questions_tbl q
            JOIN answers_tbl a ON q.question_id = a.question_id
            WHERE q.module_id = '{$module['module_id']}' AND a.member_id = '$member_id'
        ");
        ?>

        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Student's Answer</th>
                    <th>Correct Answer</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($answer = mysqli_fetch_assoc($answers_query)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($answer['question_text']); ?></td>
                    <td><?php echo htmlspecialchars($answer['answer_text']); ?></td>
                    <td><?php echo htmlspecialchars($answer['correct_answer']); ?></td>
                    <td>
                        <?php if ($answer['is_correct'] == 1): ?>
                            <span class="badge bg-success">Correct</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Incorrect</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('M d, Y h:i A', strtotime($answer['submitted_at'])); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
