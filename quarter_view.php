<?php include 'header.php'; ?>
 
        <!-- Jobs Start -->
		<div class="container-xxl py-5">
		    <div class="container">
		        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Quarters</h1>
		        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
		            <div class="tab-content">
		                <div id="tab-1" class="tab-pane fade show p-0 active">
		                    
		                	<center>
		                		<div class="job-item p-4 mb-4 col-md-6">
								    <div class="row g-4">
								        <div class="">
								            <div class="">
								                <h2><a class="btn btn-primary" href="modules_view.php?quarter=1st">Quarter 1</a></h2>
								            </div>
								        </div>
								    </div>
								</div>
		                		<div class="job-item p-4 mb-4 col-md-6">
								    <div class="row g-4">
								        <div class="">
								            <div class="">
								                <h2><a class="btn btn-primary" href="modules_view.php?quarter=2nd">Quarter 2</a></h2>
								            </div>
								        </div>
								    </div>
								</div>
		                		<div class="job-item p-4 mb-4 col-md-6">
								    <div class="row g-4">
								        <div class="">
								            <div class="">
								                <h2><a class="btn btn-primary" href="modules_view.php?quarter=3rd">Quarter 3</a></h2>
								            </div>
								        </div>
								    </div>
								</div>
		                		<div class="job-item p-4 mb-4 col-md-6">
								    <div class="row g-4">
								        <div class="">
								            <div class="">
								                <h2><a class="btn btn-primary" href="modules_view.php?quarter=4th">Quarter 4</a></h2>
								            </div>
								        </div>
								    </div>
								</div>
		                	</center>

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