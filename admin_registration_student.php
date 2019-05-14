<?php
    require "header.php";

    echo "<main id='admin.courses-container'>";
    echo '<img class="background" src="images/college3CroppedFade.jpg" alt="collegeCampus">';
    require "includes/dbh.inc.php";
    require "includes/student.inc/data.inc.php";

    $sqlNextSemesterMS = "SELECT s.sectionCRN,
                                       CONCAT(CONCAT(d.departmentTag, ' '), c.courseNumber)                  AS sectionCourse,
                                       CONCAT('00', s.sectionNumber)                                         AS sectionNumber,
                                       s.sectionCourse                                                       AS sectionTitle,
                                       c.courseCredits                                                       AS sectionCredits,
                                       CONCAT(CONCAT(s.sectionSchedule, ', '),
                                              (CONCAT(CONCAT(s.sectionStartTime, ' - '), s.sectionEndTime))) AS sectionSchedule,
                                       CONCAT(CONCAT(f.facultyFirstName, ' '), f.facultyLastName)            AS sectionInstructor,
                                       CONCAT(CONCAT(b.buildingTag, ' '), r.roomNumber)                      AS sectionLocation,
                                       s.sectionSemester,
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
                                  AND (s.sectionSemester = '" . $_SESSION['nextSemester'] . "' 
                                  OR s.sectionSemester = '" . $_SESSION['currentSemester'] . "') 
                                ORDER BY sectionCourse, sectionNumber;";
    /** @noinspection JSUnusedLocalSymbols */
    echo '<script>var allPreReqs = ' . json_encode($preReqArray) . '</script>';
    viewFancyTableFromSQL($conn, $sqlNextSemesterMS, $current_page, "ams-table-container",
        "ms-table", "Sections - " . $_SESSION['currentSemester'] . " + " . $_SESSION['nextSemester'],
        "registrationClick(this)");

    require "includes/admin.inc/ac-console-registration.inc.php";

    echo "</main>";

    require "footer.php";
