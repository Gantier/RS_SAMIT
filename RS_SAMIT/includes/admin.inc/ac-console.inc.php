<div id="ac-console-container">

    <div class="card" id="sr-filter-card">
        <div class="card-title">
            Search Student Accounts
        </div>

        <!--SEARCH CARD-->
        <div class="card-body">
            <form>
                <input class="form-text-field" type="text" id="sr-keyword"
                       oninput="massiveTableInstantSearch('ac-table', 'sr-keyword', 'sr-helper-text',
                       <?php echo ConstantsMatt::ACTIVE_SEARCH_ACCOUNT_HELPER . ", " . ConstantsMatt::DEFAULT_ACCOUNT_HELPER ?>, 4)"
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
            <form>
                <input class="form-text-field" type="text" id="ac-first-name" placeholder="First name">
                <input class="form-text-field" type="text" id="ac-middle-name" placeholder="Middle name">
                <input class="form-text-field" type="text" id="ac-last-name" placeholder="Last name">
                <hr>

                <label class="radio-container">Male
                    <input type="radio" checked="checked" name="radio">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">Female
                    <input type="radio" name="radio">
                    <span class="checkmark"></span>
                </label>
                <hr>

                <label>Program Enrolled</label><br>
                <label for="ac-subject-dropdown"></label>
                <select id="ac-subject-dropdown">
                    <option value="null" selected hidden>Select program...</option>
                    <?php
                    for ($i = 0; $i < sizeof(ConstantsMatt::PROGRAMS); $i++)
                    {
                        echo '<option value="' . ConstantsMatt::PROGRAMS[$i] . '">' . ConstantsMatt::PROGRAMS[$i] . '</option>';
                    }
                    ?>
                </select>

                <button class="small-button outlined secondary" type="button" onclick="ccFilter()">Add Student</button>
            </form>

        </div>
    </div>

    <div class="card card-body helper">
        <div class="helper" id="sr-helper-text">
            <?php echo ConstantsMatt::DEFAULT_ACCOUNT_HELPER ?>
        </div>
    </div>

</div>


