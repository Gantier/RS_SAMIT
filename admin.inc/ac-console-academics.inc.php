<div id="ac-console-container">

    <div class="card" id="ac-academics-search-card">
        <div class="card-title">
            Search Accounts
        </div>

        <!--SEARCH CARD-->
        <div class="card-body">
            <form method="post" action="admin_academics_inner.php">

                <input class="form-text-field" type="text" id="sr-keyword"
                       oninput="massiveTableInstantSearch('ac-table', 'sr-keyword', 'sr-helper-text',
                       <?php echo ConstantsMatt::ACTIVE_SEARCH_ACCOUNT_HELPER . ", " . ConstantsMatt::DEFAULT_ACCOUNT_HELPER ?>, 1)"
                       placeholder="Instant search all..."><br>

                <button style="display: none;" class="small-button outlined secondary" id="ac-academics-button" name="add-account-submit"
                    type="submit">
                </button>

                <input style="display: none;" type="text" name="ac-academics-email-hidden" id="ac-academics-email-hidden">

            </form>
        </div>
    </div>

    <div class="card card-body helper">
        <div class="helper" id="sr-helper-text">
            <p>Please click the Student Account you would like to modify</p>
        </div>
    </div>

</div>


