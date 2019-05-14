<?php
    session_start();

    require "../constants.inc.php";
    require "../globals.inc.php";
    require "../functions.inc.php";
    require "../functions_matt.inc.php";

    if (isset($_POST['delete-course-submit']))
    {
        require "../dbh.inc.php";

        //Universal variables
        $courseName = $_POST['ac-delete-course-title'];

        //Validation
        if (empty($courseName))
        {
            header("Location: ../admin_courses.php?error=emptyCourseNameField");
            exit();
        }
        else
        {
            $sqlDeleteCourse = "DELETE FROM registration_system.course
                                          WHERE courseName = '" . $courseName . "';";

            //DELETE FROM ACCOUNT TABLE
            $statementDeleteCourse = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statementDeleteCourse, $sqlDeleteCourse))
            {
                header("Location: ../admin_courses.php?error=SQL_ERROR");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementDeleteCourse);
                header("Location: ../../admin_courses.php");
            }
        }
    }
