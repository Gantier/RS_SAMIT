<?php
require "header.php";

echo '<main id="ms-container">';

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
                                       c.courseDescription
                                FROM registration_system.section s,
                                     registration_system.building b,
                                     registration_system.faculty f,
                                     registration_system.course c,
                                     registration_system.department d,
                                     registration_system.room r
                                WHERE s.sectionCourse = c.courseName
                                  AND f.facultyAccount = s.sectionInstructor
                                  AND b.buildingName = r.roomBuilding
                                  AND s.sectionRoom = r.roomNumber
                                  AND d.departmentName = c.courseSubject
                                  AND s.sectionSemester = '" . $_SESSION['currentSemester'] . "'
                                ORDER BY sectionCourse, sectionNumber;";

    viewFancyTableFromSQL($conn, $sqlStudentRegistration, $current_page, "ms-table-container",
    "ms-table", "Sections - " . $_SESSION['currentSemester'],
    "updateMasterScheduleDetails(this, 'ms-details-text', 'ms-details-title', 8)");

require "includes/ms-console.inc.php";

echo '</main>';
