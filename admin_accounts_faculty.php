<?php
    require "header.php";

    echo "<main id='admin.academics-container'>";
echo '<img class="background" src="images/college3CroppedFade.jpg" alt="collegeCampus">';

    require "includes/dbh.inc.php";
//require "add_account.inc.php";

    $sqlAdminAccounts = "SELECT 
                            facultyAccount,
                            CONCAT(CONCAT(CONCAT(facultyFirstName, ' '), 
                            CONCAT(SUBSTR(facultyMiddleName, 1, 1), '. ')),
                            facultyLastName) AS 'facultyFull Name',
                            facultyDepartment
                            FROM registration_system.faculty;
                                                  ";

    viewFancyTableFromSQL($conn, $sqlAdminAccounts, $current_page, "adaccounts-table-container", "ac-table", "Faculty Accounts", "accountClick(this)");

    require "includes/admin.inc/ac-console-faculty.inc.php";

    echo "</main>";

    require "footer.php";
