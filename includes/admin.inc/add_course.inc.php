<?php
session_start();

require "../constants.inc.php";
require "../globals.inc.php";
require "../functions.inc.php";
require "../functions_matt.inc.php";

if (isset($_POST['add-course-submit']))
{
    require "../dbh.inc.php";

    //Universal variables
    $courseTitle = $_POST['ac-course-title'];
    $courseSubject = $_POST['ac-course-subject-dropdown'];
    $courseAttribute = $_POST['ac-course-attribute-dropdown'];
    $courseNumber = $_POST['ac-add-course-number'];
    $courseCredits = $_POST['ac-add-course-credits'];
    $courseUndergrad = $_POST['ac-course-undergrad-dropdown'];

    /*THINGS TO VALIDATE:
     * 1. Empty fields/dropdowns
     * 2. Course Title must be unique
     * 3. Course Number must not be taken in the subject
     * 3.5 Credits are >= 1 && <= 6
     */

    /*THING TO HANDLE:
     *1. Putting the course title as the description by default
     */

    //Validation
    if (empty($courseTitle) || empty($courseCredits) || empty($courseNumber))
    {
        header("Location: ../admin_courses.php?error=emptyTextField");
        exit();
    }
    elseif (empty($courseSubject) || empty($courseAttribute) || empty($courseUndergrad))
    {
        header("Location: ../admin_courses.php?error=emptyDropdowns");
        exit();
    }
    else
    {
        //VALIDATION SECTION

        //1. Get all of the course titles that match the entered course title
        //$sqlGetAllCourseTitles = "SELECT courseName
                                  //FROM registration_system.course
                                  //WHERE courseName = '" . $courseTitle . "';";

        //$statementGetAllCourseTitles = mysqli_stmt_init($conn);
        //if (!mysqli_stmt_prepare($statementGetAllCourseTitles, $sqlGetAllCourseTitles))
        {
            //header("Location: ../admin_courses.php?error=getAllCoursesError1");
            //exit();
        }
        //else
        {
            //mysqli_stmt_execute($statementGetAllCourseTitles);
           /*header("Location: ../admin_courses.php?vars_TITLE_" . $courseTitle .
           "_NUMBER_" . $courseNumber .
           "_SUBJECT_" . $courseSubject .
           "_ATTRIBUTE_" . $courseAttribute .
           "_CREDITS_" . $courseCredits .
           "_UNDERG_" . $courseUndergrad);
           exit();*/
           //This is for testing if the variables were set properly
        }

        //validation above does not work yet, going to add actual functionality first

        //INSERT INTO COURSE TABLE
        //prepare sql query

        $sqlAddToCourseTable = "INSERT INTO registration_system.course (courseName, courseNumber, courseSubject, courseCredits, courseAttribute, courseDescription) 
                                  VALUES ('" . $courseTitle . "', 
                                  '" . $courseNumber . "', 
                                  '" . $courseSubject . "', 
                                  " . $courseCredits . ", 
                                  '" . $courseAttribute . "', 
                                  '" . $courseTitle . "');";

        $statementAddCourseToTable = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statementAddCourseToTable, $sqlAddToCourseTable))
        {
            header("Location: ../admin_courses.php?error=addToCourseTable_Error");
            exit();
        }
        else
        {
            mysqli_stmt_execute($statementAddCourseToTable);
            header("Location: ../../admin_courses.php");
        }

        /*
        //INSERT INTO ACCOUNT TABLE
        $statementAddAcc = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statementAddAcc, $sqlInsertAccount))
        {
            header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError1_" . $accountType);
            exit();
        }
        else
        {
            mysqli_stmt_execute($statementAddAcc);
        }

        //INSERT INTO ACCOUNT_TYPE TABLE
        if (!mysqli_stmt_prepare($statementAddAcc, $sqlInsertAccountType))
        {
            header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError2");
            exit();
        }
        else
        {
            mysqli_stmt_execute($statementAddAcc);
            header("Location: ../../admin_accounts_" . $accountType . ".php");
        }

        //STUDENT/FACULTY TABLE INSERTION
        if ($accountType == "faculty" || $accountType == "student")
        {
            if (!mysqli_stmt_prepare($statementAddAcc, $sqlInsertAccountUnique))
            {
                header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError3");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementAddAcc);
                header("Location: ../../admin_accounts_" . $accountType . ".php");
            }
        }

        //FACULTY TIME TABLE INSERTION
        if ($accountType == "faculty")
        {
            if (!mysqli_stmt_prepare($statementAddAcc, $sqlInsertAccountTime))
            {
                header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError4");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementAddAcc);
                header("Location: ../../admin_accounts_" . $accountType . ".php");
            }
        }

        //STUDENT ENROLLMENT TABLE INSERTION
        if ($accountType == "student")
        {
            if (!mysqli_stmt_prepare($statementAddAcc, $sqlInsertAccountEnroll))
            {
                header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError5");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementAddAcc);
                header("Location: ../../admin_accounts_" . $accountType . ".php");
            }
        }*/

    }

}
