<div id="ac-console-container">

    <div class="card" id="ac-filter-card">
        <div class="card-title">
            Search Accounts
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
    <div class="card" id="ac-student-add-card">
        <div class="card-title">
            Add Account
        </div>

        <div class="card-body">
            <form method="post" action="includes/admin.inc/add_account.inc.php">

                <input style="display: none;" type="text" name="ac-account-type" value="student">


                <input class="form-text-field" type="text" name="ac-first-name" placeholder="First name">
                <input class="form-text-field" type="text" name="ac-middle-name" placeholder="Middle name">
                <input class="form-text-field" type="text" name="ac-last-name" placeholder="Last name">
                <hr>

                <div class="ac-outer-radios-student">
                    <input type="radio" name="gender-radio" value="M" checked>Male
                    <input type="radio" name="gender-radio" value="F">Female
                </div>

                <div class="ac-outer-DOB">
                    <label>Date of Birth:</label>
                    <input type="date" id="ac-date-of-birth" name="student-dob">
                </div>

                <br><br>
                <hr>

                <div class="ac-outer-program">
                    <label>Program Enrolled: </label>
                    <label for="ac-subject-dropdown"></label>
                    <select name="ac-subject-dropdown">
                        <option value="null" selected hidden>Select program...</option>
                        <?php
                        for ($i = 0; $i < sizeof(ConstantsMatt::PROGRAMS); $i++)
                        {
                            echo '<option value="' . ConstantsMatt::PROGRAMS[$i] . '">' . ConstantsMatt::PROGRAMS[$i] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <button class="small-button outlined secondary" id="ac-add-button" name="add-account-submit"
                        type="submit">Add Student
                </button>
            </form>

        </div>
    </div>

    <!--EDIT ACCOUNT CARD-->
    <div class="card" id="ac-student-edit-card">
        <div class="card-title">
            Edit Account
        </div>
        <div class="card-body">
            <form method="post" action="includes/admin.inc/edit_account.inc.php">
                <input style="display: none;" type="text" name="ac-account-type" value="student">

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

                <input style="display: none;" type="text" name="ac-account-type" value="student">

                <input class="form-text-field" id="ac-delete-email-text-box" type="text" name="ac-account-email"
                       placeholder="Account email...">

                <button class="small-button outlined secondary" id="ac-delete-button" name="delete-account-submit"
                        type="submit">Delete Student
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


