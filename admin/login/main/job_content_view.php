<?php include 'header.php'; ?>
<?php
$resJob = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM jobs_tbl WHERE job_id = '{$_REQUEST['j_id']}'"));
$job_id = $resJob['job_id'];
?>
<div class="pkp_structure_main" role="main">
	<a id="pkp_content_main"></a>

	<div class="page page_issue">
		<nav class="cmp_breadcrumbs" role="navigation" aria-label="You are here:">
			<ol>
				<li>
					<a href="index.php">Home</a>
					<span class="separator">/</span>
				</li>
				<li>
					<a href="#">
						Listing
					</a>
					<span class="separator">/</span>
				</li>
				<li class="current" aria-current="page">
					<span aria-current="page"><?php echo $resJob['job_name'].': '.date('d F, (Y)', strtotime($resJob['date_posted'])); ?></span>
				</li>
			</ol>
		</nav>
		<div id="homepageImage">
					<img src="../images/banner.png" alt="Journal Homepage Image" width="158" height="106" />
				</div>
		<h1><?php echo $resJob['job_name']; ?></h1>

		<div class="obj_issue_toc">
			<div class="heading">
				<div class="description">
					<?php echo $resJob['job_summary']; ?>
				</div>
				<div class="published">
					<span class="label">Position:</span>
					<span class="value"><?php echo $resJob['position']; ?></span>
				</div>
				<div class="published">
					<span class="label">Salary:</span>
					<span class="value"><?php echo $resJob['salary']; ?></span>
				</div>
				<div class="published">
					<span class="label">Educational Qualification:</span>
					<span class="value"><?php echo $resJob['educational_qualification']; ?></span>
				</div>
				<div class="published">
					<span class="label">Eligibility:</span>
					<span class="value"><?php echo $resJob['eligibility']; ?></span>
				</div>
				<div class="published">
					<span class="label">Plantilla:</span>
					<span class="value"><?php echo $resJob['plantilla_item']; ?></span>
				</div>
				<div class="published">
					<span class="label">Experience:</span>
					<span class="value"><?php echo $resJob['experience']; ?></span>
				</div>
				<div class="published">
					<span class="label">Trainings:</span>
					<span class="value"><?php echo $resJob['training']; ?></span>
				</div>
				<div class="published">
					<span class="label">Competencies:</span>
					<span class="value"><?php echo $resJob['competencies']; ?></span>
				</div>
				<div class="published">
					<span class="label">Duties Responsibilities:</span>
					<span class="value"><?php echo $resJob['duties_responsibilities']; ?></span>
				</div>
				<div class="published">
					<span class="label">Deadline of Submission:</span>
					<span class="value" style="color: green;"><b><?php echo $resJob['sub_deadline']; ?></b></span>
				</div>
				<ul class="galleys_links">
					<li>
						<a class="obj_galley_link login" href="apply_form_view.php?j_d=<?php echo $resJob['job_id']; ?>" aria-labelledby="article-687">APPLY NOW</a>
					</li>
				</ul>
			</div>

			<div class="sections">
				<div class="section">
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>