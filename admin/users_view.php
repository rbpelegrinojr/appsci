<?php include 'header.php'; ?>
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left d-flex align-items-center">
                        <h3 class="f_s_25 f_w_700 dark_text mr_30">Students</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        </ol>
                    </div>
                    <div class="page_title_right d-flex align-items-center" style="gap:10px;">
                        <a href="archived_users_view.php" class="btn btn-secondary btn-sm">View Archived Students</a>
                        <div class="page_date_button d-flex align-items-center">
                            <img src="img/icon/calender_icon.svg" alt="">
                            <?php echo date('F j, Y', strtotime(date('Y-m-d'))); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row "> <!-- Header -->

        <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css">
        <script type="text/javascript" src="DataTables/datatables.min.js"></script>

        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0 d-flex align-items-center justify-content-between">
                        <div class="main-title">
                            <h3 class="m-0">Students</h3>
                        </div>
                        <div class="d-flex align-items-center" style="gap:10px;">
                            <label class="mb-0"><strong>Filter by Section:</strong></label>
                            <select id="sectionFilter" class="form-control form-control-sm" style="width:160px;">
                                <option value="">All</option>
                                <?php
                                $secRes = mysqli_query($con, "SELECT DISTINCT section FROM members_tbl WHERE archived = 0 AND section IS NOT NULL AND section != '' ORDER BY section ASC");
                                while ($secRow = mysqli_fetch_assoc($secRes)) {
                                    echo '<option value="' . htmlspecialchars($secRow['section']) . '">' . htmlspecialchars($secRow['section']) . '</option>';
                                }
                                ?>
                            </select>
                            <label class="mb-0"><strong>Filter by School Year:</strong></label>
                            <select id="schoolYearFilter" class="form-control form-control-sm" style="width:160px;">
                                <option value="">All</option>
                                <?php
                                $syRes = mysqli_query($con, "SELECT DISTINCT school_year FROM members_tbl WHERE archived = 0 AND school_year IS NOT NULL AND school_year != '' ORDER BY school_year DESC");
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
                                    WHERE m.archived = 0
                                    ORDER BY m.section ASC, m.lname ASC, m.fname ASC
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
                                            <form method="POST" action="controller/save_data.php" onsubmit="return confirm('Archive this student?');">
                                                <input type="hidden" name="member_id" value="<?php echo $row['member_id']; ?>">
                                                <button type="submit" name="archiveStudent" class="btn btn-warning btn-sm">Archive</button>
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
        var selectedSchoolYear = '';
        var selectedSection = '';

        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            if (selectedSchoolYear && data[5] !== selectedSchoolYear) return false;
            if (selectedSection) {
                // Section is column index 4; compare display label
                var sectionVal = (data[4] && data[4].trim() !== '') ? data[4].trim() : 'Unassigned';
                if (sectionVal !== selectedSection) return false;
            }
            return true;
        });

        $(document).ready(function () {
            var dataTable = $('#myTable').DataTable({
                order: [[4, 'asc'], [0, 'asc'], [1, 'asc']]
            });

            dataTable.on('draw', function () {
                var rows = dataTable.rows({ page: 'current' }).nodes();
                var columnCount = dataTable.columns().count();
                var last = null;

                dataTable.column(4, { page: 'current' }).data().each(function (section, i) {
                    var sectionLabel = (section && section.trim() !== '') ? section : 'Unassigned';
                    var escapedSectionLabel = $('<div>').text(sectionLabel).html();
                    if (last !== sectionLabel) {
                        $(rows).eq(i).before(
                            '<tr class="table-light section-group-row"><td colspan="' + columnCount + '"><strong>Section: ' + escapedSectionLabel + '</strong></td></tr>'
                        );
                        last = sectionLabel;
                    }
                });
            });

            dataTable.draw();

            $('#schoolYearFilter').on('change', function () {
                selectedSchoolYear = $(this).val();
                dataTable.draw();
            });

            $('#sectionFilter').on('change', function () {
                selectedSection = $(this).val();
                dataTable.draw();
            });
        });
    </script>
<?php include 'footer.php'; ?>
