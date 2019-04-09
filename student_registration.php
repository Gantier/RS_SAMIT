<?php
    require "header.php";

    echo '<main id="sr-container">';

    require "includes/dbh.inc.php";

    $sqlStudentRegistration = "SELECT s.sectionCRN,
                                       CONCAT(CONCAT(d.departmentTag, ' '), c.courseNumber)                  AS sectionCourse,
                                       CONCAT('00', s.sectionNumber)                                         AS sectionNumber,
                                       s.sectionCourse                                                       AS sectionTitle,
                                       CONCAT(CONCAT(s.sectionSchedule, ', '),
                                              (CONCAT(CONCAT(s.sectionStartTime, ' - '), s.sectionEndTime))) AS sectionSchedule,
                                       CONCAT(CONCAT(f.facultyFirstName, ' '), f.facultyLastName)            AS sectionInstructor,
                                       CONCAT(CONCAT(b.buildingTag, ' '), r.roomNumber)                      AS sectionLocation,
                                       c.courseSubject,
                                       c.courseAttribute,
                                       c.courseDescription
                                FROM registration_system.section s,
                                     registration_system.course_" . $_SESSION['studentLevel'] . " cg,
                                     registration_system.building b,
                                     registration_system.faculty f,
                                     registration_system.course c,
                                     registration_system.department d,
                                     registration_system.room r
                                WHERE s.sectionCourse LIKE cg.course" . $_SESSION['studentLevel'] . "Name
                                  AND s.sectionCourse LIKE c.courseName
                                  AND f.facultyAccount LIKE s.sectionInstructor
                                  AND b.buildingName LIKE r.roomBuilding
                                  AND s.sectionRoom LIKE r.roomNumber
                                  AND d.departmentName LIKE c.courseSubject
                                  AND s.sectionSemester LIKE '" . $_SESSION['nextSemester'] . "'
                                ORDER BY sectionCourse, sectionNumber;";

    viewTableFromSQL($conn, $sqlStudentRegistration, $current_page, "sr-table-container",
        "sr-table", "Sections - " . $_SESSION['nextSemester'],
        "updateStudentRegistrationDetails(this, 'sr-details-text', 'sr-details-title', 'sr-add-to-worksheet-button', 9)");

    require "includes/student.inc/sr-console.inc.php";

    echo '</main>';

    require "footer.php";
