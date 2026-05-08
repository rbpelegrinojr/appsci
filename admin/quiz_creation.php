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
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editQuestionModal"
                        onclick="openEditModal(
                            <?php echo $q['question_id']; ?>,
                            <?php echo htmlspecialchars(json_encode($q['question_text'])); ?>,
                            <?php echo htmlspecialchars(json_encode($q['question_type'])); ?>,
                            <?php echo htmlspecialchars(json_encode($q['options'] ?? '')); ?>,
                            <?php echo htmlspecialchars(json_encode($q['correct_answer'])); ?>
                        )">Edit</button>
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

<!-- Edit Question Modal -->
<div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="controller/save_data.php">
                <input type="hidden" name="question_id" id="edit_question_id">
                <input type="hidden" name="module_id" value="<?php echo $module_id; ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Question Text</label>
                        <textarea class="form-control" name="question_text" id="edit_question_text" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Question Type</label>
                        <select class="form-control" name="question_type" id="edit_question_type" required>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="identification">Identification</option>
                        </select>
                    </div>
                    <div class="mb-3" id="edit_options_container">
                        <label class="form-label">Options (comma-separated)</label>
                        <input type="text" class="form-control" name="options" id="edit_options" placeholder="Option1, Option2, ...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correct Answer</label>
                        <input type="text" class="form-control" name="correct_answer" id="edit_correct_answer" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit_question" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
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

    function openEditModal(id, text, type, options, correctAnswer) {
        document.getElementById('edit_question_id').value = id;
        document.getElementById('edit_question_text').value = text;
        document.getElementById('edit_question_type').value = type;
        document.getElementById('edit_options').value = options;
        document.getElementById('edit_correct_answer').value = correctAnswer;

        // Show/hide options field based on type
        var optCont = document.getElementById('edit_options_container');
        optCont.style.display = (type === 'multiple_choice') ? 'block' : 'none';

        document.getElementById('edit_question_type').onchange = function() {
            optCont.style.display = (this.value === 'multiple_choice') ? 'block' : 'none';
        };
    }
</script>

<?php include 'footer.php'; ?>

