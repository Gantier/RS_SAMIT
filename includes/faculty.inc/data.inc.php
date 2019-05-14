<?php
if (isset($_SESSION['userId']))
{

    if ($_SESSION['facultyType'] === 'Full-time')//full-time
    {
        //faculty advisees
        $sqlFacultyAdvisees = "SELECT CONCAT(CONCAT(CONCAT(s.studentLastName, ', '), 
                                          s.studentFirstName))      AS adviseeName,
                                          s.studentAccount          AS adviseeContact
                                   FROM registration_system.student s,
                                        registration_system.adviser a
                                   WHERE s.studentAccount = a.studentAccount
                                     AND a.facultyAccount = '" . $_SESSION['userId'] . "'
                                     ORDER BY s.studentAccount;";
        $resultFacultyAdvisees = mysqli_fetch_all($conn->query($sqlFacultyAdvisees), MYSQLI_ASSOC);

        //faculty rank
        $sqlFacultyRank = "SELECT `facultyFull-timeRank` AS facultyRank
                               FROM registration_system.`faculty_full-time`
                               WHERE `facultyFull-timeAccount` = '" . $_SESSION['userId'] . "';";
        $resultFacultyRank = $conn->query($sqlFacultyRank);
        $facultyRank = mysqli_fetch_row($resultFacultyRank);

        //faculty tenure
        $sqlFacultyTenure = "SELECT `facultyTenure`
                                 FROM registration_system.`faculty_full-time`
                                 WHERE `facultyFull-timeAccount` = '" . $_SESSION['userId'] . "';";
        $resultFacultyTenure = $conn->query($sqlFacultyTenure);
        $facultyTenure = mysqli_fetch_row($resultFacultyTenure);

        //faculty sabbatical
        $sqlFacultySabbatical = "SELECT CASE `onSabbatical`
                                              WHEN 0 THEN 'No'
                                              ELSE 'Yes'
                                              END AS onSabbatical
                                     FROM registration_system.`faculty_full-time`
                                     WHERE `facultyFull-timeAccount` = '" . $_SESSION['userId'] . "';";
        $resultFacultySabbatical = $conn->query($sqlFacultySabbatical);
        $facultySabbatical = mysqli_fetch_row($resultFacultySabbatical);
    }
    else//part-time
    {
        //faculty rank
        $sqlFacultyRank = "SELECT `facultyPart-timeRank` AS facultyRank
                               FROM registration_system.`faculty_part-time`
                               WHERE `facultyPart-timeAccount` = '" . $_SESSION['userId'] . "';";
        $resultFacultyRank = $conn->query($sqlFacultyRank);
        $facultyRank = mysqli_fetch_row($resultFacultyRank);
    }
    //faculty sections current semester
    $sqlFacultySectionsC = "SELECT CONCAT(CONCAT(sec.sectionCRN, CONCAT('-00', CONCAT(sec.sectionNumber, '-'))),
                                              CONCAT(d.departmentTag, c.courseNumber)) AS facultySection
                                FROM registration_system.section sec,
                                     registration_system.department d,
                                     registration_system.course c
                                WHERE sec.sectionInstructor = '" . $_SESSION['userId'] . "'
                                  AND sec.sectionCourse = c.courseName
                                  AND d.departmentName = c.courseSubject
                                  AND sec.sectionSemester = '" . $_SESSION['currentSemester'] . "';";
    $resultFacultySectionsC = mysqli_fetch_all($conn->query($sqlFacultySectionsC), MYSQLI_ASSOC);

    //faculty sections next semester
    $sqlFacultySectionsN = "SELECT CONCAT(CONCAT(sec.sectionCRN, CONCAT('-00', CONCAT(sec.sectionNumber, '-'))),
                                              CONCAT(d.departmentTag, c.courseNumber)) AS facultySection
                                FROM registration_system.section sec,
                                     registration_system.department d,
                                     registration_system.course c
                                WHERE sec.sectionInstructor = '" . $_SESSION['userId'] . "'
                                  AND sec.sectionCourse = c.courseName
                                  AND d.departmentName = c.courseSubject
                                  AND sec.sectionSemester = '" . $_SESSION['nextSemester'] . "';";
    $resultFacultySectionsN = mysqli_fetch_all($conn->query($sqlFacultySectionsN), MYSQLI_ASSOC);

    //faculty status
    $sqlFacultyStatus = "SELECT facultyStatus
                           FROM registration_system.faculty
                           WHERE facultyAccount = '" . $_SESSION['userId'] . "';";
    $resultFacultyStatus = $conn->query($sqlFacultyStatus);
    $facultyStatus = mysqli_fetch_row($resultFacultyStatus);

    //faculty department
    $sqlFacultyDept = "SELECT facultyDepartment
                           FROM registration_system.faculty
                           WHERE facultyAccount = '" . $_SESSION['userId'] . "';";
    $resultFacultyDept = $conn->query($sqlFacultyDept);
    $facultyDept = mysqli_fetch_row($resultFacultyDept);

    //faculty grades enabled
    $sqlGradesEnabled = "WITH LogMidterm AS
       (
         SELECT CASE
                  WHEN NOW() >= semesterStartDate + INTERVAL 44 DAY
                    AND NOW() <= semesterStartDate + INTERVAL 58 DAY
                    THEN 'enabled'
                  ELSE 'disabled' END AS midterm
         FROM registration_system.semester
         WHERE semester.semesterName = '2019 Spring'
       ),
     LogFinal AS
       (
         SELECT CASE
                  WHEN NOW() >= semesterEndDate - INTERVAL 7 DAY
                    AND NOW() <= semesterEndDate + INTERVAL 7 DAY
                    THEN 'enabled'
                  ELSE 'disabled' END AS final
         FROM registration_system.semester
         WHERE semester.semesterName = '2019 Spring'
       )
SELECT midterm,
       final
FROM LogMidterm,
     LogFinal;";
    $resultGradesEnabled = $conn->query($sqlGradesEnabled);
    $gradesEnabled = mysqli_fetch_assoc($resultGradesEnabled);

    //faculty grade windows
    $sqlGradeWindows = "SELECT semesterStartDate + INTERVAL 44 DAY AS midtermStart,
                                   semesterStartDate + INTERVAL 58 DAY AS midtermEnd,
                                   semesterEndDate - INTERVAL 7 DAY    AS finalStart,
                                   semesterEndDate + INTERVAL 7 DAY    AS finalEnd
                            FROM registration_system.semester
                            WHERE semester.semesterName = '" . $_SESSION['currentSemester'] . "';";
    $resultGradeWindows = $conn->query($sqlGradeWindows);
    $gradeWindows = mysqli_fetch_assoc($resultGradeWindows);

    //current date
    $sqlToday = "SELECT CURRENT_DATE AS today;";
    $resultToday = $conn->query($sqlToday);
    $today = mysqli_fetch_row($resultToday);

    //faculty messages
    $sqlFacultyMessages = "SELECT messageSender, messageReceiver, messageSubject, messageBody, messageTime
                               FROM registration_system.message
                               WHERE messageReceiver = '" . $_SESSION['userId'] . "'
                               ORDER BY messageTime DESC;";
    $resultFacultyMessages = mysqli_fetch_all($conn->query($sqlFacultyMessages), MYSQLI_ASSOC);
}
