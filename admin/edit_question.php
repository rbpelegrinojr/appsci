<?php
include 'header.php';

if (!isset($_GET['question_id']) || !isset($_GET['module_id'])) {
    echo "<div class='alert alert-danger'>Missing question or module ID.</div>";
    include 'footer.php';
    exit();
}

$question_id = (int)$_GET['question_id'];
$module_id   = (int)$_GET['module_id'];

$result = mysqli_query($con, "SELECT * FROM questions_tbl WHERE question_id = $question_id AND module_id = $module_id");
$q = mysqli_fetch_assoc($result);

if (!$q) {
    echo "<div class='alert alert-danger'>Question not found.</div>";
    include 'footer.php';
    exit();
}
?>

<div class="container mt-5">
    <h3>Edit Question</h3>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="controller/save_data.php">
        <input type="hidden" name="question_id" value="<?php echo $q['question_id']; ?>">
        <input type="hidden" name="module_id" value="<?php echo $module_id; ?>">

        <div class="mb-3">
            <label class="form-label">Question Text</label>
            <textarea class="form-control" name="question_text" rows="3" required><?php echo htmlspecialchars($q['question_text']); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Question Type</label>
            <select class="form-control" name="question_type" id="question_type" required>
                <option value="multiple_choice" <?php echo $q['question_type'] === 'multiple_choice' ? 'selected' : ''; ?>>Multiple Choice</option>
                <option value="identification" <?php echo $q['question_type'] === 'identification' ? 'selected' : ''; ?>>Identification</option>
            </select>
        </div>

        <div class="mb-3" id="options_container" <?php echo $q['question_type'] !== 'multiple_choice' ? 'style="display:none;"' : ''; ?>>
            <label class="form-label">Options (comma-separated)</label>
            <input type="text" class="form-control" name="options" id="options_input" value="<?php echo htmlspecialchars($q['options'] ?? ''); ?>" placeholder="Option1, Option2, ...">
        </div>

        <div class="mb-3">
            <label class="form-label">Correct Answer</label>
            <?php
                $options_list = array_filter(array_map('trim', explode(',', $q['options'] ?? '')));
            ?>
            <select class="form-control" name="correct_answer" id="correct_answer_select" <?php echo $q['question_type'] !== 'multiple_choice' ? 'style="display:none;" disabled' : 'required'; ?>>
                <option value="">-- Select Correct Answer --</option>
                <?php foreach ($options_list as $opt): ?>
                    <option value="<?php echo htmlspecialchars($opt); ?>" <?php echo $q['correct_answer'] === $opt ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($opt); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="text" class="form-control" name="correct_answer" id="correct_answer_input" value="<?php echo $q['question_type'] !== 'multiple_choice' ? htmlspecialchars($q['correct_answer']) : ''; ?>" placeholder="Correct Answer" <?php echo $q['question_type'] === 'multiple_choice' ? 'style="display:none;" disabled' : 'required'; ?>>
        </div>

        <a href="quiz_creation.php?module_id=<?php echo $module_id; ?>" class="btn btn-secondary">Cancel</a>
        <button type="submit" name="edit_question" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<script>
    function populateCorrectAnswerDropdown() {
        const optionsInput = document.getElementById('options_input');
        const select = document.getElementById('correct_answer_select');
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

    function toggleCorrectAnswerField(type) {
        const select = document.getElementById('correct_answer_select');
        const input = document.getElementById('correct_answer_input');
        const optionsContainer = document.getElementById('options_container');

        if (type === 'multiple_choice') {
            optionsContainer.style.display = 'block';
            select.style.display = 'block';
            select.disabled = false;
            select.required = true;
            input.style.display = 'none';
            input.disabled = true;
            input.required = false;
            populateCorrectAnswerDropdown();
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

    document.getElementById('question_type').addEventListener('change', function () {
        toggleCorrectAnswerField(this.value);
    });

    document.getElementById('options_input').addEventListener('input', function () {
        populateCorrectAnswerDropdown();
    });
</script>

<?php include 'footer.php'; ?>
