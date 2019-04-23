<div id="ac-console-container">

    <div class="card" id="sr-filter-card">
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

    <!--EDIT/DELETE ACCOUNT CARD-->
    <div class="card" id="ac-details-card">
        <div class="card-title">
            Edit or Delete Account
        </div>
        <div class="card-body">
            <form method="post" action="includes/admin.inc/delete_account.inc.php">

                <input style="display: none;" type="text" name="ac-account-type" value="student">

                <label>Delete Student Account: </label>
                <input class="form-text-field" type="text" name="ac-account-email" placeholder="Account email">

                <button class="small-button outlined secondary" name="delete-account-submit" type="submit">Delete Student</button><hr>
            </form>
        </div>
    </div>

    <!--ADD ACCOUNT CARD-->
    <div class="card" id="ac-details-card">
        <div class="card-title">
            Add Account
        </div>

        <div class="card-body">
            <!-- Required form components:
             1. Student Last Name, Middle Name, First Name
             2. Student Gender
             3. Program enrolled in
             -->
            <form method="post" action="includes/admin.inc/add_account.inc.php">

                <input style="display: none;" type="text" name="ac-account-type" value="student">


                <input class="form-text-field" type="text" name="ac-first-name" placeholder="First name">
                <input class="form-text-field" type="text" name="ac-middle-name" placeholder="Middle name">
                <input class="form-text-field" type="text" name="ac-last-name" placeholder="Last name">
                <hr>

                <input type="radio" name="gender-radio" value="M" checked >Male
                <input type="radio" name="gender-radio" value="F">Female
                <hr>

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

                <br>
                <label>Date of Birth:</label>
                <input type="date" name="student-dob">

                <button class="small-button outlined secondary" name="add-account-submit" type="submit">Add Student</button>
            </form>

        </div>
    </div>

    <div class="card card-body helper">
        <div class="helper" id="sr-helper-text">
            <?php echo ConstantsMatt::DEFAULT_ACCOUNT_HELPER ?>
        </div>
    </div>

</div>


