<?php include 'header.php'; ?>
<?php
$resChap = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_chapters_tbl WHERE research_chapter_id = '{$_REQUEST['c_id']}'"));
$research_chapter_id = $resChap['research_chapter_id'];

$resResearch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM research_tbl WHERE research_id = '{$resChap['research_id']}'"));
?>
<div class="pkp_structure_main" role="main">
	<a id="pkp_content_main"></a>

	<div class="page page_article">
		<nav class="cmp_breadcrumbs" role="navigation" aria-label="You are here:">
			<ol>
				<li>
					<a href="index.php">
						Home
					</a>
					<span class="separator">/</span>
				</li>
				<li>
					<a href="archives.php">
						Archives
					</a>
					<span class="separator">/</span>
				</li>
				<li>
					<a href="archive_content.php?a_id=<?php echo $resResearch['research_id']; ?>"><?php echo  $resResearch['research_title']; ?></a><span class="separator">/</span>
				</li>
				<li class="current" aria-current="page">
					<span aria-current="page">Chapters</span>
				</li>
			</ol>
		</nav>

		<article class="obj_article_details">
			<h1 class="page_title"><?php echo 'Chapter '.$resChap['chapter_no'].' - '.$resChap['chapter_title']; ?></h1>

			<div class="row">
				<div class="main_entry">
					<section class="item authors">
						<h2 class="pkp_screen_reader">Authors</h2>
						<ul class="authors">
							<li>
								<span class="name">
									<?php
									$qM = mysqli_query($con, "SELECT * FROM research_chapter_authors_tbl WHERE research_chapter_id = '{$resChap['research_chapter_id']}'");
									while ($rM = mysqli_fetch_assoc($qM)) {
										$resMem = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE member_id = '{$rM['member_id']}'"));
										echo $resMem['fname'].' '.$resMem['lname'].', ';
									}
									?>
								</span>
							</li>
						</ul>
					</section>

					<section class="item abstract">
						<h2 class="label">Abstract</h2>
						<?php echo $resChap['chapter_abstract']; ?>
					</section>

				</div>

				<div class="entry_details">
					<div class="item galleys">
						<h2 class="pkp_screen_reader">Downloads</h2>

						<ul class="value galleys_links">
							<li>
								<?php
								if (empty($resChap['chapter_file'])) {
									?>
									<button class="obj_galley_link pdf" disabled="">PDF Not Available</button>
									
									<?php
								}else{
									?>
									<a class="obj_galley_link pdf" href="<?php echo $resChap['chapter_file']; ?>" aria-labelledby="article-687">PDF</a>
									<?php
								}
								?>
							</li>
						</ul>
					</div>

					<div class="item published">
						<section class="sub_item">
							<h2 class="label">Created</h2>

							<div class="value">
								<span><?php echo $resChap['chapter_created']; ?></span>
							</div>
						</section>
					</div>

					<div class="item issue">
						<section class="sub_item">
							<h2 class="label">Research</h2>
							<div class="value">
								<a class="title" href="archive_content.php?a_id=<?php echo $resResearch['research_id']; ?>"><?php echo  $resResearch['research_title']; ?></a>
							</div>
						</section>
					</div>
				</div>
			</div>
		</article>
	</div>
</div>
<?php include 'footer.php'; ?>