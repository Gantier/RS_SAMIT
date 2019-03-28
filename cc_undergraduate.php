<?php
    require "header.php";

    require "includes/dbh.inc.php";

    $sql = "SELECT c.courseName, c.courseNumber, c.courseSubject, c.courseSubject, c.courseCredits, c.courseAttribute 
            FROM registration_system.course_undergraduate g, registration_system.course c 
            WHERE g.courseUndergraduateName LIKE c.courseName
            ORDER BY c.courseSubject, c.courseNumber";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $sql))
    {
        header("Location: ../cc_undergraduate.php?error=sqlError");
        exit();
    }
    else
    {
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        if ($row = mysqli_fetch_assoc($result))
        {
            $class = "cc";
            $caption = "Undergraduate Courses";
            require "includes/sql2html.inc.php";
        }
        else
        {
            header("Location: ../index.php?error=noData");
            exit();
        }
    }

    require "includes/update_cc_form.inc.php";

    require "footer.php";
