<?php
    require "header.php";

    echo "<main id='admin.academics-container'>";
echo '<img class="background" src="images/college3CroppedFade.jpg" alt="collegeCampus">';

    require "includes/dbh.inc.php";
//require "add_account.inc.php";

    $sqlAdminAccounts = "SELECT 
                            researcherAccountEmail
                            FROM registration_system.account_researcher;";

    viewFancyTableFromSQL($conn, $sqlAdminAccounts, $current_page, "adaccounts-table-container", "ac-table", "Researcher Accounts", "accountClick(this)");

    require "includes/admin.inc/ac-console-researcher.inc.php";

    echo "</main>";

    require "footer.php";
