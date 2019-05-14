<?php
session_start();

require "../constants.inc.php";
require "../globals.inc.php";
require "../functions.inc.php";
require "../functions_matt.inc.php";

if (isset($_POST['add-section-submit']))
{
    require "../dbh.inc.php";

    //Universal variables
    $courseName = $_POST['ac-add-sec-course-name'];
    $sectionInstructor = $_POST['ac-add-section-instructor'];
    $sectionRoom = $_POST['ac-add-section-room-no'];
    $sectionDays = $_POST['ac-add-section-days'];
    $sectionSemester = $_SESSION['nextSemester'];

    $sectionTime = $_POST['ac-add-section-time'];
    switch($sectionTime)
    {
        case "8:00 AM - 9:30 AM":
            $sectionStart = "8:00 AM";
            $sectionEnd = "9:30 AM";
            break;
        case "9:40 AM - 11:10 AM":
            $sectionStart = "9:40 AM";
            $sectionEnd = "11:10 AM";
            break;
        case "11:20 AM - 12:50 PM":
            $sectionStart = "11:20 AM";
            $sectionEnd = "12:50 PM";
            break;
        case "1:00 PM - 2:30 PM":
            $sectionStart = "1:00 PM";
            $sectionEnd = "2:30 PM";
            break;
        case "2:40 PM - 4:10 PM":
            $sectionStart = "2:40 PM";
            $sectionEnd = "4:10 PM";
            break;
        case "4:20 PM - 5:50 PM":
            $sectionStart = "4:20 PM";
            $sectionEnd = "5:50 PM";
            break;
        case "6:00 PM - 7:30 PM":
            $sectionStart = "6:00 PM";
            $sectionEnd = "7:30 PM";
            break;
        case "7:40 PM - 9:10 PM":
            $sectionStart = "7:40 PM";
            $sectionEnd = "9:10 PM";
            break;
    }

    //MUST CALCULATE CRN BASED ON CURRENT HIGHEST CRN + 1
    //USER CAN INPUT SECTION NUMBER, DUPLICATE WOULD BE LOGICAL ERROR, WOULDN'T CREATE ACTUAL PROBLEM

    //Validation
    //Skipping for now
    if (empty($courseName))
    {
        header("Location: ../../admin_sections.php_EMPTY_FIELDS_ERROR");
        exit();
    }
    else
    {
        //Calculate new CRN
        $sqlCalculateCRN = "SELECT MAX(sectionCRN) FROM registration_system.section;";
        $resultCRN = $conn -> query($sqlCalculateCRN);
        $fetcherCRN = $resultCRN -> fetch_assoc();
        $newCRN = $fetcherCRN["MAX(sectionCRN)"] + 1;

        //Calculate new Section Number
        $sqlCalculateSecNum = "SELECT MAX(sectionNumber) 
                                FROM registration_system.section 
                                WHERE sectionSemester = '2019 Fall' 
                                  AND sectionCourse = '" . $courseName . "';";
        $resultSecNum = $conn -> query($sqlCalculateSecNum);
        $fetcherSecNum = $resultSecNum ->fetch_assoc();
        if(empty($fetcherSecNum["MAX(sectionNumber)"]))
        {
            $newSecNum = 1;
        }
        else
        {
            $newSecNum = $fetcherSecNum["MAX(sectionNumber)"] + 1;
        }

        //INSERT INTO SECTION TABLE
        $sqlAddSection = "INSERT INTO registration_system.section (sectionCRN, sectionNumber, sectionSemester, sectionCourse, sectionInstructor, sectionRoom, sectionStartTime, sectionEndTime, sectionSchedule) 
                                  VALUES (" . $newCRN . ", 
                                  " . $newSecNum . ", 
                                  '" . $sectionSemester . "', 
                                  '" . $courseName . "', 
                                  '" . $sectionInstructor . "', 
                                  " . $sectionRoom . ", 
                                  '" . $sectionStart . "', 
                                  '" . $sectionEnd . "', 
                                  '" . $sectionDays . "');";

        $statementAddSection = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statementAddSection, $sqlAddSection))
        {
            header("Location: ../admin_sections.php?error=addSection_Error");
            exit();
        }
        else
        {
            mysqli_stmt_execute($statementAddSection);
            header("Location: ../../admin_sections.php");
        }


    }

}
