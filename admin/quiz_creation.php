<?php
include 'header.php';

if (!isset($_GET['module_id'])) {
    echo "<div class='alert alert-danger'>No module specified.</div>";
    exit();
}

$module_id = (int)$_GET['module_id'];
$query = mysqli_query($con, "SELECT * FROM questions_tbl WHERE module_id = $module_id");
$questions = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="container mt-5">
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

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
                    <input type="text" class="form-control options-input" name="options[]" placeholder="Option1, Option2, ..." />
                </div>
                <div class="mb-2">
                    <select class="form-control correct-answer-select" name="correct_answer[]" required>
                        <option value="">-- Select Correct Answer --</option>
                    </select>
                    <input type="text" class="form-control correct-answer-input" name="correct_answer[]" placeholder="Correct Answer" required style="display:none;" disabled />
                </div>
                <hr>
            </div>
        </div>

        <input type="hidden" name="module_id" value="<?php echo $module_id; ?>">
        <button type="button" class="btn btn-secondary mb-3" onclick="addQuestion()">Add Another Question</button>
        <button type="submit" name="add_questions_bulk" class="btn btn-primary">Submit All Questions</button>
    </form>

    <h4 class="mt-4">Existing Questions</h4>
    <?php if (empty($questions)): ?>
        <p class="text-muted">No questions yet.</p>
    <?php else: ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Type</th>
                <th>Options</th>
                <th>Correct Answer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($questions as $idx => $q): ?>
            <tr>
                <td><?php echo $idx + 1; ?></td>
                <td><?php echo htmlspecialchars($q['question_text']); ?></td>
                <td><?php echo htmlspecialchars($q['question_type']); ?></td>
                <td><?php echo htmlspecialchars($q['options'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($q['correct_answer']); ?></td>
                <td style="white-space:nowrap;">
                    <!-- Edit Button -->
                    <a href="edit_question.php?question_id=<?php echo $q['question_id']; ?>&module_id=<?php echo $module_id; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <!-- Delete Button -->
                    <form method="POST" action="controller/save_data.php" style="display:inline;" onsubmit="return confirm('Delete this question?');">
                        <input type="hidden" name="question_id" value="<?php echo $q['question_id']; ?>">
                        <input type="hidden" name="module_id" value="<?php echo $module_id; ?>">
                        <button type="submit" name="delete_question" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<script>
    function addQuestion() {
        const container = document.getElementById('question-container');
        const block = document.querySelector('.question-block');
        const clone = block.cloneNode(true);

        clone.querySelectorAll('textarea, input').forEach(el => el.value = '');
        // Reset correct answer dropdown
        const sel = clone.querySelector('.correct-answer-select');
        sel.innerHTML = '<option value="">-- Select Correct Answer --</option>';

        initQuestionBlock(clone);
        container.appendChild(clone);
        // Trigger change to set initial visibility
        clone.querySelector('.question-type').dispatchEvent(new Event('change'));
    }

    function populateCorrectAnswerDropdown(block) {
        const optionsInput = block.querySelector('.options-input');
        const select = block.querySelector('.correct-answer-select');
        const previousValue = select.value;
        const options = optionsInput.value.split(',').map(o => o.trim()).filter(o => o !== '');

        select.innerHTML = '<option value="">-- Select Correct Answer --</option>';
        options.forEach(function(opt) {
            const o = document.createElement('option');
            o.value = opt;
            o.textContent = opt;
            if (opt === previousValue) o.selected = true;
            select.appendChild(o);
        });
    }

    function toggleCorrectAnswerField(block) {
        const type = block.querySelector('.question-type').value;
        const select = block.querySelector('.correct-answer-select');
        const input = block.querySelector('.correct-answer-input');
        const optionsContainer = block.querySelector('.options-container');

        if (type === 'multiple_choice') {
            optionsContainer.style.display = 'block';
            select.style.display = 'block';
            select.disabled = false;
            select.required = true;
            input.style.display = 'none';
            input.disabled = true;
            input.required = false;
            populateCorrectAnswerDropdown(block);
        } else {
            optionsContainer.style.display = 'none';
            select.style.display = 'none';
            select.disabled = true;
            select.required = false;
            input.style.display = 'block';
            input.disabled = false;
            input.required = true;
        }
    }

    function initQuestionBlock(block) {
        block.querySelector('.question-type').addEventListener('change', function() {
            toggleCorrectAnswerField(block);
        });
        block.querySelector('.options-input').addEventListener('input', function() {
            populateCorrectAnswerDropdown(block);
        });
    }

    document.querySelectorAll('.question-block').forEach(function(block) {
        initQuestionBlock(block);
        block.querySelector('.question-type').dispatchEvent(new Event('change'));
    });
</script>

<?php include 'footer.php'; ?>

