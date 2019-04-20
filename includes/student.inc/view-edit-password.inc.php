<!--popup background-->
<div id="edit-pw-backdrop"></div>
<!--popup-->
<div class="card" id="edit-pw-card">
    <div class="card-title">
        Edit Password
    </div>
    <div class="card-body">
        <!--suppress HtmlUnknownTarget -->
        <form method="post" action="includes/student.inc/edit-password.inc.php">
            <input class="form-text-field" type="password" name="edit-pw-current" placeholder="Password"><br>
            <input class="form-text-field" type="password" name="edit-pw-repeat" placeholder="Repeat password"><br>
            <input class="form-text-field" type="password" name="edit-pw-new" placeholder="New password"><br><br>
            <button class="big-button secondary outlined" type="submit" name="edit-pw-submit">Submit</button>
            <br>
            <button class="big-button secondary outlined" type="reset" name="edit-pw-cancel"
                    onclick="toggleStudentEditPassword()">Cancel
            </button>
        </form>
    </div>
</div>
