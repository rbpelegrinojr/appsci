<?php include 'header.php'; ?>
<!-- Page Header -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Assessment Form</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Assessment Form</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Registration Form -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Assessment Form</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
					<form action="controller/process.php" method="post">
	                    <!-- Name -->
	                    <input type="hidden" name="user_id" value="<?php echo $member_id; ?>">
	                    <div class="form-floating mb-3" style="display: none;">
	                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
	                        <label for="name">Enter Name</label>
	                    </div>

	                    <!-- Education -->
	                    <div class="form-floating mb-3">
	                        <select class="form-select" id="education" name="education" required>
	                        	<option value="">-Please Select-</option>
	                            <option value="70">Bachelor's (70)</option>
	                            <option value="85">Master's (85)</option>
	                            <option value="100">Doctorate (100)</option>
	                        </select>
	                        <label for="education">Education Level</label>
	                    </div>

	                    <!-- Experience -->
	                    <div class="form-floating mb-3">
	                        <select class="form-select" id="experience" name="experience" required>
	                        	<option value="">-Please Select-</option>
	                            <option value="50">0-2 years (50)</option>
	                            <option value="70">3-5 years (70)</option>
	                            <option value="90">6-10 years (90)</option>
	                            <option value="100">10+ years (100)</option>
	                        </select>
	                        <label for="experience">Work Experience</label>
	                    </div>

	                    <!-- Certifications -->
	                    <div class="form-floating mb-3">
	                        <select class="form-select" id="certifications" name="certifications" required>
	                        	<option value="">-Please Select-</option>
	                            <option value="0">No Certification (0)</option>
	                            <option value="15">General Certification (15)</option>
	                            <option value="30">Job-Specific Certification (30)</option>
	                        </select>
	                        <label for="certifications">Certifications</label>
	                    </div>

	                    <!-- Interview Score -->
	                    <div class="form-floating mb-3">
	                        <input type="number" class="form-control" id="interview" name="interview" placeholder="Interview Score (0-100)" required>
	                        <label for="interview">Interview Score (0-100)</label>
	                    </div>

	                    <!-- Test Score -->
	                    <div class="form-floating mb-3" style="display: none;">
	                        <input type="number" min="1" max="100" maxlength="3" class="form-control" id="test_score" name="test_score" placeholder="Test Score (0-100)" >
	                        <label for="test_score">Test Score (0-100)</label>
	                    </div>

	                    <!-- Submit Button -->
	                    <div class="text-center">
	                        <button type="submit" name="btnSubmitAssessment" class="btn btn-primary w-100">Submit</button>
	                    </div>
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
