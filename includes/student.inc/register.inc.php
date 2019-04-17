<?php
session_start();

require "../constants.inc.php";
require "../globals.inc.php";
require "../functions.inc.php";
require "../functions_alex.inc.php";

if (isset($_POST['register-submit']))
{
    require '../dbh.inc.php';

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

    $entry0 = $_POST['sr-entry0'];
    $entry1 = $_POST['sr-entry1'];
    $entry2 = $_POST['sr-entry2'];

    $activityLog = "log=";
    if (!empty($entry0) && $studentCreditsNextSemester[0] < $_SESSION['maxSemesterCredits'])
    {
        //get section details to validate registration
        $sqlSection0 = "SELECT s.sectionCourse,
                               CONCAT(s.sectionStartTime, s.sectionSchedule) AS sectionSchedule
                        FROM registration_system.section s
                        WHERE s.sectionCRN = " . $entry0 . ";";
        $resultSection0 = $conn->query($sqlSection0);
        $section0 = mysqli_fetch_assoc($resultSection0);

        $valid = true;
        //check for course or scheduling conflicts
        foreach ($resultActiveRegistrations as &$activeRegistration)
        {
            if ($activeRegistration['sectionCourse'] === $section0['sectionCourse'] ||
                $activeRegistration['sectionSchedule'] === $section0['sectionSchedule'])
            {
                $valid = false;
            }
        }

        //check prerequisites...

        {
            if ($valid)
            {
                $sqlInsertRegistration0 = "INSERT INTO registration_system.registration
                                      VALUES ('" . $_SESSION['userId'] . "', " . $entry0 . ", NULL, NULL, CURRENT_DATE);";
                if ($conn->query($sqlInsertRegistration0) === true)
                {
                    $activityLog .= "INSERTED";
                    $sqlInsertRegistrationMessage = "INSERT INTO registration_system.message (messageSubject, messageBody)
                                      VALUES ('Registration Success', 'Student account " . $_SESSION['userId'] .
                        " has been successfully registered for " .
                        $section0['sectionCourse'] .
                        " section " . $entry0 . "');";
                    $conn->query($sqlInsertRegistrationMessage);
                }
                else
                {
                    $activityLog .= "FAILED";
                }
                $activityLog .= $entry0 . "=valid,";
            }
            else
            {
                $activityLog .= $entry0 . "=invalid,";
            }
        }

        //send message of successful/failed registration to student account

        //update relevant information for next query
        $resultActiveRegistrations = mysqli_fetch_all($conn->query($sqlActiveRegistrations), MYSQLI_ASSOC);

        $resultStudentCreditsNextSemester = $conn->query($sqlStudentCreditsNextSemester);
        $studentCreditsNextSemester = mysqli_fetch_row($resultStudentCreditsNextSemester);
    }

    if (!empty($entry1) && $studentCreditsNextSemester[0] < $_SESSION['maxSemesterCredits'])
    {
        //get section details to validate registration
        $sqlSection1 = "SELECT s.sectionCourse,
                               CONCAT(s.sectionStartTime, s.sectionSchedule) AS sectionSchedule
                        FROM registration_system.section s
                        WHERE s.sectionCRN = " . $entry1 . ";";
        $resultSection1 = $conn->query($sqlSection1);
        $section1 = mysqli_fetch_assoc($resultSection1);

        $valid = true;
        //check for course or scheduling conflicts
        foreach ($resultActiveRegistrations as &$activeRegistration)
        {
            if ($activeRegistration['sectionCourse'] === $section1['sectionCourse'] ||
                $activeRegistration['sectionSchedule'] === $section1['sectionSchedule'])
            {
                $valid = false;
            }
        }

        //check prerequisites...

        if ($valid)
        {
            $sqlInsertRegistration1 = "INSERT INTO registration_system.registration
                                      VALUES ('" . $_SESSION['userId'] . "', " . $entry1 . ", NULL, NULL, CURRENT_DATE);";
            if ($conn->query($sqlInsertRegistration1) === true)
            {
                $activityLog .= "INSERTED";
            }
            else
            {
                $activityLog .= "FAILED";
            }
            $activityLog .= $entry1 . "=valid,";
        }
        else
        {
            $activityLog .= $entry1 . "=invalid,";
        }

        //send message of successful/failed registration to student account

        //update relevant information for next query
        $resultActiveRegistrations = mysqli_fetch_all($conn->query($sqlActiveRegistrations), MYSQLI_ASSOC);

        $resultStudentCreditsNextSemester = $conn->query($sqlStudentCreditsNextSemester);
        $studentCreditsNextSemester = mysqli_fetch_row($resultStudentCreditsNextSemester);
    }

    if (!empty($entry2) && $studentCreditsNextSemester[0] < $_SESSION['maxSemesterCredits'])
    {
        //get section details to validate registration
        $sqlSection2 = "SELECT s.sectionCourse,
                               CONCAT(s.sectionStartTime, s.sectionSchedule) AS sectionSchedule
                        FROM registration_system.section s
                        WHERE s.sectionCRN = " . $entry2 . ";";
        $resultSection2 = $conn->query($sqlSection2);
        $section2 = mysqli_fetch_assoc($resultSection2);

        $valid = true;
        //check for course or scheduling conflicts
        foreach ($resultActiveRegistrations as &$activeRegistration)
        {
            if ($activeRegistration['sectionCourse'] === $section2['sectionCourse'] ||
                $activeRegistration['sectionSchedule'] === $section2['sectionSchedule'])
            {
                $valid = false;
            }
        }

        //check prerequisites...

        if ($valid)
        {
            $sqlInsertRegistration2 = "INSERT INTO registration_system.registration
                                      VALUES ('" . $_SESSION['userId'] . "', " . $entry2 . ", NULL, NULL, CURRENT_DATE);";
            if ($conn->query($sqlInsertRegistration2) === true)
            {
                $activityLog .= "INSERTED";
            }
            else
            {
                $activityLog .= "FAILED";
            }
            $activityLog .= $entry2 . "=valid";
        }
        else
        {
            $activityLog .= $entry2 . "=invalid";
        }

        //send message of successful/failed registration to student account

    }

    header("Location: ../../student_home.php?" . $activityLog);
    exit();
}
