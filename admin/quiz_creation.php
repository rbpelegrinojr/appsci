<?php
include 'header.php';

if (!isset($_GET['module_id'])) {
    echo "<div class='alert alert-danger'>No module specified.</div>";
    exit();
}

$module_id = $_GET['module_id'];
$query = mysqli_query($con, "SELECT * FROM questions_tbl WHERE module_id = $module_id");
$questions = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="container mt-5">
    <h3>Quiz for Module ID: <?php echo htmlspecialchars($module_id); ?></h3>

    <!-- Add multiple questions -->
    <form action="controller/save_data.php" method="POST" id="quizForm">
        <div id="question-container">
            <!-- Question block template -->
            <div class="question-block border p-3 mb-3">
                <h5>Question</h5>
                <div class="mb-2">
                    <textarea class="form-control" name="question_text[]" rows="2" required></textarea>
                </div>
                <div class="mb-2">
                    <select class="form-control question-type" name="question_type[]" required>
                        <option value="multiple_choice">Multiple Choice</option>
                        <option value="identification">Identification</option>
                    </select>
                </div>
                <div class="mb-2 options-container">
                    <input type="text" class="form-control" name="options[]" placeholder="Option1, Option2, ..." />
                </div>
                <div class="mb-2">
                    <input type="text" class="form-control" name="correct_answer[]" placeholder="Correct Answer" required />
                </div>
                <hr>
            </div>
        </div>

        <input type="hidden" name="module_id" value="<?php echo $module_id; ?>">
        <button type="button" class="btn btn-secondary mb-3" onclick="addQuestion()">Add Another Question</button>
        <button type="submit" name="add_questions_bulk" class="btn btn-primary">Submit All Questions</button>
    </form>

    <h4 class="mt-4">Existing Questions</h4>
    <ul>
        <?php foreach ($questions as $q) { ?>
            <li><?php echo htmlspecialchars($q['question_text']); ?> - <em><?php echo htmlspecialchars($q['question_type']); ?></em></li>
        <?php } ?>
    </ul>
</div>

<script>
    function addQuestion() {
        const container = document.getElementById('question-container');
        const block = document.querySelector('.question-block');
        const clone = block.cloneNode(true);

        clone.querySelectorAll('textarea, input').forEach(el => el.value = '');
        clone.querySelector('.question-type').addEventListener('change', toggleOptionsVisibility);
        container.appendChild(clone);
    }

    function toggleOptionsVisibility() {
        const block = this.closest('.question-block');
        const optionsContainer = block.querySelector('.options-container');
        if (this.value === 'multiple_choice') {
            optionsContainer.style.display = 'block';
        } else {
            optionsContainer.style.display = 'none';
        }
    }

    document.querySelectorAll('.question-type').forEach(el => {
        el.addEventListener('change', toggleOptionsVisibility);
        el.dispatchEvent(new Event('change')); // trigger on load
    });
</script>

<?php include 'footer.php'; ?>
