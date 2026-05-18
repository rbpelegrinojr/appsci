<?php
include '../../include/db.php'; 

if (isset($_REQUEST['btnAddModule'])) {
    $section_raw = trim($_POST['section'] ?? '');
    $module_name = trim($_POST['module_name'] ?? '');
    $quarter = trim($_POST['quarter'] ?? '');
    $valid_quarters = ['1st', '2nd', '3rd', '4th'];
    if (
        $section_raw === '' ||
        $module_name === '' ||
        $quarter === '' ||
        !in_array($quarter, $valid_quarters, true) ||
        strlen($module_name) > 255 ||
        strlen($section_raw) > 100
    ) {
        header("Location: ../module_list.php?error=1");
        exit;
    }

    if (isset($_FILES['module_file']) && $_FILES['module_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['module_file']['tmp_name'];
        $fileName = basename($_FILES['module_file']['name']);
        $uploadDir = '../../uploads/modules/';
        $fileNameWithTime = time() . '_' . $fileName;
        $uploadPath = $uploadDir . $fileNameWithTime;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($fileTmp, $uploadPath)) {
            // Construct the full URL (adjust the base URL if your domain changes)
            $baseURL = 'https://appsci.thesissystems.link/uploads/modules/';
            $fileURL = $baseURL . $fileNameWithTime;

            $stmt = mysqli_prepare($con, "INSERT INTO modules_tbl (module_name, quarter, section, module_file_url) VALUES (?, ?, ?, ?)");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssss", $module_name, $quarter, $section_raw, $fileURL);

                if (mysqli_stmt_execute($stmt)) {
                    header("Location: ../module_list.php?success=1");
                } else {
                    header("Location: ../module_list.php?error=1");
                }
                mysqli_stmt_close($stmt);
            } else {
                header("Location: ../module_list.php?error=1");
            }
        } else {
            header("Location: ../module_list.php?error=1");
        }
    } else {
        header("Location: ../module_list.php?error=1");
    }
}

if (isset($_POST['add_questions_bulk'])) {
    $module_id = (int)$_POST['module_id'];
    $texts = $_POST['question_text'];
    $types = $_POST['question_type'];
    $optionsList = $_POST['options'];
    $answers = $_POST['correct_answer'];

    $success = true;
    for ($i = 0; $i < count($texts); $i++) {
        $question_text = mysqli_real_escape_string($con, $texts[$i]);
        $question_type = $types[$i];
        $options = isset($optionsList[$i]) ? mysqli_real_escape_string($con, $optionsList[$i]) : '';
        $correct_answer = mysqli_real_escape_string($con, $answers[$i]);

        $sql = "INSERT INTO questions_tbl (module_id, question_text, question_type, options, correct_answer)
                VALUES ('$module_id', '$question_text', '$question_type', '$options', '$correct_answer')";

        if (!mysqli_query($con, $sql)) {
            $success = false;
            break;
        }
    }

    if ($success) {
        header("Location: ../quiz_creation.php?module_id=$module_id&success=Questions added successfully");
    } else {
        header("Location: ../quiz_creation.php?module_id=$module_id&error=Error adding questions");
    }
}

// Edit a single quiz question
if (isset($_POST['edit_question'])) {
    $question_id = (int)$_POST['question_id'];
    $module_id   = (int)$_POST['module_id'];
    $question_text  = mysqli_real_escape_string($con, $_POST['question_text']);
    $question_type  = mysqli_real_escape_string($con, $_POST['question_type']);
    $options        = mysqli_real_escape_string($con, $_POST['options'] ?? '');
    $correct_answer = mysqli_real_escape_string($con, $_POST['correct_answer']);

    $sql = "UPDATE questions_tbl SET question_text='$question_text', question_type='$question_type', options='$options', correct_answer='$correct_answer' WHERE question_id=$question_id";
    if (mysqli_query($con, $sql)) {
        header("Location: ../quiz_creation.php?module_id=$module_id&success=Question updated successfully");
    } else {
        header("Location: ../quiz_creation.php?module_id=$module_id&error=Error updating question");
    }
}

// Delete a quiz question
if (isset($_POST['delete_question'])) {
    $question_id = (int)$_POST['question_id'];
    $module_id   = (int)$_POST['module_id'];

    $sql = "DELETE FROM questions_tbl WHERE question_id=$question_id";
    if (mysqli_query($con, $sql)) {
        header("Location: ../quiz_creation.php?module_id=$module_id&success=Question deleted successfully");
    } else {
        header("Location: ../quiz_creation.php?module_id=$module_id&error=Error deleting question");
    }
}

// Archive a student
if (isset($_POST['archiveStudent'])) {
    $member_id = (int)$_POST['member_id'];
    mysqli_query($con, "UPDATE members_tbl SET archived=1 WHERE member_id=$member_id");
    header("Location: ../users_view.php");
}

// Restore an archived student
if (isset($_POST['restoreStudent'])) {
    $member_id = (int)$_POST['member_id'];
    mysqli_query($con, "UPDATE members_tbl SET archived=0 WHERE member_id=$member_id");
    header("Location: ../archived_users_view.php");
}

?>
