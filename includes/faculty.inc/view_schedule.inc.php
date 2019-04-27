<?php
    $sqlCurrentSemester = "SELECT CONCAT(CONCAT(sec.sectionCRN, CONCAT('-00', CONCAT(sec.sectionNumber, '-'))),
                                         CONCAT(d.departmentTag, c.courseNumber))                           AS scheduleSection,
                                  sec.sectionCourse                                                         AS scheduleCourse,
                                  CONCAT(CONCAT(sem.semesterStartDate, ' - '), sem.semesterEndDate)         AS scheduleDates,
                                  CONCAT(CONCAT(sec.sectionSchedule, ', '),
                                         (CONCAT(CONCAT(sec.sectionStartTime, ' - '), sec.sectionEndTime))) AS scheduleSchedule,
                                  CONCAT(CONCAT(b.buildingName, ' '), rm.roomNumber)                        AS scheduleLocation
                           FROM registration_system.section sec,
                                registration_system.semester sem,
                                registration_system.building b,
                                registration_system.course c,
                                registration_system.department d,
                                registration_system.room rm
                           WHERE sec.sectionInstructor = '" . $_SESSION['userId'] . "'
                             AND sec.sectionCourse = c.courseName
                             AND b.buildingName = rm.roomBuilding
                             AND sec.sectionRoom = rm.roomNumber
                             AND d.departmentName = c.courseSubject
                             AND sec.sectionSemester = sem.semesterName
                             AND sec.sectionSemester = '" . $_SESSION['currentSemester'] . "';";

    $resultCurrentSemester = $conn->query($sqlCurrentSemester);

    if ($row0 = mysqli_fetch_row($resultCurrentSemester))
    {
        viewFancyTableFromSQL($conn, $sqlCurrentSemester, $current_page, "fsc-table-container",
            "fsc-table", "Schedule - Current Semester", "");
    }

    $sqlNextSemester = "SELECT CONCAT(CONCAT(sec.sectionCRN, CONCAT('-00', CONCAT(sec.sectionNumber, '-'))),
                                         CONCAT(d.departmentTag, c.courseNumber))                           AS scheduleSection,
                                  sec.sectionCourse                                                         AS scheduleCourse,
                                  CONCAT(CONCAT(sem.semesterStartDate, ' - '), sem.semesterEndDate)         AS scheduleDates,
                                  CONCAT(CONCAT(sec.sectionSchedule, ', '),
                                         (CONCAT(CONCAT(sec.sectionStartTime, ' - '), sec.sectionEndTime))) AS scheduleSchedule,
                                  CONCAT(CONCAT(b.buildingName, ' '), rm.roomNumber)                        AS scheduleLocation
                           FROM registration_system.section sec,
                                registration_system.semester sem,
                                registration_system.building b,
                                registration_system.course c,
                                registration_system.department d,
                                registration_system.room rm
                           WHERE sec.sectionInstructor = '" . $_SESSION['userId'] . "'
                             AND sec.sectionCourse = c.courseName
                             AND b.buildingName = rm.roomBuilding
                             AND sec.sectionRoom = rm.roomNumber
                             AND d.departmentName = c.courseSubject
                             AND sec.sectionSemester = sem.semesterName
                             AND sec.sectionSemester = '" . $_SESSION['nextSemester'] . "';";

    $resultNextSemester = $conn->query($sqlNextSemester);

    if ($row1 = mysqli_fetch_row($resultNextSemester))
    {
        viewFancyTableFromSQL($conn, $sqlNextSemester, $current_page, "fsn-table-container",
            "fsn-table", "Schedule - Next Semester", "");
    }

