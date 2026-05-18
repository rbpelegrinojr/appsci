<?php
include 'header.php';

if (!isset($_GET['module_id'])) {
    echo "<div class='alert alert-danger'>Missing module ID.</div>";
    include 'footer.php';
    exit();
}

$module_id = (int)$_GET['module_id'];
$stmt = mysqli_prepare($con, "SELECT * FROM modules_tbl WHERE module_id = ?");
if (!$stmt) {
    echo "<div class='alert alert-danger'>Unable to load module details.</div>";
    include 'footer.php';
    exit();
}
mysqli_stmt_bind_param($stmt, "i", $module_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$module = null;
if ($result) {
    $module = mysqli_fetch_assoc($result);
}
mysqli_stmt_close($stmt);

if (!$module) {
    echo "<div class='alert alert-danger'>Module not found.</div>";
    include 'footer.php';
    exit();
}
?>

<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left d-flex align-items-center">
                        <h3 class="f_s_25 f_w_700 dark_text mr_30">Edit Module</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="module_list.php">Modules</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Module Details</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <form action="controller/save_data.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="module_id" value="<?php echo (int)$module['module_id']; ?>">

                            <div class="mb-3">
                                <label class="form-label">Module Name</label>
                                <input type="text" class="form-control" name="module_name" value="<?php echo htmlspecialchars($module['module_name'], ENT_QUOTES); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quarter</label>
                                <select class="form-control" name="quarter" required>
                                    <option value="1st" <?php echo $module['quarter'] === '1st' ? 'selected' : ''; ?>>1st</option>
                                    <option value="2nd" <?php echo $module['quarter'] === '2nd' ? 'selected' : ''; ?>>2nd</option>
                                    <option value="3rd" <?php echo $module['quarter'] === '3rd' ? 'selected' : ''; ?>>3rd</option>
                                    <option value="4th" <?php echo $module['quarter'] === '4th' ? 'selected' : ''; ?>>4th</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">School Year</label>
                                <input type="text" class="form-control" name="school_year" value="<?php echo htmlspecialchars($module['school_year'], ENT_QUOTES); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Current File</label>
                                <div>
                                    <a href="<?php echo htmlspecialchars($module['module_file_url'], ENT_QUOTES); ?>" target="_blank">View Current File</a>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Change File (optional)</label>
                                <input type="file" class="form-control" name="module_file">
                                <small class="text-muted">Leave this empty if you do not want to change the file.</small>
                            </div>

                            <a href="module_list.php" class="btn btn-secondary">Cancel</a>
                            <button type="submit" name="btnUpdateModule" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
