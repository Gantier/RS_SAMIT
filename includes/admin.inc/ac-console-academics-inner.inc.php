<div id="ac-console-container">

    <!--UPDATE GRADES CARD-->
    <div class="card" id="ac-modify-grades-card">
        <div class="card-title">
            Update Grades
        </div>

        <div class="card-body">
            <form method="post" action="includes/admin.inc/update_grades.inc.php">

                <!--HIDDEN STUDENT EMAIL-->
                <input style="display: none;" type="text" name="ac-academics-grades-email-hidden" id="ac-academics-grade-email-hidden">

                <!--SECTION CRN-->
                <input class="form-text-field ac-name-text-box" id="ac-update-grade-crn-text-box" type="text"
                       name="ac-update-grade-crn" placeholder="Section CRN...">

                <!--MIDTERM-->
                <select id="ac-midterm-dropdown" name="ac-update-midterm-dropdown">
                    <option value="null" selected hidden>Select midterm grade...</option>
                    <?php
                    foreach (Constants::MIDTERM as $item)
                    {
                        echo '<option value="' . $item . '">' . $item . '</option>';
                    }
                    ?>
                </select>

                <!--FINAL-->
                <select id="ac-final-dropdown" name="ac-update-final-dropdown">
                    <option value="null" selected hidden>Select final grade...</option>
                    <?php
                    foreach (Constants::FINAL as $item)
                    {
                        echo '<option value="' . $item . '">' . $item . '</option>';
                    }
                    ?>
                </select>

                <!--SUBMIT BUTTON-->
                <button class="small-button outlined secondary" id="ac-modify-grades-button" name="ac-modify-grades-submit"
                        type="submit">Submit
                </button>

            </form>
        </div>
    </div>

    <!--UPDATE HOLD CARD-->
    <div class="card" id="ac-section-edit-card">
        <div class="card-title">
            Update Hold
        </div>
        <div class="card-body">
            <form method="post" id="ac-add-course-form" action="includes/admin.inc/update_hold.inc.php">

                <!--HIDDEN STUDENT EMAIL-->
                <input type="text" name="ac-academics-hold-email-hidden" id="ac-academics-hold-email-hidden"
                placeholder="Enter student email...">

                <!--HOLD DROPDOWN-->
                <select id="ac-holds-dropdown" name="ac-update-holds-dropdown">
                    <option value="null" selected hidden>Update hold...</option>
                    <?php
                    foreach (ConstantsMatt::HOLDS as $item)
                    {
                        echo '<option value="' . $item . '">' . $item . '</option>';
                    }
                    ?>
                </select>

                <!--SUBMIT BUTTON-->
                <button class="small-button outlined secondary" id="ac-update-hold-button" name="update-hold-submit"
                        type="submit">Update Hold
                </button>

            </form>
        </div>
    </div>

</div>


