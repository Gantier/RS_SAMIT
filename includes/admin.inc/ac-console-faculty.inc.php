<div id="ac-console-container">

    <div class="card" id="ac-filter-card">
        <div class="card-title">
            Search Faculty Accounts
        </div>

        <!--SEARCH CARD-->
        <div class="card-body">
            <form>
                <input class="form-text-field" type="text" id="sr-keyword"
                       oninput="massiveTableInstantSearch('ac-table', 'sr-keyword', 'sr-helper-text',
                       <?php echo ConstantsMatt::ACTIVE_SEARCH_ACCOUNT_HELPER . ", " . ConstantsMatt::DEFAULT_ACCOUNT_HELPER ?>, 1)"
                       placeholder="Instant search all..."><br><br>
            </form>
        </div>
    </div>

    <!--ADD ACCOUNT CARD-->
    <div class="card" id="ac-faculty-add-card">
        <div class="card-title">
            Add Account
        </div>

        <div class="card-body">

            <form method="post" action="includes/admin.inc/add_account.inc.php">

                <!-- ACCOUNT TYPE - HIDDEN -->
                <input style="display: none;" type="text" name="ac-account-type" value="faculty">

                <!--                FULL NAME-->
                <input class="form-text-field ac-extended-name-text-box" type="text" name="ac-first-name"
                       placeholder="First name">
                <input class="form-text-field ac-extended-name-text-box" type="text" name="ac-middle-name"
                       placeholder="Middle name">
                <input class="form-text-field ac-extended-name-text-box" type="text" name="ac-last-name"
                       placeholder="Last name">

                <!--FULL-TIME/PART-TIME-->
                <div class="ac-outer-radios">
                    <div class="ac-time-radios">
                        <input type="radio" name="time-radio" value="FT" checked>Full-Time
                        <input type="radio" name="time-radio" value="PT">Part-Time
                    </div>

                    <!--GENDER-->

                    <div class="ac-time-radios">
                        <input type="radio" name="gender-radio" value="M" checked>Male
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender-radio" value="F">Female
                    </div>
                </div>

                <!--                DEPARTMENT-->
                <br>

                <div class="ac-add-department-dropdown">
                    <select name="ac-department-dropdown" id="ac-dept-dropdown">
                        <option value="null" selected hidden>Select department...</option>
                        <?php
                        for ($i = 0; $i < sizeof(Constants::SUBJECTS); $i++)
                        {
                            echo '<option value="' . Constants::SUBJECTS[$i] . '">' . Constants::SUBJECTS[$i] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!--                SUBMIT BUTTON-->
                <button class="small-button outlined secondary" id="ac-add-button" name="add-account-submit"
                        type="submit">Add Faculty
                </button>
            </form>

        </div>
    </div>

    <!--EDIT ACCOUNT CARD-->
    <div class="card" id="ac-faculty-edit-card">
        <div class="card-title">
            Edit Account
        </div>

        <!--Things that need to be editable
        1. Password [done]
        2. Department (?)
        3. (?) faculty_full-time/part-time attributes?
        -->

        <div class="card-body">
            <form method="post" action="includes/admin.inc/edit_account.inc.php">
                <input style="display: none;" type="text" name="ac-account-type" value="faculty">

                <input class="form-text-field ac-name-text-box" id="ac-name-text-box-1" type="email"
                       name="ac-reset-email" spellcheck="false" placeholder="Account email..."><br><br><br>
                <hr>
                <br>
                <input class="form-text-field ac-name-text-box" id="ac-name-text-box-2" type="password"
                       name="ac-current-pw" placeholder="Current password...">
                <input class="form-text-field ac-name-text-box" id="ac-name-text-box-3" type="password" name="ac-new-pw"
                       placeholder="New Password...">
                <input class="form-text-field ac-name-text-box" id="ac-name-text-box-4" type="password"
                       name="ac-repeat-pw" placeholder="Repeat Password...">

                <button class="small-button outlined secondary" id="ac-password-button" name="edit-account-submit"
                        type="submit">Update Password
                </button>

                <br><br><br>
                <hr>
                <select name="ac-department-dropdown" class="ac-dept-dropdown-position" id="ac-dept-dropdown">
                    <option value="null" selected hidden>Select department...</option>
                    <?php
                    for ($i = 0; $i < sizeof(Constants::SUBJECTS); $i++)
                    {
                        echo '<option value="' . Constants::SUBJECTS[$i] . '">' . Constants::SUBJECTS[$i] . '</option>';
                    }
                    ?>
                </select>

                <button class="small-button outlined secondary" id="ac-dept-button" name="edit-department-submit"
                        type="submit">Update Department
                </button>

            </form>
        </div>
    </div>

    <!--DELETE ACCOUNT CARD-->
    <div class="card" id="ac-admin-delete-card">
        <div class="card-title">
            Delete Account
        </div>
        <div class="card-body">
            <form method="post" action="includes/admin.inc/delete_account.inc.php">

                <input style="display: none;" type="text" name="ac-account-type" value="faculty">

                <input class="form-text-field" id="ac-delete-email-text-box" type="text" name="ac-account-email"
                       placeholder="Account email...">

                <button class="small-button outlined secondary" id="ac-delete-button" name="delete-account-submit"
                        type="submit">Delete Faculty
                </button>
            </form>
        </div>
    </div>

    <div class="card card-body helper">
        <div class="helper" id="sr-helper-text">
            <?php echo ConstantsMatt::FACULTY_ACCOUNT_HELPER ?>
        </div>
    </div>

</div>


