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
				<li class="current">
					<span aria-current="page">Archives</span>
				</li>
			</ol>
		</nav>
		<h1>Archives</h1>
		<ul class="issues_archive">

			<?php
			$query = mysqli_query($con, "SELECT * FROM archive_research_tbl WHERE archive_status = '1'");

			while ($row = mysqli_fetch_assoc($query)) {
				$memQuery = mysqli_query($con, "SELECT * FROM members_tbl WHERE group_id = '{$row['group_id']}'");
				?>
				<li>
					<div class="obj_issue_summary">
						<h2>
							<a class="title" href="archive_content.php?a_id=<?php echo $row['archive_research_id']; ?>"><?php echo $row['research_title']; ?></a>
							<div class="series">
								<?php
								while ($memRes = mysqli_fetch_assoc($memQuery)) {
									echo ucfirst($memRes['fname']).', '.ucfirst($memRes['lname']).', ';
								}
								?>
							</div>
							<div class="series">
								<?php echo $row['research_date_created']; ?>
							</div>
						</h2>
						<br>
						<div class="description">
							<?php echo $row['research_description']; ?>
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