<div class="card" id="sag-card">
    <div class="card-title" id="sag-card-title">
        My Grades
        <label>
            <select id="sag-semester-dropdown">
                <?php
                    foreach ($resultStudentSemesters as &$semester)
                    {
                        echo '<option value="' . $semester['semester'] . '">' . $semester['semester'] . '</option>';
                    }
                ?>
            </select>
        </label>
    </div>
    <div class="card-body" id="sag-card-body">

    </div>
</div>

