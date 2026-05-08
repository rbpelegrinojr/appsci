<?php include 'header.php';
error_reporting(0);
?>

<!-- Profile Header -->
<div class="container-xxl py-5 bg-dark text-white text-center">
    <img src="images/deped.png" class="rounded-circle mb-3" width="120" height="120" alt="Profile Picture">
    <h2 style="color: white;">Assessment Results</h2>
</div>

<!-- Profile Details -->
<div class="container py-5">
    <div class="row">
        
        <!-- Basic Information Section -->
        <!-- Assessment Results -->
        <?php
        $user_id = (int)$member_id;

        // Fetch total score summary
        $totalQuery = mysqli_query($con, "
            SELECT 
                COUNT(*) as total_questions,
                COALESCE(SUM(a.is_correct), 0) as correct_answers
            FROM answers_tbl a
            JOIN questions_tbl q ON q.question_id = a.question_id
            WHERE a.member_id = $user_id
        ");
        $totalRow = mysqli_fetch_assoc($totalQuery);
        $totalQuestions = (int)$totalRow['total_questions'];
        $totalCorrect   = (int)$totalRow['correct_answers'];
        $totalPercent   = ($totalQuestions > 0) ? round(($totalCorrect / $totalQuestions) * 100, 2) : 0;
        ?>

        <!-- Total Score Summary -->
        <div class="card p-4 mt-4 bg-dark text-white">
            <h4>Overall Total Score</h4>
            <div class="row text-center mt-3">
                <div class="col-md-4">
                    <h2><?php echo $totalQuestions; ?></h2>
                    <p>Total Questions</p>
                </div>
                <div class="col-md-4">
                    <h2><?php echo $totalCorrect; ?></h2>
                    <p>Correct Answers</p>
                </div>
                <div class="col-md-4">
                    <h2><?php echo $totalPercent; ?>%</h2>
                    <p>Overall Score</p>
                </div>
            </div>
        </div>

        <div class="card p-4 mt-4">
            <h4>Assessment Scores</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Total Questions</th>
                        <th>Correct Answers</th>
                        <th>Score (%)</th>
                        <th>Date Taken</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch distinct module attempts
                    $scoreQuery = mysqli_query($con, "
                        SELECT 
                            q.module_id,
                            m.module_name,
                            DATE(a.submitted_at) as date_taken,
                            COUNT(*) as total_questions,
                            SUM(a.is_correct) as correct_answers
                        FROM answers_tbl a
                        JOIN questions_tbl q ON q.question_id = a.question_id
                        LEFT JOIN modules_tbl m ON m.module_id = q.module_id
                        WHERE a.member_id = $user_id
                        GROUP BY q.module_id, DATE(a.submitted_at)
                        ORDER BY a.submitted_at DESC
                    ");

                    if (mysqli_num_rows($scoreQuery) > 0) {
                        while ($row = mysqli_fetch_assoc($scoreQuery)) {
                            $scorePercent = ($row['total_questions'] > 0) ? round(($row['correct_answers'] / $row['total_questions']) * 100, 2) : 0;

                            $module_name = $row['module_name'] != '' ? $row['module_name'] : "Module " . $row['module_id'];

                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($module_name) . "</td>";
                            echo "<td>" . $row['total_questions'] . "</td>";
                            echo "<td>" . $row['correct_answers'] . "</td>";
                            echo "<td>" . $scorePercent . "%</td>";
                            echo "<td>" . $row['date_taken'] . "</td>";
                            echo "</tr>";
                        }

                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No assessments taken yet.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>