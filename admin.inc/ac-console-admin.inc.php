<div id="ac-console-container">

    <div class="card" id="ac-filter-card">
        <div class="card-title">
            Search Admin Accounts
        </div>

        <!--SEARCH CARD-->
        <div class="card-body">
            <form>
                <input class="form-text-field" type="text" id="sr-keyword"
                       oninput="massiveTableInstantSearch('ac-table', 'sr-keyword', 'sr-helper-text',
                       <?php echo ConstantsMatt::ACTIVE_SEARCH_ACCOUNT_HELPER . ", " . ConstantsMatt::DEFAULT_ACCOUNT_HELPER ?>, 0)"
                       placeholder="Instant search all..."><br><br>
            </form>
        </div>
    </div>

    <!--ADD ACCOUNT CARD-->
    <div class="card" id="ac-admin-add-card">
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

                <input style="display: none;" type="text" name="ac-account-type" value="admin">

                <input class="form-text-field ac-name-text-box" id="ac-name-text-box-5" type="text" name="ac-first-name"
                       placeholder="First name...">
                <input class="form-text-field ac-name-text-box" id="ac-name-text-box-6" type="text"
                       name="ac-middle-name" placeholder="Middle name...">
                <input class="form-text-field ac-name-text-box" id="ac-name-text-box-7" type="text" name="ac-last-name"
                       placeholder="Last name...">

                <button class="small-button outlined secondary" id="ac-add-button" name="add-account-submit"
                        type="submit">Add Admin
                </button>
            </form>

        </div>
    </div>

    <!--EDIT ACCOUNT CARD-->
    <div class="card" id="ac-pw-edit-card">
        <div class="card-title">
            Edit Account
        </div>
        <div class="card-body">
            <form method="post" action="includes/admin.inc/edit_account.inc.php">
                <input style="display: none;" type="text" name="ac-account-type" value="admin">

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

                <input style="display: none;" type="text" name="ac-account-type" value="admin">

                <input class="form-text-field" id="ac-delete-email-text-box" type="text" name="ac-account-email"
                       placeholder="Account email...">

                <button class="small-button outlined secondary" id="ac-delete-button" name="delete-account-submit"
                        type="submit">Delete Admin
                </button>
            </form>
        </div>
    </div>

    <div class="card card-body helper">
        <div class="helper" id="ac-helper-text">
            <?php echo ConstantsMatt::ADMIN_ACCOUNT_HELPER ?>
        </div>
    </div>

</div>


