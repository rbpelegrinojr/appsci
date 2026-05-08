<?php include 'header.php'; ?>
<div class="main_content_iner overly_inner">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left d-flex align-items-center">
                        <h3 class="f_s_25 f_w_700 dark_text mr_30">Applications Reports</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Applications Reports</li>
                        </ol>
                    </div>
                    <div class="page_title_right">
                        <div class="page_date_button d-flex align-items-center">
                            <img src="img/icon/calender_icon.svg" alt="">
                            <?php echo date('F j, Y'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter for month and year -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="filter-month">Filter by Month:</label>
                <input type="month" id="filter-month" class="form-control" value="<?php echo isset($_GET['month']) ? $_GET['month'] : ''; ?>">
            </div>
            <div class="col-md-3">
                <label for="filter-year">Filter by Year:</label>
                <input type="number" id="filter-year" class="form-control" min="2000" max="2099" step="1" value="<?php echo isset($_GET['year']) ? $_GET['year'] : date('Y'); ?>">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button id="filter-btn" class="btn btn-primary">Apply Filter</button>
                <a href="application_records_view.php" class="btn btn-secondary ml-2">Show All</a>
                <button onclick="printTable()" class="btn btn-info "> Print</button>
            </div>
        </div>

        <div class="row">
            <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css">
            <script type="text/javascript" src="DataTables/datatables.min.js"></script>

            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">List of All Applications Reports</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Applicant No.</th>
                                        <th>Applicant Name</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Job Title</th>
                                        <th>Cover Letter</th>
                                        <th>Date Uploaded</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="applications-tbody">
                                    <?php
                                    // Get the filter values from the URL
										$month = isset($_GET['month']) ? $_GET['month'] : '';
										$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

										// Build the SQL query with the filters
										$whereClauses = [];
										if ($month) {
										    $whereClauses[] = "DATE_FORMAT(r.date_uploaded, '%Y-%m') = '$month'";
										}
										if ($year) {
										    $whereClauses[] = "YEAR(r.date_uploaded) = '$year'";
										}

										// If no filters are applied, we fetch all records
										$whereSql = count($whereClauses) ? 'WHERE ' . implode(' AND ', $whereClauses) : '';


                                    // Query the database with the filters applied
                                    $query = mysqli_query($con, 
                                         "SELECT r.requirement_id, r.applicant_status, r.requirement_id, m.fname, m.mname, m.lname, m.contact_no, m.email, 
                                                j.job_name, r.application_letter, r.tor, r.resume, r.diploma, r.cover_letter, r.date_uploaded
                                          FROM requirements_tbl r
                                          JOIN members_tbl m ON r.member_id = m.member_id
                                          JOIN jobs_tbl j ON r.job_id = j.job_id
                                          $whereSql"
                                    );

                                    $statusMap = [
                                        0 => 'Pending',
                                        1 => 'Approved',
                                        2 => 'Completed',
                                        3 => 'Cancelled'
                                    ];

                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $statusText = isset($statusMap[$row['applicant_status']]) ? $statusMap[$row['applicant_status']] : 'Unknown';
                                        ?>
                                        <tr>
                                            <td><?php echo "OJHS00".$row['requirement_id']; ?></td>
                                            <td><?php echo $row['lname'] . ' ' . $row['mname'] . ' ' . $row['fname']; ?></td>
                                            <td><?php echo $row['contact_no']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['job_name']; ?></td>
                                            <td><?php echo $row['cover_letter']; ?></td>
                                            <td><?php echo $row['date_uploaded']; ?></td>
                                            <td><span class="badge <?php 
                                                echo $row['applicant_status'] == 0 ? 'bg-warning' :
                                                     ($row['applicant_status'] == 1 ? 'bg-success' :
                                                      ($row['applicant_status'] == 2 ? 'bg-primary' : 'bg-danger'));
                                            ?>"><?php echo $statusText; ?></span></td>
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
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();

        // Filter button click event
        $('#filter-btn').on('click', function() {
            var month = $('#filter-month').val();
            var year = $('#filter-year').val();

            // Construct the URL with query parameters for filtering
            var filterUrl = 'application_records_view.php?month=' + month + '&year=' + year;

            // Reload the page with filters
            window.location.href = filterUrl;
        });
    });
</script>
<script type="text/javascript">
    function printTable() {
        var table = document.getElementById("myTable").outerHTML;
        var style = `<style>
                        table { width: 100%; border-collapse: collapse; }
                        table, th, td { border: 1px solid black; padding: 8px; }
                        th { background-color: #f2f2f2; }
                        body { font-family: Arial, sans-serif; margin: 20px; }
                    </style>`;
        var newWin = window.open("");
        newWin.document.write("<html><head><title>Print Table</title>");
        newWin.document.write(style);
        newWin.document.write("</head><body>");
        newWin.document.write("<h3>Applications Reports</h3>");
        newWin.document.write(table);
        newWin.document.write("</body></html>");
        newWin.document.close();
        newWin.focus();
        newWin.print();
        newWin.close();
    }
</script>

<?php include 'footer.php'; ?>
