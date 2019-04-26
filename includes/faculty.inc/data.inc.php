<?php
    if (isset($_SESSION['userId']))
    {

        if ($_SESSION['facultyType'] === 'Full-time')//full-time
        {
            //faculty advisees
            $sqlFacultyAdvisees = "SELECT CONCAT(CONCAT(CONCAT(s.studentFirstName, ' '),
                                                        CONCAT(SUBSTR(s.studentMiddleName, 1, 1), '. ')),
                                                 s.studentLastName) AS adviseeName,
                                          s.studentAccount          AS adviseeContact
                                   FROM registration_system.student s,
                                        registration_system.adviser a
                                   WHERE s.studentAccount = a.studentAccount
                                     AND a.facultyAccount = '" . $_SESSION['userId'] . "';";
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

        //faculty messages
        $sqlFacultyMessages = "SELECT messageSender, messageReceiver, messageSubject, messageBody, messageTime
                               FROM registration_system.message
                               WHERE messageReceiver = '" . $_SESSION['userId'] . "'
                               ORDER BY messageTime DESC;";
        $resultFacultyMessages = mysqli_fetch_all($conn->query($sqlFacultyMessages), MYSQLI_ASSOC);
    }
