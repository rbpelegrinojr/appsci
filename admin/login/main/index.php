<?php include 'header.php'; ?>
<div class="pkp_structure_main" role="main">
	<a id="pkp_content_main"></a>

	<div class="page page_issue_archive">
		<nav class="cmp_breadcrumbs" role="navigation" aria-label="You are here:">
			<ol>
				<li>
					<a href="index.php">Home</a>
					<span class="separator">/</span>
				</li>
				<!-- <li class="current">
					<span aria-current="page">Latest Hirings</span>
				</li> -->
			</ol>
		</nav>
		<h1>Latest Hirings</h1>
		<ul class="issues_archive">

			<?php
			$query = mysqli_query($con, "SELECT * FROM jobs_tbl WHERE job_status = '1'");
			if ($rows = mysqli_num_rows($query) > 0) {
				# code...
			}else{
				?>
				<br>
				<center><div class="alert alert-danger"><label>No Data Available</label></div></center>
				<?php
			}
			while ($row = mysqli_fetch_assoc($query)) {
				//$rSeleG = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM selected_group_tbl WHERE selected_group_id = '{$row['selected_group_id']}'"));
				//$memQuery = mysqli_query($con, "SELECT * FROM members_tbl WHERE group_id = '{$rSeleG['group_id']}' AND school_batch = '{$rSeleG['batch_year']}'");
				?>
				<li>
					<div class="obj_issue_summary">
						<h2>
							<a class="title" href="job_content_view.php?j_id=<?php echo $row['job_id']; ?>"><?php echo $row['job_name']; ?></a>
							<div class="series">
								<?php
								// while ($memRes = mysqli_fetch_assoc($memQuery)) {
								// 	echo ucfirst($memRes['fname']).', '.ucfirst($memRes['lname']).', ';
								// }
								?>
							</div>
							<div class="series">
								<!-- Date Posted -->
								<?php echo date('d F, (Y)', strtotime($row['date_posted'])); ?>
							</div>
						</h2>
						<br>
						<div class="description">
							<!-- Description sang Job -->
							<?php echo implode(' ', array_slice(explode(' ', $row['job_summary']), 0, 20)).'.....';?>
						</div>
					</div>
				</li>
				<?php

			}
			?>

			

		</ul>
	</div>
</div>
<?php include 'footer.php'; ?>