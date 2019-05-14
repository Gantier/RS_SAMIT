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
                           8)"
                   placeholder="Instant search all...">

            <button class="small-button outlined secondary" type="reset"
                    onclick="tableAdminReset('ms-table', 'sr-helper-text', <?php echo Constants::DEFAULT_COURSE_HELPER; ?>)">
                Reset
            </button>
            </form>
        </div>
    </div>

    <!--ADD STUDENT TO SECTION CARD-->
    <div class="card" id="ac-add-to-section-card">
        <div class="card-title">
            Add Student to Section
        </div>

        <div class="card-body">
            <form method="post" action="includes/admin.inc/add_to_section.inc.php">

                <!--SECTION CRN-->
                <input class="form-text-field ac-name-text-box" id="ac-add-to-section-text-box" type="text"
                       name="ac-add-to-section-crn" placeholder="Enter section CRN...">

                <!--STUDENT EMAIL-->
                <input class="form-text-field ac-name-text-box" id="ac-add-to-section-text-box" type="text"
                       name="ac-add-to-section-email" placeholder="Enter student email...">

                <!--SUBMIT BUTTON-->
                <button class="small-button outlined secondary" id="ac-add-button" name="add-to-section-submit"
                        type="submit">Add to Section
                </button>

            </form>
        </div>
    </div>

    <!--REMOVE STUDENT FROM SECTION CARD-->
    <div class="card" id="ac-admin-delete-card">
        <div class="card-title">
            Remove Student from Section
        </div>
        <div class="card-body">
            <form method="post" action="includes/admin.inc/remove_from_section.inc.php">

                <!--SECTION CRN-->
                <input class="form-text-field ac-name-text-box" id="ac-remove-from-section-text-box" type="text"
                       name="ac-remove-from-section-crn" placeholder="Enter section CRN...">

                <!--STUDENT EMAIL-->
                <input class="form-text-field ac-name-text-box" id="ac-add-to-section-text-box" type="text"
                       name="ac-remove-from-section-email" placeholder="Enter student email...">

                <button class="small-button outlined secondary" id="ac-remove-button" name="remove-from-section-submit"
                        type="submit">Remove from Section
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


