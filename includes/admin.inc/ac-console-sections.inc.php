<div id="ac-console-container">

    <div class="card" id="admin-section-filter-card">
        <div class="card-title">
            Search Sections
        </div>

        <!--SEARCH CARD-->
        <div class="card-body">
            <input class="form-text-field" type="text" id="admin-cc-keyword"
                   oninput="tableInstantSearch('ms-table', 'admin-cc-keyword', 'sr-helper-text',
                   <?php echo Constants::ACTIVE_SEARCH_COURSE_HELPER . ", " . Constants::DEFAULT_COURSE_HELPER ?>,
                   7)"
                   placeholder="Instant search all...">

            <button class="small-button outlined secondary" type="reset"
                    onclick="tableAdminReset('ms-table', 'sr-helper-text', <?php echo Constants::DEFAULT_COURSE_HELPER; ?>)">
                Reset
            </button>
            </form>
        </div>
    </div>

    <!--ADD SECTION CARD-->
    <div class="card" id="ac-course-add-card">
        <div class="card-title">
            Add Section
        </div>

        <div class="card-body">
            <form method="post" action="includes/admin.inc/add_course.inc.php">

                <!--COURSE TITLE-->
                <input class="form-text-field ac-name-text-box" id="ac-add-course-title-text-box" type="text"
                       name="ac-course-title" placeholder="Course Title...">

                <!--SECTION INSTRUCTOR-->
                <input class="form-text-field ac-name-text-box" id="ac-section-instructor-text-box" type="email"
                       name="ac-section-instructor" spellcheck="false" placeholder="Section instructor...">

                <!--SECTION BUILDING + ROOM-->
                <input class="form-text-field ac-name-text-box" id="ac-section-room-no-text-box" type="number"
                       name="ac-section-room-no" min="101" max="399" placeholder="Room No.">

                <select id="cc-building-dropdown">
                    <option value="null" selected hidden>Select building...</option>
                    <?php
                    for ($i = 0; $i < sizeof(ConstantsMatt::BUILDINGS); $i++)
                    {
                        echo '<option value="' . ConstantsMatt::BUILDINGS[$i] . '">' . ConstantsMatt::BUILDINGS[$i] . '</option>';
                    }
                    ?>
                </select>

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
                <button class="small-button outlined secondary" id="ac-add-button" name="add-course-submit"
                        type="submit">Add Section
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
            <form method="post" id="ac-add-course-form" action="includes/admin.inc/edit_account.inc.php">

                <!--COURSE TITLE-->
                <input class="form-text-field ac-name-text-box" id="ac-edit-course-title-text-box" type="text"
                       name="ac-course-title" placeholder="Course Title...">

                <!--SECTION INSTRUCTOR-->
                <input class="form-text-field ac-name-text-box" id="ac-section-instructor-text-box" type="email"
                       name="ac-section-instructor" spellcheck="false" placeholder="Section instructor...">

                <!--SECTION BUILDING + ROOM-->
                <input class="form-text-field ac-name-text-box" id="ac-section-room-no-text-box" type="number"
                       name="ac-section-room-no" min="101" max="399" placeholder="Room No.">

                <select id="cc-building-dropdown">
                    <option value="null" selected hidden>Select building...</option>
                    <?php
                    for ($i = 0; $i < sizeof(ConstantsMatt::BUILDINGS); $i++)
                    {
                        echo '<option value="' . ConstantsMatt::BUILDINGS[$i] . '">' . ConstantsMatt::BUILDINGS[$i] . '</option>';
                    }
                    ?>
                </select>

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
                <button class="small-button outlined secondary" id="ac-edit-section-button" name="add-course-submit"
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
            <form method="post" action="includes/admin.inc/delete_account.inc.php">

                <div class="edit-course-modifying-title">
                    <!--TITLE-->
                    <input class="form-text-field ac-name-text-box" id="ac-delete-section-text-box" type="text"
                           name="ac-course-title" placeholder="Enter CRN to delete...">
                </div>

                <button class="small-button outlined secondary" id="ac-delete-button" name="delete-course-submit"
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

</div>


