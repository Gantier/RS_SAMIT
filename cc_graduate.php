<?php
    require "header.php";

    require "includes/dbh.inc.php";

    $sql = "SELECT c.courseName, c.courseNumber, c.courseSubject, c.courseSubject, c.courseCredits, c.courseAttribute 
            FROM registration_system.course_graduate g, registration_system.course c 
            WHERE g.courseGraduateName LIKE c.courseName
            ORDER BY c.courseSubject";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $sql))
    {
        header("Location: ../cc_graduate.php?error=sqlError");
        exit();
    }
    else
    {
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        if ($row = mysqli_fetch_assoc($result))
        {
            $class = "cc";
            require "includes/sql2html.inc.php";
        }
        else
        {
            header("Location: ../index.php?error=noUser");
            exit();
        }
    }

    require "footer.php";
