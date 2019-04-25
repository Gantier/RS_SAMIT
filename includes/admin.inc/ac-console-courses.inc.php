<!--<div id="admin-cc-console-container">

    <div class="ac-courses-upper-console">
        <div class="card" id="ac-search-card">
            <div class="card-title">
                Search Courses
            </div>
            <div class="card-body">
                <form>
                    <input class="form-text-field" type="text" id="cc-keyword"
                           oninput="tableInstantSearch('cc-table', 'cc-keyword', 'cc-helper-text',
                           <?php /*echo Constants::ACTIVE_SEARCH_COURSE_HELPER . ", " . Constants::DEFAULT_COURSE_HELPER */ ?>,
                           <?php /*if (preg_match("[undergraduate]", $current_page)): */ ?>4<?php /*else: */ ?>3<?php /*endif */ ?>)"
                           placeholder="Instant search all..."><br><br>
                    <hr>
                    <label>Filter Courses</label><br>
                    <label for="cc-subject-dropdown"></label>
                    <select id="cc-subject-dropdown">
                        <option value="null" selected hidden>Select subject...</option>
                        <?php
    /*                        for ($i = 0; $i < sizeof(Constants::SUBJECTS); $i++)
                            {
                                echo '<option value="' . Constants::SUBJECTS[$i] . '">' . Constants::SUBJECTS[$i] . '</option>';
                            }
                            */ ?>
                    </select><br>
                    <?php /*if (preg_match("[undergraduate]", $current_page)): */ ?>
                        <label for="cc-attribute-dropdown"></label>
                        <select id="cc-attribute-dropdown">
                            <option value="null" selected hidden>Select attribute...</option>
                            <?php
    /*                            for ($i = 0; $i < sizeof(Constants::ATTRIBUTES); $i++)
                                {
                                    echo '<option value="' . Constants::ATTRIBUTES[$i] . '">' . Constants::ATTRIBUTES[$i] . '</option>';
                                }
                                */ ?>
                        </select>
                    <?php /*endif */ ?>
                    <label>Course number range:</label><br>
                    <input class="form-text-field small" type="number" id="cc-range-min" placeholder=" Minimum">
                    <input class="form-text-field small" type="number" id="cc-range-max" placeholder=" Maximum"><br>
                    <button class="small-button outlined secondary" type="reset"
                            onclick="tableReset('cc-table', 'cc-helper-text', <?php /*echo Constants::DEFAULT_COURSE_HELPER; */ ?>)">
                        Reset
                    </button>
                    <button class="small-button outlined secondary" type="button" onclick="ccFilter()">Filter</button>
                </form>
            </div>
        </div>

    </div>



    <div class="card card-body helper">
        <div class="helper" id="sr-helper-text">
            Showing all courses...
        </div>
    </div>
</div>




-->

<div id="ac-console-container">

    <div class="card" id="admin-course-filter-card">
        <div class="card-title">
            Search Courses
        </div>

        <!--SEARCH CARD-->
        <div class="card-body">
            <input class="form-text-field" type="text" id="admin-cc-keyword"
                   oninput="tableInstantSearch('cc-table', 'cc-keyword', 'cc-helper-text',
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
            <?php if (preg_match("[undergraduate]", $current_page)): ?>
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
            <?php endif ?>

            <input class="form-text-field small" type="number" id="cc-range-min" placeholder=" Minimum">
            <input class="form-text-field small" type="number" id="cc-range-max" placeholder=" Maximum"><br>
            <button class="small-button outlined secondary" type="reset"
                    onclick="tableReset('cc-table', 'cc-helper-text', <?php echo Constants::DEFAULT_COURSE_HELPER; ?>)">
                Reset
            </button>
            <button class="small-button outlined secondary" type="button" onclick="ccAdminFilter()">Filter</button>
            </form>
        </div>
    </div>

    <!--ADD ACCOUNT CARD-->
    <div class="card" id="ac-student-add-card">
        <div class="card-title">
            Add Course
        </div>

        <div class="card-body">
            <form method="post" action="includes/admin.inc/add_account.inc.php">

            </form>

        </div>
    </div>

    <!--EDIT COURSE CARD-->
    <div class="card" id="ac-student-edit-card">
        <div class="card-title">
            Edit Course
        </div>
        <div class="card-body">
            <form method="post" action="includes/admin.inc/edit_account.inc.php">

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


            </form>
        </div>
    </div>

    <div class="card card-body helper">
        <div class="helper" id="sr-helper-text">
            <?php echo ConstantsMatt::DEFAULT_ACCOUNT_HELPER ?>
        </div>
    </div>

</div>


