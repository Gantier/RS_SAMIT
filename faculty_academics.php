<?php
    require "header.php";

    echo '<img class="background" src="images/college3CroppedFade.jpg" alt="collegeCampus">';

    echo '<main id="fa-container">';

    require "includes/dbh.inc.php";
    require "includes/faculty.inc/data.inc.php";

    $sqlFacultyAcademics = "SELECT CONCAT(CONCAT(sec.sectionCRN, CONCAT('-00', CONCAT(sec.sectionNumber, '-'))),
                                          CONCAT(d.departmentTag, c.courseNumber)) AS 'Section CRN',
                                   c.courseName                                    AS 'Course Title',
                                   CONCAT(CONCAT(CONCAT(s.studentLastName, ', '),
                                                 s.studentFirstName))              AS 'Student Name',
                                   s.studentAccount                                AS studentAccount,
                                   reg.midtermGrade                                AS studentMidterm,
                                   reg.finalGrade                                  AS studentFinal,
                                   reg.dateRegistered                              AS studentRegistered
                            FROM registration_system.student s,
                                 registration_system.department d,
                                 registration_system.course c,
                                 registration_system.registration reg,
                                 registration_system.section sec
                            WHERE sec.sectionInstructor = '" . $_SESSION['userId'] . "'
                              AND sec.sectionSemester = '" . $_SESSION['currentSemester'] . "'
                              AND s.studentAccount = reg.studentAccount
                              AND sec.sectionCourse = c.courseName
                              AND sec.sectionCRN = reg.sectionCRN
                              AND d.departmentName = c.courseSubject;";

    $resultFacultyAcademics = viewFancyTableFromSQL($conn, $sqlFacultyAcademics, $current_page,
        "fa-table-container", "fa-table", "Your Students - " . $_SESSION['currentSemester'],
        "updateFacultyAcademics(this, 'fa-details-text', 'fa-student-account')");

    require "includes/faculty.inc/fa-console.inc.php";
    echo '</main>';
