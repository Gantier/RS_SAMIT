<?php
require "header.php";

echo "<main id='admin.academics-container'>";
echo '<img class="background" src="images/college3CroppedFade.jpg" alt="collegeCampus">';

require "includes/dbh.inc.php";
//require "add_account.inc.php";

$submittedEmail = $_POST['ac-academics-email-hidden'];

$sqlAdminAcademics = "SELECT tab2.`studentFull Name`, tab2.studentAccount ,tab1.sectionCRN, tab1.courseName, tab2.midtermGrade AS `thisMidterm`, tab2.finalGrade AS `thisFinal`, tab2.studentHold
FROM (SELECT sec.sectionCRN, sec.sectionSemester, sec.sectionCourse, cou.courseName
      FROM registration_system.section sec INNER JOIN registration_system.course cou ON sec.sectionCourse = cou.courseName) AS tab1
INNER JOIN ((SELECT stu.studentAccount, CONCAT(CONCAT(CONCAT(stu.studentFirstName, ' '),CONCAT(SUBSTR(stu.studentMiddleName, 1, 1), '. ')),stu.studentLastName) AS 'studentFull Name',
                    stu.studentHold, reg.sectionCRN, reg.finalGrade, reg.midtermGrade
             FROM registration_system.student stu INNER JOIN registration_system.registration reg ON stu.studentAccount = reg.studentAccount)) AS tab2
ON tab1.sectionCRN = tab2.sectionCRN
WHERE tab2.studentAccount = '" . $submittedEmail . "'
AND tab1.sectionSemester = '" . $_SESSION['currentSemester'] . "';";

viewFancyTableFromSQL($conn, $sqlAdminAcademics, $current_page, "adaccounts-table-container", "ac-table", "Student Accounts", "academicsInnerClick(this)");

require "includes/admin.inc/ac-console-academics-inner.inc.php";

echo "</main>";

require "footer.php";
