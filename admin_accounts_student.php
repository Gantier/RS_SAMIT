<?php
    require "header.php";

    echo "<main id='admin.academics-container'>";

    require "includes/dbh.inc.php";
    //require "add_account.inc.php";

    $sqlAdminAccounts = "SELECT 
                            studentAccount,
                            CONCAT(CONCAT(CONCAT(studentFirstName, ' '), 
                            CONCAT(SUBSTR(studentMiddleName, 1, 1), '. ')),
                            studentLastName) AS 'studentFull Name',
                            studentHold,
                            studentStatus
                            FROM registration_system.student;
                                                  ";

    viewFancyTableFromSQL($conn, $sqlAdminAccounts, $current_page, "adaccounts-table-container", "ac-table", "Student Accounts", "");

    require "includes/admin.inc/ac-console.inc.php";

    echo "</main>";

    require "footer.php";
