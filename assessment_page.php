<?php include 'header.php'; ?>
<!-- Page Header -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Assessment Exam</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Assessment Exam</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Registration Form -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Assessment Exam</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
					<form action="controller/submit_assessment.php" method="post">
					    <input type='hidden' value='<?php echo $member_id; ?>' name="member_id">

					    <?php
					    // Change to your table
					    $result = mysqli_query($con, "SELECT * FROM questions_tbl WHERE module_id = '{$_REQUEST['m_id']}' ORDER BY question_id ASC");
					    $questionNumber = 1;

					    while ($row = mysqli_fetch_assoc($result)) {
					        echo "<div class='mb-4 p-3 border rounded'>";
					        echo "<h5 class='mb-3'>Q$questionNumber: " . htmlspecialchars($row['question_text']) . "</h5>";

					        if ($row['question_type'] === 'multiple_choice') {
					            $options = explode(',', $row['options']);
					            foreach ($options as $index => $option) {
					                $optId = chr(65 + $index); // A, B, C...
					                $option = trim($option);
					                echo "<div class='form-check'>";
					                echo "<input class='form-check-input' type='radio' name='answers[{$row['question_id']}]' value='$option' id='q{$row['question_id']}{$optId}' required>";
					                echo "<label class='form-check-label' for='q{$row['question_id']}{$optId}'>" . htmlspecialchars($option) . "</label>";
					                echo "</div>";
					            }
					        } elseif ($row['question_type'] === 'identification') {
					            echo "<input type='text' class='form-control' name='answers[{$row['question_id']}]' required>";
					        }

					        echo "</div>";
					        $questionNumber++;
					    }
					    ?>

					    <div class="text-center">
					        <button type="submit" class="btn btn-primary w-100">Submit Assessment</button>
					    </div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
