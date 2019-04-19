<div class="card" id="sag-card">
    <div class="card-title" id="sag-card-title">
        My Transcript
    </div>
    <div class="card-body" id="sag-card-body">
        <?php
            if (isset($resultStudentSemesters))
            {
                viewTranscript($conn, $resultStudentSemesters, $current_page);
            }
        ?>
    </div>
</div>

