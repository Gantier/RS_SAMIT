<!--popup background-->
<div id="edit-pw-backdrop"></div>
<!--popup-->
<div class="card" id="edit-pw-card">
    <div class="card-title">
        Edit Password
    </div>
    <div class="card-body">
        <!--suppress HtmlUnknownTarget -->
        <form method="post" action="includes/admin.inc/edit-password.inc.php">
            <input class="form-text-field" type="password" name="edit-pw-current" placeholder="old password..."><br>
            <input class="form-text-field" type="password" name="edit-pw-new" placeholder="new password..."><br>
            <input class="form-text-field" type="password" name="edit-pw-repeat"
                   placeholder="repeat new password..."><br><br>
            <button class="big-button secondary outlined" type="submit" name="edit-pw-submit">Submit</button>
            <br>
            <button class="big-button secondary outlined" type="reset" name="edit-pw-cancel" id="edit-pw-cancel"
                    onclick="toggleEditPassword()">Cancel
            </button>
        </form>
    </div>
</div>
