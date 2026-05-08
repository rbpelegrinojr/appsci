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
            <input type="text" class="form-control" name="options" value="<?php echo htmlspecialchars($q['options'] ?? ''); ?>" placeholder="Option1, Option2, ...">
        </div>

        <div class="mb-3">
            <label class="form-label">Correct Answer</label>
            <input type="text" class="form-control" name="correct_answer" value="<?php echo htmlspecialchars($q['correct_answer']); ?>" required>
        </div>

        <a href="quiz_creation.php?module_id=<?php echo $module_id; ?>" class="btn btn-secondary">Cancel</a>
        <button type="submit" name="edit_question" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<script>
    document.getElementById('question_type').addEventListener('change', function () {
        document.getElementById('options_container').style.display =
            this.value === 'multiple_choice' ? 'block' : 'none';
    });
</script>

<?php include 'footer.php'; ?>
