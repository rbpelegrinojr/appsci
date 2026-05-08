<?php
include 'header.php';

if (isset($_GET['file'])) {
    $fileUrl = urldecode($_GET['file']);
    $fileExtension = strtolower(pathinfo($fileUrl, PATHINFO_EXTENSION));
} else {
    echo "<div class='alert alert-danger'>No file specified.</div>";
    exit();
}
?>

<div class="container mt-5">
    <h3>Embedded Module File</h3>

    <?php if ($fileExtension === 'pdf'): ?>
        <!-- Using object tag for PDF embedding -->
        <object data="<?php echo htmlspecialchars($fileUrl); ?>" type="application/pdf" width="100%" height="90vh">
            <p>Your browser does not support PDF viewing. <a href="<?php echo htmlspecialchars($fileUrl); ?>">Download the PDF</a>.</p>
        </object>

    <?php elseif ($fileExtension === 'docx'): ?>
        <!-- Mammoth.js for .docx files -->
        <div id="docx-viewer" style="display: none; border: 1px solid #ccc; padding: 20px; height: 90vh; overflow: auto;"></div>
        <script src="https://unpkg.com/mammoth/mammoth.browser.min.js"></script>
        <script>
            fetch("<?php echo htmlspecialchars($fileUrl); ?>")
                .then(response => response.arrayBuffer())
                .then(arrayBuffer => {
                    return mammoth.convertToHtml({ arrayBuffer: arrayBuffer });
                })
                .then(result => {
                    document.getElementById("docx-viewer").innerHTML = result.value;
                })
                .catch(error => {
                    document.getElementById("docx-viewer").innerHTML = "<div class='alert alert-danger'>Failed to load DOCX file.</div>";
                    console.error("Mammoth.js error:", error);
                });
        </script>

    <?php else: ?>
        <div class="alert alert-warning">File type not supported for embedding.</div>
    <?php endif; ?>

    <!-- Button for Assessment -->
    <div class="mt-4">
        <?php
        if (empty($member_id)) {
            ?>
            <a href="login_view.php" class="btn btn-primary btn-lg">Take Assessment</a>
            <?php
        }else{
            ?>
            <a href="assessment_page.php?m_id=<?php echo $_REQUEST['m_id']; ?>" class="btn btn-primary btn-lg">Take Assessment</a>
            <?php
        }
        ?>
       
    </div>
    <?php
// Ensure module_id is provided
$module_id = isset($_REQUEST['m_id']) ? intval($_REQUEST['m_id']) : 0;

if ($module_id > 0) {
    // Fetch feedback from the database
    $feedback_query = mysqli_query($con, "SELECT f.feedback_text, f.submitted_at, m.fname, m.lname 
                                          FROM feedback_tbl f 
                                          JOIN members_tbl m ON f.member_id = m.member_id 
                                          WHERE f.module_id = $module_id 
                                          ORDER BY f.submitted_at DESC");

    echo '<div class="mt-5">';
    echo '<h4>Feedback</h4>';

    if (mysqli_num_rows($feedback_query) > 0) {
        while ($fb = mysqli_fetch_assoc($feedback_query)) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h6 class="card-title">' . htmlspecialchars($fb['fname'] . ' ' . $fb['lname']) . '</h6>';
            echo '<p class="card-text">' . nl2br(htmlspecialchars($fb['feedback_text'])) . '</p>';
            echo '<small class="text-muted">Posted on ' . date('F d, Y h:i A', strtotime($fb['submitted_at'])) . '</small>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="alert alert-info">No feedback yet. Be the first to give feedback!</div>';
    }
    echo '</div>';
}
?>

</div>

<?php include 'footer.php'; ?>
