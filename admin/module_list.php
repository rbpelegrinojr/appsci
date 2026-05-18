<?php include 'header.php'; ?>
<?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">Module added/updated successfully!</div>
<?php } elseif (isset($_GET['error'])) { ?>
    <div class="alert alert-danger">Error processing request. Please try again.</div>
<?php } ?>

<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left d-flex align-items-center">
                        <h3 class="f_s_25 f_w_700 dark_text mr_30">Module List</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        </ol>
                    </div>
                    <div class="page_title_right">
                        <a href="add_module.php" class="btn btn-primary">Add Module</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ">
            <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css">
            <script type="text/javascript" src="DataTables/datatables.min.js"></script>

            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0 d-flex justify-content-between align-items-center">
                            <div class="main-title">
                                <h3 class="m-0">Available Modules</h3>
                            </div>

                            <!-- 🔽 School Year Filter (NEW) -->
                            <div>
                                <label for="filterSchoolYear" class="form-label mb-0 me-2">School Year:</label>
                                <select id="filterSchoolYear" class="form-select form-select-sm d-inline-block" style="width:auto;">
                                    <option value="">All</option>
                                    <?php
                                    // Get distinct school years
                                    $syResult = mysqli_query($con, "SELECT DISTINCT school_year FROM modules_tbl ORDER BY school_year DESC");
                                    while ($syRow = mysqli_fetch_assoc($syResult)) {
                                        $sy = htmlspecialchars($syRow['school_year']);
                                        echo "<option value=\"{$sy}\">{$sy}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- 🔼 End School Year Filter -->
                        </div>
                    </div>

                    <div class="white_card_body">
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Module Name</th>
                                        <th>Quarter</th>
                                        <th>School Year</th>
                                        <th>Module File</th>
                                        <th>Uploaded At</th>
                                        <th>Assessment</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM modules_tbl ORDER BY uploaded_at DESC");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['module_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['quarter']); ?></td>
                                            <td><?php echo htmlspecialchars($row['school_year']); ?></td>
                                            <td><a href="<?php echo htmlspecialchars($row['module_file_url']); ?>" target="_blank">View File</a></td>
                                            <td><?php echo $row['uploaded_at']; ?></td>
                                            <td>
                                                <a href="quiz_creation.php?module_id=<?php echo $row['module_id']; ?>" class="btn btn-success btn-sm">Create Quiz</a>
                                            </td>
                                            <td>
                                                <a href="edit_module.php?module_id=<?php echo (int)$row['module_id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                                <!-- Delete Button -->
                                                <a href="controller/save_data.php?delete_module_id=<?php echo (int)$row['module_id']; ?>"
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Are you sure you want to delete this module?');">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        var table = $('#myTable').DataTable();

        // 🔽 Filter by School Year (column index 2)
        $('#filterSchoolYear').on('change', function () {
            var val = $(this).val();
            if (val) {
                // exact match search on School Year column (index 2)
                table.column(2).search('^' + val + '$', true, false).draw();
            } else {
                // clear filter
                table.column(2).search('').draw();
            }
        });
    });
</script>

<?php include 'footer.php'; ?>
