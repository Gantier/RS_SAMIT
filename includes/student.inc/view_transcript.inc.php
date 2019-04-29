<div class="card" id="sag-card">
    <div class="card-title" id="sag-card-title">
        My Transcript
    </div>
    <div class="card-body" id="sag-card-body">
        <?php
            if (isset($resultStudentSemesters))
            {
                viewTranscript($conn, $current_page, $resultStudentSemesters,
                    $_SESSION['userId'], $_SESSION['studentName'], $_SESSION['studentLevel']);
            }
        ?>
    </div>
</div>

