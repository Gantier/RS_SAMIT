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

    //student transcript as separate semesters (associative array)
    $studentTranscript = array();
