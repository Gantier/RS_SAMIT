<?php
    session_start();

    require "../constants.inc.php";
    require "../globals.inc.php";
    require "../functions.inc.php";
    require "../functions_alex.inc.php";

    if (isset($_POST['add-to-section-submit']))
    {
        require '../dbh.inc.php';
        require 'data.inc.php';

        //$sectionCRN = $_POST['sr-entry0'];

        //Matt vars
        $studentEmail = $_POST['ac-add-to-section-email'];
        $sectionCRN = $_POST['ac-add-to-section-crn'];

        //get courses and schedules for active registrations in next semester
        $sqlActiveRegistrations = "SELECT s.sectionCourse,
                                      CONCAT(s.sectionStartTime, s.sectionSchedule) AS sectionSchedule
                                FROM registration_system.registration r,
                                     registration_system.section s
                                WHERE r.studentAccount = '" . $studentEmail . "'
                                  AND r.sectionCRN = s.sectionCRN
                                  AND s.sectionSemester = '" . $_SESSION['nextSemester'] . "';";
        $resultActiveRegistrations = mysqli_fetch_all($conn->query($sqlActiveRegistrations), MYSQLI_ASSOC);

        //get student total credits for next semester
        $sqlStudentCreditsNextSemester = "SELECT SUM(c.courseCredits) AS totalCredits
                          FROM registration_system.registration r,
                               registration_system.course c,
                               registration_system.section s
                          WHERE r.studentAccount = '" . $studentEmail . "'
                            AND c.courseName = s.sectionCourse
                            AND s.sectionCRN = r.sectionCRN
                            AND s.sectionSemester = '" . $_SESSION['nextSemester'] . "';";
        $resultStudentCreditsNextSemester = $conn->query($sqlStudentCreditsNextSemester);
        $studentCreditsNextSemester = mysqli_fetch_row($resultStudentCreditsNextSemester);

        //if selection 0 not empty
        if (!empty($sectionCRN))
        {
            //get section details to validate registration (course title and course schedule)
            $sqlSection0 = "SELECT s.sectionCourse,
                                       CONCAT(s.sectionStartTime, s.sectionSchedule) AS sectionSchedule
                                FROM registration_system.section s
                                WHERE s.sectionCRN = " . $sectionCRN . ";";
            $resultSection0 = $conn->query($sqlSection0);
            $section0 = mysqli_fetch_assoc($resultSection0);

            //get room availability
            $sqlSectionAvailability0 = "WITH LogActual AS
                                                       (
                                                         SELECT COUNT(*) AS actual
                                                         FROM registration reg
                                                         WHERE sectionCRN = " . $sectionCRN . "
                                                       )
                                                SELECT CASE
                                                         WHEN actual < r.roomCapacity THEN 'available'
                                                         ELSE 'full' END AS sectionAvailability
                                                FROM section s,
                                                     room r,
                                                     LogActual
                                                WHERE s.sectionCRN = " . $sectionCRN . "
                                                  AND s.sectionRoom = r.roomNumber;";
            $resultSectionAvailability0 = $conn->query($sqlSectionAvailability0);
            $sectionAvailability0 = mysqli_fetch_row($resultSectionAvailability0);

            //validate
            $valid = true;
            $errors0 = "Errors...\n";

            //check if at max credits
            /*This is not a good fix but for some reason the session variable for max credits
            was failing to show up here*/
            if ($studentCreditsNextSemester[0] >= 18)
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
            if (!studentSatisfiesPreReqsOfCourse($conn, $preReqArray, $studentEmail, $section0['sectionCourse']))
            {
                $valid = false;
                $errors0 .= "Unsatisfied Prerequisites\n";
            }

            if ($valid)
            {
                $sqlInsertRegistration0 = "INSERT INTO registration_system.registration
                                              VALUES ('" . $studentEmail . "', " . $sectionCRN . ", NULL, NULL, CURRENT_DATE);";
                if ($conn->query($sqlInsertRegistration0) === true)
                {
                    //send message of successful registration to student account
                    $sqlInsertRegistrationMessage0 = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                    VALUES ('" . $studentEmail . "', '" . Constants::MESSAGE_SUBS['SR_SUCCESS'] . "', '" . Constants::MESSAGE_BODS['SR_SUCCESS'] .
                        $section0['sectionCourse'] . ", section " . $sectionCRN . ".');";
                    $conn->query($sqlInsertRegistrationMessage0);
                }
            }
            else
            {
                //send message of failed registration to student account
                $sqlFailedRegistrationMessage0 = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                    VALUES ('" . $studentEmail . "', '" . Constants::MESSAGE_SUBS['SR_FAIL'] . "', '" . Constants::MESSAGE_BODS['SR_FAIL'] .
                    $section0['sectionCourse'] . ", section " . $sectionCRN . ".\n\n" . $errors0 . "');";
                $conn->query($sqlFailedRegistrationMessage0);
            }

            //update relevant information for next query
            $resultActiveRegistrations = mysqli_fetch_all($conn->query($sqlActiveRegistrations), MYSQLI_ASSOC);

            $resultStudentCreditsNextSemester = $conn->query($sqlStudentCreditsNextSemester);
            $studentCreditsNextSemester = mysqli_fetch_row($resultStudentCreditsNextSemester);
        }

        header("Location: ../../admin_registration_student.php");
        exit();
    }
