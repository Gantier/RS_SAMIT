<?php
    require "header.php";

    echo "<main id='admin.academics-container'>";

    require "includes/dbh.inc.php";
//require "add_account.inc.php";

    $sqlAdminAccounts = "SELECT 
                            adminAccountEmail
                            FROM registration_system.account_admin;";

    viewFancyTableFromSQL($conn, $sqlAdminAccounts, $current_page, "adaccounts-table-container", "ac-table", "Admin Accounts", "accountClick(this)");

    require "includes/admin.inc/ac-console-admin.inc.php";

    echo "</main>";

    require "footer.php";
