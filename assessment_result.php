<?php
include 'header.php';
$score = isset($_GET['score']) ? intval($_GET['score']) : 0;
$total = isset($_GET['total']) ? intval($_GET['total']) : 0;
?>
<div class="container mt-5">
    <div class="alert alert-info text-center">
        <h3>Assessment Result</h3>
        <p>Your score: <strong><?php echo $score; ?></strong> out of <strong><?php echo $total; ?></strong></p>
    </div>
</div>
<?php include 'footer.php'; ?>