<?php
//student advisers (sql to associative array)
$sqlStudentAdvisers = "SELECT CONCAT(CONCAT(CONCAT(f.facultyFirstName, ' '),
                                                 CONCAT(SUBSTR(f.facultyMiddleName, 1, 1), '. ')),
                                          f.facultyLastName)  AS adviserName,
                                    f.facultyDepartment       AS adviserDepartment,
                                    f.facultyAccount          AS adviserContact
                            FROM registration_system.faculty f,
                                 registration_system.adviser a
                            WHERE f.facultyAccount = a.facultyAccount
                              AND a.studentAccount = '" . $_SESSION['userId'] . "';";
$resultStudentAdvisers = mysqli_fetch_all($conn->query($sqlStudentAdvisers), MYSQLI_ASSOC);

//student enrollments
$sqlStudentEnrollments = "SELECT programName AS enrollmentProgram
                              FROM registration_system.enrollment
                              WHERE studentAccount = '" . $_SESSION['userId'] . "';";
$resultStudentEnrollments = mysqli_fetch_all($conn->query($sqlStudentEnrollments), MYSQLI_ASSOC);

//student total credits
$sqlStudentCredits = "SELECT SUM(c.courseCredits) AS totalCredits
                          FROM registration_system.registration r,
                               registration_system.course c,
                               registration_system.section s
                          WHERE r.studentAccount = '" . $_SESSION['userId'] . "'
                            AND c.courseName = s.sectionCourse
                            AND s.sectionCRN = r.sectionCRN;";
$resultStudentCredits = $conn->query($sqlStudentCredits);
$studentCredits = mysqli_fetch_row($resultStudentCredits);

//student hold
$sqlStudentHold = "SELECT CASE
                            WHEN studentHold IS NULL THEN 'none'
                            ELSE studentHold END AS studentHold
                   FROM student
                   WHERE studentAccount = '" . $_SESSION['userId'] . "'";
$resultStudentHold = $conn->query($sqlStudentHold);
$studentHold = mysqli_fetch_row($resultStudentHold);

//student semesters attended
$sqlStudentSemesters = "SELECT DISTINCT sec.sectionSemester AS semester
                            FROM registration_system.registration r,
                                 registration_system.section sec,
                                 registration_system.semester sem
                            WHERE r.sectionCRN = sec.sectionCRN
                              AND sec.sectionSemester = sem.semesterName
                              AND sem.semesterName != '" . $_SESSION['nextSemester'] . "'
                              AND r.studentAccount = '" . $_SESSION['userId'] . "'
                            ORDER BY sem.semesterStartDate DESC";
$resultStudentSemesters = mysqli_fetch_all($conn->query($sqlStudentSemesters), MYSQLI_ASSOC);

//student transcript as separate semesters (2D associative array)
/*$studentTranscripts = array();
foreach ($resultStudentSemesters as $semester)
{
    $sqlTranscriptSemester = "SELECT CONCAT(CONCAT(d.departmentTag, ' '), c.courseNumber) AS transcriptCourse,
                                     c.courseName                                         AS transcriptTitle,
                                     CASE CONVERT(r.finalGrade, CHAR(4))
                                       WHEN '4' THEN 'A'
                                       WHEN '3.67' THEN 'A-'
                                       WHEN '3.33' THEN 'B+'
                                       WHEN '3' THEN 'B'
                                       WHEN '2.67' THEN 'B-'
                                       WHEN '2.33' THEN 'C+'
                                       WHEN '2' THEN 'C'
                                       WHEN '1.67' THEN 'C-'
                                       WHEN '1.33' THEN 'D+'
                                       WHEN '1' THEN 'D'
                                       WHEN '0.67' THEN 'D-'
                                       WHEN '0' THEN 'F'
                                       ELSE NULL END                                      AS transcriptGrade
                              FROM registration_system.department d,
                                   registration_system.course c,
                                   registration_system.section s,
                                   registration_system.registration r
                              WHERE d.departmentName = c.courseSubject
                                AND s.sectionCRN = r.sectionCRN
                                AND s.sectionCourse = c.courseName
                                AND r.studentAccount = '" . $_SESSION['userId'] . "'
                                AND s.sectionSemester = '" . $semester['semester'] . "';";
    $studentTranscripts[$semester['semester']] = mysqli_fetch_all($conn->query($sqlTranscriptSemester), MYSQLI_ASSOC);
}*/
