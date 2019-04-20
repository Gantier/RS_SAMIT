<?php
    session_start();

    require "../constants.inc.php";
    require "../globals.inc.php";
    require "../functions.inc.php";
    require "../functions_alex.inc.php";

    if (isset($_POST['register-submit']))
    {
        require '../dbh.inc.php';
        require 'data.inc.php';

        $entry0 = $_POST['sr-entry0'];
        $entry1 = $_POST['sr-entry1'];
        $entry2 = $_POST['sr-entry2'];

        //get courses and schedules for active registrations in next semester
        $sqlActiveRegistrations = "SELECT s.sectionCourse,
                                      CONCAT(s.sectionStartTime, s.sectionSchedule) AS sectionSchedule
                                FROM registration_system.registration r,
                                     registration_system.section s
                                WHERE r.studentAccount = '" . $_SESSION['userId'] . "'
                                  AND r.sectionCRN = s.sectionCRN
                                  AND s.sectionSemester = '" . $_SESSION['nextSemester'] . "';";
        $resultActiveRegistrations = mysqli_fetch_all($conn->query($sqlActiveRegistrations), MYSQLI_ASSOC);

        //get student total credits for next semester
        $sqlStudentCreditsNextSemester = "SELECT SUM(c.courseCredits) AS totalCredits
                          FROM registration_system.registration r,
                               registration_system.course c,
                               registration_system.section s
                          WHERE r.studentAccount = '" . $_SESSION['userId'] . "'
                            AND c.courseName = s.sectionCourse
                            AND s.sectionCRN = r.sectionCRN
                            AND s.sectionSemester = '" . $_SESSION['nextSemester'] . "';";
        $resultStudentCreditsNextSemester = $conn->query($sqlStudentCreditsNextSemester);
        $studentCreditsNextSemester = mysqli_fetch_row($resultStudentCreditsNextSemester);

        //if selection 0 not empty
        if (!empty($entry0))
        {
            //get section details to validate registration (course title and course schedule)
            $sqlSection0 = "SELECT s.sectionCourse,
                                       CONCAT(s.sectionStartTime, s.sectionSchedule) AS sectionSchedule
                                FROM registration_system.section s
                                WHERE s.sectionCRN = " . $entry0 . ";";
            $resultSection0 = $conn->query($sqlSection0);
            $section0 = mysqli_fetch_assoc($resultSection0);

            //get room availability
            $sqlSectionAvailability0 = "WITH LogActual AS
                                                       (
                                                         SELECT COUNT(*) AS actual
                                                         FROM registration reg
                                                         WHERE sectionCRN = " . $entry0 . "
                                                       )
                                                SELECT CASE
                                                         WHEN actual < r.roomCapacity THEN 'available'
                                                         ELSE 'full' END AS sectionAvailability
                                                FROM section s,
                                                     room r,
                                                     LogActual
                                                WHERE s.sectionCRN = " . $entry0 . "
                                                  AND s.sectionRoom = r.roomNumber;";
            $resultSectionAvailability0 = $conn->query($sqlSectionAvailability0);
            $sectionAvailability0 = mysqli_fetch_row($resultSectionAvailability0);

            //validate
            $valid = true;
            $errors0 = "Errors...\n";

            //check if at max credits
            if ($studentCreditsNextSemester[0] >= $_SESSION['maxSemesterCredits'])
            {
                $valid = false;
                $errors0 .= "At max credits\n";
            }

            //check for account hold
            if (isset($studentHold))
            {
                if ($studentHold[0] !== "none")
                {
                    $valid = false;
                    $errors0 .= "Account hold\n";
                }
            }

            //check for course or scheduling conflicts
            foreach ($resultActiveRegistrations as &$activeRegistration)
            {
                if ($activeRegistration['sectionCourse'] === $section0['sectionCourse'] ||
                    $activeRegistration['sectionSchedule'] === $section0['sectionSchedule'])
                {
                    $valid = false;
                    $errors0 .= "Schedule/course conflict\n";
                    break;
                }
            }

            //check section capacity/availability
            if ($sectionAvailability0[0] === "full")
            {
                $valid = false;
                $errors0 .= "Section full\n";
            }

            //check prerequisites...
            if (!studentSatisfiesPreReqsOfCourse($conn, $preReqArray, $_SESSION['userId'], $section0['sectionCourse']))
            {
                $valid = false;
                $errors0 .= "Unsatisfied Prerequisites\n";
            }

            if ($valid)
            {
                $sqlInsertRegistration0 = "INSERT INTO registration_system.registration
                                              VALUES ('" . $_SESSION['userId'] . "', " . $entry0 . ", NULL, NULL, CURRENT_DATE);";
                if ($conn->query($sqlInsertRegistration0) === true)
                {
                    //send message of successful registration to student account
                    $sqlInsertRegistrationMessage0 = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                    VALUES ('" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['SR_SUCCESS'] . "', '" . Constants::MESSAGE_BODS['SR_SUCCESS'] .
                        $section0['sectionCourse'] . ", section " . $entry0 . ".');";
                    $conn->query($sqlInsertRegistrationMessage0);
                }
            }
            else
            {
                //send message of failed registration to student account
                $sqlFailedRegistrationMessage0 = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                    VALUES ('" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['SR_FAIL'] . "', '" . Constants::MESSAGE_BODS['SR_FAIL'] .
                    $section0['sectionCourse'] . ", section " . $entry0 . ".\n\n" . $errors0 . "');";
                $conn->query($sqlFailedRegistrationMessage0);
            }

            //update relevant information for next query
            $resultActiveRegistrations = mysqli_fetch_all($conn->query($sqlActiveRegistrations), MYSQLI_ASSOC);

            $resultStudentCreditsNextSemester = $conn->query($sqlStudentCreditsNextSemester);
            $studentCreditsNextSemester = mysqli_fetch_row($resultStudentCreditsNextSemester);
        }

        //if selection 1 not empty
        if (!empty($entry1))
        {
            //get section details to validate registration (course title and course schedule)
            $sqlSection1 = "SELECT s.sectionCourse,
                                       CONCAT(s.sectionStartTime, s.sectionSchedule) AS sectionSchedule
                                FROM registration_system.section s
                                WHERE s.sectionCRN = " . $entry1 . ";";
            $resultSection1 = $conn->query($sqlSection1);
            $section1 = mysqli_fetch_assoc($resultSection1);

            //get room availability
            $sqlSectionAvailability1 = "WITH LogActual AS
                                                       (
                                                         SELECT COUNT(*) AS actual
                                                         FROM registration reg
                                                         WHERE sectionCRN = " . $entry1 . "
                                                       )
                                                SELECT CASE
                                                         WHEN actual < r.roomCapacity THEN 'available'
                                                         ELSE 'full' END AS sectionAvailability
                                                FROM section s,
                                                     room r,
                                                     LogActual
                                                WHERE s.sectionCRN = " . $entry1 . "
                                                  AND s.sectionRoom = r.roomNumber;";
            $resultSectionAvailability1 = $conn->query($sqlSectionAvailability1);
            $sectionAvailability1 = mysqli_fetch_row($resultSectionAvailability1);

            //validate
            $valid = true;
            $errors1 = "Errors...\n";

            //check if at max credits
            if ($studentCreditsNextSemester[0] >= $_SESSION['maxSemesterCredits'])
            {
                $valid = false;
                $errors1 .= "At max credits\n";
            }

            //check for account hold
            if (isset($studentHold))
            {
                if ($studentHold[0] !== "none")
                {
                    $valid = false;
                    $errors1 .= "Account hold\n";
                }
            }

            //check for course or scheduling conflicts
            foreach ($resultActiveRegistrations as &$activeRegistration)
            {
                if ($activeRegistration['sectionCourse'] === $section1['sectionCourse'] ||
                    $activeRegistration['sectionSchedule'] === $section1['sectionSchedule'])
                {
                    $valid = false;
                    $errors1 .= "Schedule/course conflict\n";
                    break;
                }
            }

            //check section capacity/availability
            if ($sectionAvailability1[0] === "full")
            {
                $valid = false;
                $errors1 .= "Section full\n";
            }

            //check prerequisites...
            if (!studentSatisfiesPreReqsOfCourse($conn, $preReqArray, $_SESSION['userId'], $section1['sectionCourse']))
            {
                $valid = false;
                $errors1 .= "Unsatisfied Prerequisites\n";
            }

            if ($valid)
            {
                $sqlInsertRegistration1 = "INSERT INTO registration_system.registration
                                              VALUES ('" . $_SESSION['userId'] . "', " . $entry1 . ", NULL, NULL, CURRENT_DATE);";
                if ($conn->query($sqlInsertRegistration1) === true)
                {
                    //send message of successful registration to student account
                    $sqlInsertRegistrationMessage1 = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                    VALUES ('" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['SR_SUCCESS'] . "', '" . Constants::MESSAGE_BODS['SR_SUCCESS'] .
                        $section1['sectionCourse'] . ", section " . $entry1 . ".');";
                    $conn->query($sqlInsertRegistrationMessage1);
                }
            }
            else
            {
                //send message of failed registration to student account
                $sqlFailedRegistrationMessage1 = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                    VALUES ('" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['SR_FAIL'] . "', '" . Constants::MESSAGE_BODS['SR_FAIL'] .
                    $section1['sectionCourse'] . ", section " . $entry1 . ".\n\n" . $errors1 . "');";
                $conn->query($sqlFailedRegistrationMessage1);
            }

            //update relevant information for next query
            $resultActiveRegistrations = mysqli_fetch_all($conn->query($sqlActiveRegistrations), MYSQLI_ASSOC);

            $resultStudentCreditsNextSemester = $conn->query($sqlStudentCreditsNextSemester);
            $studentCreditsNextSemester = mysqli_fetch_row($resultStudentCreditsNextSemester);
        }

        //if selection 2 not empty
        if (!empty($entry2))
        {
            //get section details to validate registration (course title and course schedule)
            $sqlSection2 = "SELECT s.sectionCourse,
                                       CONCAT(s.sectionStartTime, s.sectionSchedule) AS sectionSchedule
                                FROM registration_system.section s
                                WHERE s.sectionCRN = " . $entry2 . ";";
            $resultSection2 = $conn->query($sqlSection2);
            $section2 = mysqli_fetch_assoc($resultSection2);

            //get room availability
            $sqlSectionAvailability2 = "WITH LogActual AS
                                                       (
                                                         SELECT COUNT(*) AS actual
                                                         FROM registration reg
                                                         WHERE sectionCRN = " . $entry2 . "
                                                       )
                                                SELECT CASE
                                                         WHEN actual < r.roomCapacity THEN 'available'
                                                         ELSE 'full' END AS sectionAvailability
                                                FROM section s,
                                                     room r,
                                                     LogActual
                                                WHERE s.sectionCRN = " . $entry2 . "
                                                  AND s.sectionRoom = r.roomNumber;";
            $resultSectionAvailability2 = $conn->query($sqlSectionAvailability2);
            $sectionAvailability2 = mysqli_fetch_row($resultSectionAvailability2);

            //validate
            $valid = true;
            $errors2 = "Errors...\n";

            //check if at max credits
            if ($studentCreditsNextSemester[0] >= $_SESSION['maxSemesterCredits'])
            {
                $valid = false;
                $errors2 .= "At max credits\n";
            }

            //check for account hold
            if (isset($studentHold))
            {
                if ($studentHold[0] !== "none")
                {
                    $valid = false;
                    $errors2 .= "Account hold\n";
                }
            }

            //check for course or scheduling conflicts
            foreach ($resultActiveRegistrations as &$activeRegistration)
            {
                if ($activeRegistration['sectionCourse'] === $section2['sectionCourse'] ||
                    $activeRegistration['sectionSchedule'] === $section2['sectionSchedule'])
                {
                    $valid = false;
                    $errors2 .= "Schedule/course conflict\n";
                    break;
                }
            }

            //check section capacity/availability
            if ($sectionAvailability2[0] === "full")
            {
                $valid = false;
                $errors2 .= "Section full\n";
            }

            //check prerequisites...
            if (!studentSatisfiesPreReqsOfCourse($conn, $preReqArray, $_SESSION['userId'], $section2['sectionCourse']))
            {
                $valid = false;
                $errors2 .= "Unsatisfied Prerequisites\n";
            }

            if ($valid)
            {
                $sqlInsertRegistration2 = "INSERT INTO registration_system.registration
                                              VALUES ('" . $_SESSION['userId'] . "', " . $entry2 . ", NULL, NULL, CURRENT_DATE);";
                if ($conn->query($sqlInsertRegistration2) === true)
                {
                    //send message of successful registration to student account
                    $sqlInsertRegistrationMessage2 = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                    VALUES ('" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['SR_SUCCESS'] . "', '" . Constants::MESSAGE_BODS['SR_SUCCESS'] .
                        $section2['sectionCourse'] . ", section " . $entry2 . ".');";
                    $conn->query($sqlInsertRegistrationMessage2);
                }
            }
            else
            {
                //send message of failed registration to student account
                $sqlFailedRegistrationMessage2 = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                    VALUES ('" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['SR_FAIL'] . "', '" . Constants::MESSAGE_BODS['SR_FAIL'] .
                    $section2['sectionCourse'] . ", section " . $entry2 . ".\n\n" . $errors2 . "');";
                $conn->query($sqlFailedRegistrationMessage2);
            }
        }

        header("Location: ../../student_home.php");
        exit();
    }
