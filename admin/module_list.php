<?php include 'header.php'; ?>
<?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">Module added successfully!</div>
<?php } elseif (isset($_GET['error'])) { ?>
    <div class="alert alert-danger">Error adding module. Please try again.</div>
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
                        <button id="openAddModuleModal" class="btn btn-primary" type="button">Add Module</button>
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
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Available Modules</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Module Name</th>
                                        <th>Quarter</th>
                                        <th>Section</th>
                                        <th>Module File</th>
                                        <th>Uploaded At</th>
                                        <th>Assessment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM modules_tbl ORDER BY section ASC, quarter ASC, uploaded_at DESC");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['module_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['quarter']); ?></td>
                                            <td><?php echo htmlspecialchars((isset($row['section']) && trim((string)$row['section']) !== '') ? $row['section'] : 'Unassigned'); ?></td>
                                            <td><a href="<?php echo htmlspecialchars($row['module_file_url']); ?>" target="_blank">View File</a></td>
                                            <td><?php echo $row['uploaded_at']; ?></td>
                                            <td>
                                                <a href="quiz_creation.php?module_id=<?php echo $row['module_id']; ?>" class="btn btn-success">Create Quiz</a>
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

<!-- Add Module Modal -->
<div class="modal fade" id="addModuleModal" tabindex="-1" aria-labelledby="addModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="controller/save_data.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModuleModalLabel">Add Module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Module Name</label>
                        <input type="text" class="form-control" name="module_name" maxlength="255" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quarter</label>
                        <select class="form-control" name="quarter" required>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="3rd">3rd</option>
                            <option value="4th">4th</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <input type="text" class="form-control" name="section" placeholder="e.g. Section A" maxlength="100" pattern="\S+(\s+\S+)*" title="Section cannot be empty or contain only whitespace" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Module File (PDF, DOCX, etc.)</label>
                        <input type="file" class="form-control" name="module_file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="btnAddModule" class="btn btn-primary">Add Module</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        var table = $('#myTable').DataTable({
            order: [[2, 'asc'], [1, 'asc']]
        });

        table.on('draw', function () {
            var rows = table.rows({ page: 'current' }).nodes();
            var columnCount = table.columns().count();
            var last = null;

            table.column(2, { page: 'current' }).data().each(function (section, i) {
                var escapedSectionLabel = $('<div>').text(section || 'Unassigned').html();
                if (last !== section) {
                    $(rows).eq(i).before(
                        '<tr class="table-light section-group-row"><td colspan="' + columnCount + '"><strong>Section: ' + escapedSectionLabel + '</strong></td></tr>'
                    );
                    last = section;
                }
            });
        });

        table.draw();

        $('#openAddModuleModal').on('click', function (e) {
            e.preventDefault();
            bootstrap.Modal.getOrCreateInstance(document.getElementById('addModuleModal')).show();
        });
    });
</script>

<?php include 'footer.php'; ?>
