<?php include 'header.php'; ?>
<div class="pkp_structure_main" role="main">
				<a id="pkp_content_main"></a>

	
<div class="page page_search">

	<nav class="cmp_breadcrumbs" role="navigation" aria-label="You are here:">
	<ol>
		<li>
			<a href="index.php">
				Home
			</a>
			<span class="separator">/</span>
		</li>
		<li class="current">
			<span aria-current="page">Search</span>
		</li>
	</ol>
</nav>

	<h1>
		Search
	</h1>

	<form class="cmp_form" method="POST" action="search_view.php">

		<div class="search_input">
			<label class="pkp_screen_reader" for="query">
				Search articles for
			</label>
			
				<!-- <input type="text" id="query" name="query" value="" class="query" placeholder="Search"> -->
			
		</div>

		<fieldset class="search_advanced">
			<legend>
				Advanced filters
			</legend>
			
			<div class="">
				<label class="label" for="job_name">
					By Keyword
				</label>
				
					<input type="text" id="job_name" name="job_name" value="<?php if(isset($_REQUEST['btnSearch'])){ echo $_REQUEST['job_name']; }else{} ?>">
				
			</div>
			
		</fieldset>

		<div class="submit">
			<button class="submit" name="btnSearch" type="submit">Search</button>
		</div>
	</form>

	

	<h2 class="pkp_screen_reader">Search Results</h2>

	<?php
	if (isset($_REQUEST['btnSearch'])) {
		
		// $dateFromMonth = $_REQUEST['dateFromMonth'];
		$job_name = $_REQUEST['job_name'];

		$query = mysqli_query($con, "SELECT * FROM jobs_tbl WHERE job_name LIKE '%$job_name%' OR job_summary LIKE '%$job_name%'");

		if ($rows = mysqli_num_rows($query) > 0) {
				?>
				<ul class="search_results">
			<?php
			while ($row = mysqli_fetch_assoc($query)) {
				?>
				<li>
					<div class="obj_issue_summary">
						<h2>
							<a class="title" href="archive_content.php?a_id=<?php echo $row['job_id']; ?>"><?php echo $row['job_name']; ?></a>
							
							<div class="series">
								<?php echo $row['date_posted']; ?>
							</div>
						</h2>
						<br>
						<div class="description">

							<?php echo implode(' ', array_slice(explode(' ', $row['job_summary']), 0, 50)).'.....';?>
						</div>
					</div>
				</li>
				<?php
			}
			?>
		</ul>
				<?php
			}else{
				?>
				<span role="status">
					<div class="cmp_notification notice">No Results</div>
				</span>
				<?php
			}


	}
	?>		
		

				<!-- <span role="status">
							<div class="cmp_notification notice">
			No Results
	</div>
					</span> -->

		
		
</div><!-- .page -->

	</div>

	<?php include 'footer.php'; ?>