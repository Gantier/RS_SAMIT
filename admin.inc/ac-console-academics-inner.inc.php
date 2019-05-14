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

    <!--EDIT SECTION CARD-->
    <div class="card" id="ac-section-edit-card">
        <div class="card-title">
            Edit Section
        </div>
        <div class="card-body">
            <form method="post" id="ac-add-course-form" action="includes/admin.inc/edit_section.inc.php">

                <!--COURSE TITLE-->
                <!--<input class="form-text-field ac-name-text-box" id="ac-edit-course-title-text-box" type="text"
                       name="ac-course-title" placeholder="Course Title...">-->

                <!--SECTION INSTRUCTOR-->
                <input class="form-text-field ac-name-text-box" id="ac-section-instructor-text-box" type="email"
                       name="ac-section-instructor" spellcheck="false" placeholder="Section instructor...">

                <!--SECTION BUILDING + ROOM-->
                <input class="form-text-field ac-name-text-box" id="ac-edit-section-room-no-text-box" type="number"
                       name="ac-section-room-no" min="101" max="399" placeholder="Room No.">

                <input class="form-text-field ac-name-text-box" id="ac-edit-crn-text-box" type="number"
                       name="ac-edit-section-crn" min="0" placeholder="CRN to edit...">

                <br><br><br>
                <!--START/END TIME-->
                <select id="cc-sections-times-dropdown">
                    <option value="null" selected hidden>Select start/end time...</option>
                    <?php
                    for ($i = 0; $i < sizeof(ConstantsMatt::TIME_SECTIONS); $i++)
                    {
                        echo '<option value="' . ConstantsMatt::TIME_SECTIONS[$i] . '">' . ConstantsMatt::TIME_SECTIONS[$i] . '</option>';
                    }
                    ?>
                </select>

                <!--SECTIONS DAYS-->
                <select id="cc-section-days-dropdown">
                    <option value="null" selected hidden>Select section days...</option>
                    <option value="MW"> Monday + Wednesday</option>
                    <option value="TR"> Tuesday + Thursday</option>
                </select>

                <!--SUBMIT BUTTON-->
                <button class="small-button outlined secondary" id="ac-edit-section-button" name="edit-section-submit"
                        type="submit">Edit Section
                </button>

            </form>
        </div>
    </div>

    <!--DELETE SECTION CARD-->
    <div class="card" id="ac-admin-delete-card">
        <div class="card-title">
            Delete Section
        </div>
        <div class="card-body">
            <form method="post" action="includes/admin.inc/delete_section.inc.php">

                <div class="edit-course-modifying-title">
                    <!--TITLE-->
                    <input class="form-text-field ac-name-text-box" id="ac-delete-section-text-box" type="text"
                           name="ac-delete-section-title" placeholder="Enter CRN to delete...">
                </div>

                <button class="small-button outlined secondary" id="ac-delete-button" name="delete-section-submit"
                        type="submit">Delete Section
                </button>

            </form>
        </div>
    </div>

    <div class="card card-body helper">
        <div class="helper" id="sr-helper-text">
            <?php echo ConstantsMatt::DEFAULT_ACCOUNT_HELPER ?>
        </div>
    </div>

    <div class="card card-body helper" id="sections-room-legend">
        <div class="helper" id="sr-helper-text">
            Building/Room Legend: NAB 101-199, CC 200-300, SU 301-399
        </div>
    </div>

</div>


