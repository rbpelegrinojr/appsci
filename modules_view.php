<?php include 'header.php';
$quarter = $_REQUEST['quarter'];
?>
        <!-- Carousel Start -->
        
        <!-- Carousel End -->

        <?php
        $query = mysqli_query($con, "SELECT * FROM modules_tbl WHERE quarter = '$quarter' ORDER BY uploaded_at DESC");

			?>

        
        <!-- Jobs Start -->
		<div class="container-xxl py-5">
		    <div class="container">
		        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Modules</h1>
		        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
		            <div class="tab-content">
		                <div id="tab-1" class="tab-pane fade show p-0 active">
		                    <?php
							if (mysqli_num_rows($query) > 0) {
							    while ($row = mysqli_fetch_assoc($query)) {
							?>
							<div class="job-item p-4 mb-4">
							    <div class="row g-4">
							        <div class="col-sm-12 col-md-8 d-flex align-items-center">
							            <img class="flex-shrink-0 img-fluid border rounded" src="images/deped.png" alt="" style="width: 80px; height: 80px;">
							            <div class="text-start ps-4">
							                <h5 class="mb-3"><?php echo htmlspecialchars($row['module_name']); ?></h5>
							                <p class="mb-1"><strong>Quarter:</strong> <?php echo htmlspecialchars($row['quarter']); ?></p>
							                <p class="mb-1"><strong>Uploaded:</strong> <?php echo date('F d, Y h:i A', strtotime($row['uploaded_at'])); ?></p>
							            </div>
							        </div>
							        <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
							            <div class="d-flex mb-3">
							                <a class="btn btn-primary" href="module_content.php?m_id=<?php echo $row['module_id']; ?>&file=<?php echo urlencode($row['module_file_url']); ?>">View</a>
							                <?php
							                if (empty($member_id)) {
							                	
							                }else{
							                	?>
							                	<?php
							                	$rQ = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM questions_tbl WHERE module_id = '{$row['module_id']}'"));


							                	
							                	$rMF = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM answers_tbl WHERE question_id = '{$rQ['question_id']}'"));

							                	if (empty($rMF['question_id'])) {
							                		
							                	}else{
							                		?>
							                		<a href="javascript:void(0);" class="btn btn-outline-secondary ms-2" data-bs-toggle="modal" data-bs-target="#feedbackModal" onclick="setModuleId('<?php echo $row['module_id']; ?>')">Feedback</a>
							                		
							                		<?php
							                	}
							                	?>
							                	<?php
							                }
							                ?>
							            </div>
							        </div>
							    </div>
							</div>
							<?php
							    }
							} else {
							?>
							    <br>
							    <center><div class="alert alert-danger"><label>No Modules Available</label></div></center>
							<?php
							}
							?>
		                    <!-- <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a> -->
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- Jobs End -->
<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="submit_feedback.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="feedbackModalLabel">Submit Feedback</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
        <div class="modal-body">
          <input type="hidden" name="module_id" id="feedback_module_id">
          <div class="mb-3">
            <label for="feedback_text" class="form-label">Your Feedback</label>
            <textarea class="form-control" name="feedback_text" id="feedback_text" rows="4" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
function setModuleId(moduleId) {
    document.getElementById('feedback_module_id').value = moduleId;
}
</script>

<?php include 'footer.php'; ?>