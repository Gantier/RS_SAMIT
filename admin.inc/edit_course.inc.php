<?php
session_start();

require "../constants.inc.php";
require "../globals.inc.php";
require "../functions.inc.php";
require "../functions_matt.inc.php";

if (isset($_POST['edit-course-submit'])) //This might have to be modified in the future once there are more edit buttons besides password
{
    require "../dbh.inc.php";

    //EDIT COURSE VARIABLES
    $courseSelectedName = $_POST['ac-edit-course-title'];

    $courseNewName = $_POST['ac-edit-course-new-title'];
    $courseDesc = $_POST['ac-course-desc'];
    $courseSubject = $_POST['ac-edit-course-subject'];
    $courseAttribute = $_POST['ac-edit-course-attribute'];
    $courseNumber = $_POST['ac-edit-course-number'];
    $courseCredits = $_POST['ac-edit-course-credits'];

    /*
     *How this is going to work:
     * - Needs the ability to enter any number of fields and have the code know how to execute the right SQL query
     * - Going to do this by adding on to the query string in segments, variable by variable
     */

    //Validation
    //SKIPPING FOR NOW
    if (empty($courseSelectedName))
    {
        header("Location: ../admin_courses.php?error=EDIT_EMPTY_NAME_ERROR");
        exit();
    }
    else
    {
        $sqlEditCourseHeader = "UPDATE registration_system.course SET";

        $sqlEditCourseBody;

        if(!empty($courseNewName)) //NAME
        {
            $sqlEditCourseBody .= " courseName = '" . $courseNewName . "'";
        }
        if(!empty($courseDesc)) //DESCRIPTION
        {
            if(!empty($sqlEditCourseBody))
            {
                $sqlEditCourseBody .= ", courseDescription = '" . $courseDesc . "'";
            }
            else
            {
                $sqlEditCourseBody .= " courseDescription = '" . $courseDesc . "'";
            }
        }
        if($courseSubject != "null") //SUBJECT
        {
            if(!empty($sqlEditCourseBody))
            {
                $sqlEditCourseBody .= ", courseSubject = '" . $courseSubject . "'";
            }
            else
            {
                $sqlEditCourseBody .= " courseSubject = '" . $courseSubject . "'";
            }
        }
        if($courseAttribute != "null") //ATTRIBUTE
        {
            if(!empty($sqlEditCourseBody))
            {
                $sqlEditCourseBody .= ", courseAttribute = '" . $courseAttribute . "'";
            }
            else
            {
                $sqlEditCourseBody .= " courseAttribute = '" . $courseAttribute . "'";
            }
        }
        if(!empty($courseNumber)) //NUMBER
        {
            if(!empty($sqlEditCourseBody))
            {
                $sqlEditCourseBody .= ", courseNumber = '" . $courseNumber . "'";
            }
            else
            {
                $sqlEditCourseBody .= " courseNumber = '" . $courseNumber . "'";
            }
        }
        if(!empty($courseCredits)) //CREDITS
        {
            if(!empty($sqlEditCourseBody))
            {
                $sqlEditCourseBody .= ", courseCredits = " . $courseCredits . "";
            }
            else
            {
                $sqlEditCourseBody .= " courseCredits = " . $courseCredits . "";
            }
        }

        //Close the sql body
        $sqlEditCourseBody .= " WHERE courseName = '" . $courseSelectedName . "';";

        //Complete the sql string
        $sqlEditCourse = $sqlEditCourseHeader . $sqlEditCourseBody;

        //Execute the sql
        $statementEditCourse = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statementEditCourse, $sqlEditCourse))
        {
            header("Location: ../admin_courses.php?error=EDIT_SQL_ERROR");
            exit();
        }
        else
        {
            mysqli_stmt_execute($statementEditCourse);
            header("Location: ../../admin_courses.php");
        }

    }

}

