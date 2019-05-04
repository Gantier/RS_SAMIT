<div id="ac-console-container">

    <div class="card" id="admin-course-filter-card">
        <div class="card-title">
            Search Courses
        </div>

        <!--SEARCH CARD-->
        <div class="card-body">
            <input class="form-text-field" type="text" id="admin-cc-keyword"
                   oninput="tableInstantSearch('ac-table-courses', 'admin-cc-keyword', 'sr-helper-text',
                   <?php echo Constants::ACTIVE_SEARCH_COURSE_HELPER . ", " . Constants::DEFAULT_COURSE_HELPER ?>,
                   <?php if (preg_match("[undergraduate]", $current_page)): ?>4<?php else: ?>3<?php endif ?>)"
                   placeholder="Instant search all...">

            <label for="cc-subject-dropdown"></label>
            <select id="admin-cc-subject-dropdown">
                <option value="null" selected hidden>Select subject...</option>
                <?php
                    for ($i = 0; $i < sizeof(Constants::SUBJECTS); $i++)
                    {
                        echo '<option value="' . Constants::SUBJECTS[$i] . '">' . Constants::SUBJECTS[$i] . '</option>';
                    }
                ?>
            </select>

                <label for="cc-attribute-dropdown"></label>
                <select id="cc-attribute-dropdown">
                    <option value="null" selected hidden>Select attribute...</option>
                    <?php
                        for ($i = 0; $i < sizeof(Constants::ATTRIBUTES); $i++)
                        {
                            echo '<option value="' . Constants::ATTRIBUTES[$i] . '">' . Constants::ATTRIBUTES[$i] . '</option>';
                        }
                    ?>
                </select>


            <input class="form-text-field small" type="number" id="cc-range-min" placeholder=" Minimum">
            <input class="form-text-field small" type="number" id="cc-range-max" placeholder=" Maximum">
            <button class="small-button outlined secondary" type="reset"
                    onclick="tableAdminReset('ac-table-courses', 'sr-helper-text', <?php echo Constants::DEFAULT_COURSE_HELPER; ?>)">
                Reset
            </button>
            <button class="small-button outlined secondary" type="button" onclick="ccAdminFilter()">Filter</button>
            </form>
        </div>
    </div>

    <!--ADD COURSE CARD-->
    <div class="card" id="ac-course-add-card">
        <div class="card-title">
            Add Course
        </div>

        <div class="card-body">
            <form method="post" action="includes/admin.inc/add_course.inc.php">
                <!--TITLE-->
                <input class="form-text-field ac-name-text-box" id="ac-course-title-text-box" type="text"
                       name="ac-course-title" placeholder="Course Title...">
                <!--SUBJECT-->
                <select name="ac-course-subject-dropdown" id="admin-cc-subject-dropdown">
                    <option value="null" selected hidden>Select subject...</option>
                    <?php
                    for ($i = 0; $i < sizeof(Constants::SUBJECTS); $i++)
                    {
                        echo '<option value="' . Constants::SUBJECTS[$i] . '">' . Constants::SUBJECTS[$i] . '</option>';
                    }
                    ?>
                </select>
                <!--ATTRIBUTE-->
                <select name="ac-course-attribute-dropdown" id="cc-attribute-dropdown">
                    <option value="null" selected hidden>Select attribute...</option>
                    <?php
                    for ($i = 0; $i < sizeof(Constants::ATTRIBUTES); $i++)
                    {
                        echo '<option value="' . Constants::ATTRIBUTES[$i] . '">' . Constants::ATTRIBUTES[$i] . '</option>';
                    }
                    ?>
                </select><br>
                <!--NUMBER-->
                <input class="form-text-field ac-name-text-box" id="ac-course-number-text-box" type="number"
                       name="ac-add-course-number" min="1000" max="9999" placeholder="Course Number...">

                <!--CREDITS-->
                <input class="form-text-field ac-name-text-box" id="ac-course-credits-text-box" type="number"
                       name="ac-add-course-credits" min="1" max="6" placeholder="Credits...">

                <!--GRAD/UNDERGRAD-->
                <select name="ac-course-undergrad-dropdown" id="ac-course-undergrad-dropdown">
                    <option value="Undergraduate"> Undergraduate</option>
                    <option value="Graduate"> Graduate</option>
                </select>

                <!--SUBMIT BUTTON-->
                <button class="small-button outlined secondary" id="ac-add-button" name="add-course-submit"
                        type="submit">Add Course
                </button>

            </form>
        </div>
    </div>

    <!--EDIT COURSE CARD-->
    <div class="card" id="ac-course-edit-card">
        <div class="card-title">
            Edit Course
        </div>
        <div class="card-body">
            <form method="post" id="ac-add-course-form" action="includes/admin.inc/edit_account.inc.php">

                <div class="edit-course-modifying-title">
                    <!--TITLE-->
                    <input class="form-text-field ac-name-text-box" id="ac-course-mod-title-text-box" type="text"
                           name="ac-course-title" placeholder="Course Title..."><br><br><br><hr><br>
                </div>

                <div class="edit-course-description">
                    <textarea id="ac-course-desc-text-area" name="ac-course-desc" form="ac-add-course-form" placeholder="Enter course description here..."></textarea>
                </div>

                <div class="edit-course-main">
                    <!--TITLE-->
                    <input class="form-text-field ac-name-text-box" id="ac-course-title-text-box" type="text"
                           name="ac-course-title" placeholder="Course Title...">
                    <!--SUBJECT-->
                    <select id="admin-edit-subject-dropdown">
                        <option value="null" selected hidden>Select subject...</option>
                        <?php
                        for ($i = 0; $i < sizeof(Constants::SUBJECTS); $i++)
                        {
                            echo '<option value="' . Constants::SUBJECTS[$i] . '">' . Constants::SUBJECTS[$i] . '</option>';
                        }
                        ?>
                    </select><br><br><br>
                    <!--ATTRIBUTE-->
                    <select id="ac-attribute-dropdown">
                        <option value="null" selected hidden>Select attribute...</option>
                        <?php
                        for ($i = 0; $i < sizeof(Constants::ATTRIBUTES); $i++)
                        {
                            echo '<option value="' . Constants::ATTRIBUTES[$i] . '">' . Constants::ATTRIBUTES[$i] . '</option>';
                        }
                        ?>
                    </select>
                    <!--NUMBER-->
                    <input class="form-text-field ac-name-text-box" id="ac-course-number-text-box" type="number"
                           name="ac-course-number" min="1000" max="9999" placeholder="Course Number...">

                    <!--CREDITS-->
                    <input class="form-text-field ac-name-text-box" id="ac-course-credits-text-box" type="number"
                           name="ac-course-credits" min="1" max="6" placeholder="Credits...">

                    <button class="small-button outlined secondary" id="ac-edit-course-button" name="edit-course-submit"
                            type="submit">Update Course
                    </button>

                </div>

            </form>
        </div>
    </div>

    <!--DELETE COURSE CARD-->
    <div class="card" id="ac-admin-delete-card">
        <div class="card-title">
            Delete Course
        </div>
        <div class="card-body">
            <form method="post" action="includes/admin.inc/delete_account.inc.php">

                <div class="edit-course-modifying-title">
                    <!--TITLE-->
                    <input class="form-text-field ac-name-text-box" id="ac-course-mod-title-text-box" type="text"
                           name="ac-course-title" placeholder="Course Title...">
                </div>

                <button class="small-button outlined secondary" id="ac-delete-button" name="delete-course-submit"
                        type="submit">Delete Course
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


