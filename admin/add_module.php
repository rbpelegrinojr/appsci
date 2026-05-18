<?php include 'header.php'; ?>

<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                    <div class="page_title_left d-flex align-items-center">
                        <h3 class="f_s_25 f_w_700 dark_text mr_30">Add Module</h3>
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
                            <div class="mb-3">
                                <label class="form-label">Module Name</label>
                                <input type="text" class="form-control" name="module_name" required>
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
                                <label class="form-label">School Year</label>
                                <input type="text" class="form-control" name="school_year" placeholder="e.g. 2024-2025" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload Module File</label>
                                <input type="file" class="form-control" name="module_file" required>
                            </div>

                            <a href="module_list.php" class="btn btn-secondary">Cancel</a>
                            <button type="submit" name="btnAddModule" class="btn btn-primary">Add Module</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
