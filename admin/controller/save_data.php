<?php
include '../../include/db.php'; 

if (isset($_REQUEST['btnAddModule'])) {
    $module_name = mysqli_real_escape_string($con, $_POST['module_name']);
    $quarter = mysqli_real_escape_string($con, $_POST['quarter']);

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

            $sql = "INSERT INTO modules_tbl (module_name, quarter, module_file_url)
                    VALUES ('$module_name', '$quarter', '$fileURL')";
            if (mysqli_query($con, $sql)) {
                header("Location: ../module_list.php?success=1");
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
    $module_id = $_POST['module_id'];
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

?>
