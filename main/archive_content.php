<?php include 'header.php'; ?>
<?php
$resResearch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_tbl WHERE research_id = '{$_REQUEST['a_id']}'"));
$archive_research_id = $resResearch['research_id'];
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
					<a href="archives.php">
						Archives
					</a>
					<span class="separator">/</span>
				</li>
				<li class="current" aria-current="page">
					<span aria-current="page"><?php echo $resResearch['research_title'].': '.date('d F, (Y)', strtotime($resResearch['research_created'])); ?></span>
				</li>
			</ol>
		</nav>
		<h1><?php echo $resResearch['research_title'].': '.date('d F, (Y)', strtotime($resResearch['research_created'])); ?></h1>

		<div class="obj_issue_toc">
			<div class="heading">
				<div class="description">
					<?php echo $resResearch['research_description']; ?>
				</div>

				<div class="published">
					<span class="label">Published:</span>
					<span class="value"><?php echo $resResearch['research_created']; ?></span>
				</div>
				<ul class="galleys_links">
					<li>
						<?php
						if (empty($resResearch['research_file'])) {
							?>
							<button class="obj_galley_link pdf" disabled="">PDF Not Available</button>
							
							<?php
						}else{
							?>
							<a class="obj_galley_link pdf" href="<?php echo $resResearch['research_file']; ?>" aria-labelledby="article-687">PDF</a>
							<?php
						}
						?>
					</li>
				</ul>
			</div>

			<div class="sections">
				<div class="section"><h2>Research Chapters</h2>
					<ul class="cmp_article_list articles">

						<?php
						$query = mysqli_query($con, "SELECT * FROM research_chapters_tbl WHERE research_id = '$archive_research_id'");
						if ($rows = mysqli_num_rows($query) > 0) {
							# code...
						}else{
							?>
							<center><div class="alert alert-warning">No Chapters Available</div></center>
							<?php
						}
						while ($row = mysqli_fetch_assoc($query)) {
							?>
							<li>
								<div class="obj_article_summary">
									<h3 class="title">
										<a id="article-687" href="chapters_view.php?c_id=<?php echo $row['research_chapter_id']; ?>"><?php echo $row['chapter_title']; ?></a>
									</h3>

									<div class="meta">
										<div class="authors">
											<?php
											$qM = mysqli_query($con, "SELECT * FROM research_chapter_authors_tbl WHERE research_chapter_id = '{$row['research_chapter_id']}'");
											while ($rM = mysqli_fetch_assoc($qM)) {
												$rMem = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE member_id = '{$rM['member_id']}'"));
												echo $rMem['fname'].' '.$rMem['lname'].', ';
											}
											?>
										</div>
										<!-- <div class="pages">1-11</div> -->
									</div>
									<ul class="galleys_links">
										<li>
											<?php
											if (empty($row['chapter_file'])) {
												?>
												<button class="obj_galley_link pdf" disabled="">PDF Not Available</button>
												
												<?php
											}else{
												?>
												<a class="obj_galley_link pdf" href="<?php echo $row['chapter_file']; ?>" aria-labelledby="article-687">PDF</a>
												<?php
											}
											?>
										</li>
									</ul>
								</div>
							</li>
							<?php
						}
						?>

						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>