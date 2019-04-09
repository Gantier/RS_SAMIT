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
                              AND a.studentAccount LIKE '" . $_SESSION['userId'] . "';";
    $resultStudentAdvisers = mysqli_fetch_all($conn->query($sqlStudentAdvisers), MYSQLI_ASSOC);

    //student enrollments
    $sqlStudentEnrollments = "SELECT programName AS enrollmentProgram
                              FROM registration_system.enrollment
                              WHERE studentAccount LIKE '" . $_SESSION['userId'] . "';";
    $resultStudentEnrollments = mysqli_fetch_all($conn->query($sqlStudentEnrollments), MYSQLI_ASSOC);

    //student total credits
    $sqlStudentCredits = "SELECT SUM(c.courseCredits) AS totalCredits
                          FROM registration_system.registration r,
                               registration_system.course c,
                               registration_system.section s
                          WHERE r.studentAccount LIKE '" . $_SESSION['userId'] . "'
                            AND c.courseName = s.sectionCourse
                            AND s.sectionCRN = r.sectionCRN;";
    $resultStudentCredits = $conn->query($sqlStudentCredits);
    $studentCredits = mysqli_fetch_row($resultStudentCredits);
