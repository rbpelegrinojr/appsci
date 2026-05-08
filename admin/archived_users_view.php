<?php include 'header.php'; ?>
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left d-flex align-items-center">
                        <h3 class="f_s_25 f_w_700 dark_text mr_30">Archived Students</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="users_view.php">Students</a></li>
                            <li class="breadcrumb-item active">Archived</li>
                        </ol>
                    </div>
                    <div class="page_title_right d-flex align-items-center" style="gap:10px;">
                        <a href="users_view.php" class="btn btn-secondary btn-sm">Back to Active Students</a>
                        <div class="page_date_button d-flex align-items-center">
                            <img src="img/icon/calender_icon.svg" alt="">
                            <?php echo date('F j, Y', strtotime(date('Y-m-d'))); ?>
                        </div>
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
                    <div class="box_header m-0 d-flex align-items-center justify-content-between">
                        <div class="main-title">
                            <h3 class="m-0">Archived Students</h3>
                        </div>
                        <div class="d-flex align-items-center" style="gap:10px;">
                            <label class="mb-0"><strong>Filter by School Year:</strong></label>
                            <select id="schoolYearFilter" class="form-control form-control-sm" style="width:160px;">
                                <option value="">All</option>
                                <?php
                                $syRes = mysqli_query($con, "SELECT DISTINCT school_year FROM members_tbl WHERE archived = 1 AND school_year IS NOT NULL AND school_year != '' ORDER BY school_year DESC");
                                while ($syRow = mysqli_fetch_assoc($syRes)) {
                                    echo '<option value="' . htmlspecialchars($syRow['school_year']) . '">' . htmlspecialchars($syRow['school_year']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Grade</th>
                                    <th>Section</th>
                                    <th>School Year</th>
                                    <th>Total Score</th>
                                    <th>Assessments</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($con, "
                                    SELECT m.*,
                                        (SELECT COUNT(*) FROM answers_tbl a WHERE a.member_id = m.member_id AND a.is_correct = 1) AS total_score
                                    FROM members_tbl m
                                    WHERE m.archived = 1
                                    ORDER BY m.lname ASC
                                ");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                    <tr data-school-year="<?php echo htmlspecialchars($row['school_year'] ?? ''); ?>">
                                        <td><?php echo htmlspecialchars($row['lname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['fname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['mname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['grade']); ?></td>
                                        <td><?php echo htmlspecialchars($row['section']); ?></td>
                                        <td><?php echo htmlspecialchars($row['school_year'] ?? ''); ?></td>
                                        <td><?php echo (int)$row['total_score']; ?></td>
                                        <td><a href="student_assessments_view.php?member_id=<?php echo $row['member_id']; ?>">View</a></td>
                                        <td>
                                            <form method="POST" action="controller/save_data.php" onsubmit="return confirm('Restore this student?');">
                                                <input type="hidden" name="member_id" value="<?php echo $row['member_id']; ?>">
                                                <button type="submit" name="restoreStudent" class="btn btn-success btn-sm">Restore</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <script type="text/javascript">
        var dataTable;
        $(document).ready(function () {
            dataTable = $('#myTable').DataTable();

            $('#schoolYearFilter').on('change', function () {
                var val = $(this).val();
                dataTable.rows().every(function () {
                    var rowNode = this.node();
                    var rowSY = $(rowNode).data('school-year') || '';
                    if (val === '' || rowSY === val) {
                        $(rowNode).show();
                    } else {
                        $(rowNode).hide();
                    }
                });
            });
        });
    </script>
<?php include 'footer.php'; ?>
