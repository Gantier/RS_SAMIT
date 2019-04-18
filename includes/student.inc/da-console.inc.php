<div class="card" id="da-console-card">
    <div class="card-title" id="da-console-card-title">
        Degree Audit
    </div>
    <div class="card-body" id="da-console-card-body">
        <form action="student_degree_audit.php" method="post" id="da-view">
            <label>
                <select id="da-program-dropdown" name="da-program">
                    <?php
                        foreach ($resultStudentEnrollments as &$enrollment)
                        {
                            echo '<option value="' . $enrollment['enrollmentProgram'] . '">' . $enrollment['enrollmentProgram'] . '</option>';
                        }
                    ?>
                </select>
            </label>
            <button class="small-button outlined secondary" type="submit" name="da-submit">View</button>
        </form>
    </div>
</div>

