<?php
    require "header.php";

    echo '<img class="background" src="images/college3CroppedFade.jpg" alt="collegeCampus">';

    echo '<body onload="faOnLoad()">';

    echo '<main id="fa-container">';

    require "includes/dbh.inc.php";
    require "includes/faculty.inc/data.inc.php";

    //if no attendance sheet for today, create attendance sheet
    if (isset($attendanceCreatedToday))
    {
        if (!$attendanceCreatedToday)
        {
            if (isset($resultStudents))
            {
                foreach ($resultStudents as $student)
                {
                    $sqlCreateAttendance = "INSERT INTO registration_system.attendance
                                            (attendanceStudent, attendanceSection, attendanceDate, attendanceIsPresent)
                                            VALUES ('" . $student['studentAccount'] . "', " . $student['sectionCRN'] . ", CURRENT_DATE, 2);";
                    $conn->query($sqlCreateAttendance);
                }
            }
        }
    }

    if (isset($today))
    {
        $sqlFacultyAcademics = "SELECT CONCAT(CONCAT(CONCAT(s.studentLastName, ', '),
                                                     s.studentFirstName))              AS 'Student Name',
                                       s.studentAccount                                AS studentAccount,
                                       CONCAT(CONCAT(sec.sectionCRN, CONCAT('-00', 
                                         CONCAT(sec.sectionNumber, '-'))),
                                              CONCAT(d.departmentTag, c.courseNumber)) AS 'Section CRN',
                                       c.courseName                                    AS 'Course Title',
                                       reg.dateRegistered                              AS studentRegistered,
                                       reg.midtermGrade                                AS studentMidterm,
                                       CASE CONVERT(reg.finalGrade, CHAR(4))
                                         WHEN '4.00' THEN 'A'
                                         WHEN '3.67' THEN 'A-'
                                         WHEN '3.33' THEN 'B+'
                                         WHEN '3.00' THEN 'B'
                                         WHEN '2.67' THEN 'B-'
                                         WHEN '2.33' THEN 'C+'
                                         WHEN '2.00' THEN 'C'
                                         WHEN '1.67' THEN 'C-'
                                         WHEN '1.33' THEN 'D+'
                                         WHEN '1.00' THEN 'D'
                                         WHEN '0.67' THEN 'D-'
                                         WHEN '0.00' THEN 'F'
                                         ELSE NULL END                                 AS studentFinal,
                                       a.attendanceIsPresent                           AS studentAttendance
                                FROM registration_system.student s,
                                     registration_system.department d,
                                     registration_system.course c,
                                     registration_system.registration reg,
                                     registration_system.section sec,
                                     registration_system.attendance a
                                WHERE sec.sectionInstructor = '" . $_SESSION['userId'] . "'
                                  AND sec.sectionSemester = '" . $_SESSION['currentSemester'] . "'
                                  AND s.studentAccount = reg.studentAccount
                                  AND sec.sectionCourse = c.courseName
                                  AND sec.sectionCRN = reg.sectionCRN
                                  AND d.departmentName = c.courseSubject
                                  AND a.attendanceStudent = reg.studentAccount
                                  AND a.attendanceSection = reg.sectionCRN
                                  AND a.attendanceDate = '" . $today[0] . "'
                                ORDER BY 'Section CRN', 'Student Name';";
    }
    if (mysqli_fetch_row($conn->query($sqlFacultyAcademics)))
    {
        $resultFacultyAcademics = viewFancyTableFromSQL($conn, $sqlFacultyAcademics, $current_page,
            "fa-table-container", "fa-table", "Your Students - " . $_SESSION['currentSemester'],
            "faUpdateTableRow(this)");
    }
    else
    {
        header("Location: faculty_home.php?error=noStudents");
    }

    require "includes/faculty.inc/fa-console.inc.php";

    echo '</main>';
    echo '</body>';
