<div id="fa-console-container">
    <div class="card" id="fa-search-card">
        <div class="card-title">
            Search Students
        </div>
        <div class="card-body">
            <form>
                <input class="form-text-field" type="text" id="fa-keyword"
                       oninput="tableInstantSearch('fa-table', 'fa-keyword', 'fa-helper-text',
                       'Showing all students filtered by \'', 'Showing all students...', 3)"
                       placeholder="Instant search all..."><br><br>
                <hr>
                <label>Filter Students</label><br>
                <label for="fa-section-dropdown"></label>
                <select id="fa-section-dropdown">
                    <option value="null" selected hidden>Select section...</option>
                    <?php
                        if (isset($resultFacultySectionsC))
                        {
                            foreach ($resultFacultySectionsC as $item)
                            {
                                echo '<option value="' . $item['facultySection'] . '">' .
                                    $item['facultySection'] . '</option>';
                            }
                        }
                    ?>
                </select><br>
                <button class="small-button outlined secondary" type="reset"
                        onclick="tableReset('fa-table', 'fa-helper-text', 'Showing all students...')">
                    Reset
                </button>
                <button class="small-button outlined secondary" type="button" onclick="faFilter()">Filter</button>
            </form>
        </div>
    </div>
    <div class="card" id="fa-grades-card">
        <div class="card-title" id="fa-details-title">
            Grades & Attendance
        </div>
        <div class="card-body" id="fa-details-body">
            <div id="fa-details-text">
                Select a student from the table on the right to edit midterm/final grades and record daily attendance...
            </div>
            <hr>
            <br>
            <!--suppress HtmlUnknownTarget -->
            <form method="post" action="faculty_academics.php" id="fa-form">
                <label>
                    <input type="text" name="fa-student-account" id="fa-student-account" style="display: none" readonly>
                </label>
                <label><?php echo $_SESSION['currentSemester'] ?> Grades:</label><br>
                <label class="helper-label" for="fa-midterm-dropdown"><?php
                        if (isset($gradeWindows))
                        {
                            $start = substr($gradeWindows['midtermStart'], 5);
                            if (substr($start, 0, 1) === '0')
                            {
                                $start = substr($start, 1);
                            }
                            $end = substr($gradeWindows['midtermEnd'], 5);
                            if (substr($end, 0, 1) === '0')
                            {
                                $end = substr($end, 1);
                            }
                            echo 'grade midterms from ' .
                                $start . ' to ' . $end;
                        }
                    ?></label>
                <select id="fa-midterm-dropdown"<?php
                    if (isset($gradesEnabled))
                    {
                        if ($gradesEnabled['midterm'] === 'disabled')
                        {
                            echo 'disabled';
                        }
                    } ?>>
                    <option value="null" selected hidden>Select midterm grade...</option>
                    <?php
                        foreach (Constants::MIDTERM as $item)
                        {
                            echo '<option value="' . $item . '">' . $item . '</option>';
                        }
                    ?>
                </select><br>
                <label class="helper-label" for="fa-final-dropdown"><?php
                        if (isset($gradeWindows))
                        {
                            $start = substr($gradeWindows['finalStart'], 5);
                            if (substr($start, 0, 1) === '0')
                            {
                                $start = substr($start, 1);
                            }
                            $end = substr($gradeWindows['finalEnd'], 5);
                            if (substr($end, 0, 1) === '0')
                            {
                                $end = substr($end, 1);
                            }
                            echo 'grade finals from ' .
                                $start . ' to ' . $end;
                        }
                    ?></label>
                <select id="fa-final-dropdown"<?php
                    if (isset($gradesEnabled))
                    {
                        if ($gradesEnabled['final'] === 'disabled')
                        {
                            echo 'disabled';
                        }
                    } ?>>
                    <option value="null" selected hidden>Select final grade...</option>
                    <?php
                        foreach (Constants::FINAL as $item)
                        {
                            echo '<option value="' . $item . '">' . $item . '</option>';
                        }
                    ?>
                </select><br><br>
                <hr>
                <br>
                <div class="fa-radios-attendance">
                    <label><?php {
                            if (isset($today))
                            {
                                if (substr($today[0], 5, 1) === '0')
                                {
                                    echo substr($today[0], 6);
                                }
                                else
                                {
                                    echo substr($today[0], 5);
                                }
                            }
                        } ?> Attendance:</label><br>
                    <label>
                        <input type="radio" name="gender-radio" value="present" checked>
                    </label>Present
                    <label>
                        <input type="radio" name="gender-radio" value="absent">
                    </label>Absent
                </div>
                <br>
                <button class="outlined secondary big-button" type="submit" name="fa-submit">Submit</button>
            </form>
        </div>
    </div>
    <div class="card card-body helper">
        <div class="helper" id="fa-helper-text">
            Showing all students...
        </div>
    </div>
</div>


