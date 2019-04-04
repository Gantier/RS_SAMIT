<?php
    require "header.php";

    echo '<main id="cc-container">';

    require "includes/dbh.inc.php";
    $sql = "SELECT c.courseName,
                  CONCAT(CONCAT(d.departmentTag, ' '), c.courseNumber) AS courseNumber,
                  c.courseSubject,
                  c.courseCredits,
                  c.courseAttribute,
                  c.courseDescription
            FROM registration_system.department d,
                registration_system.course_undergraduate g,
                registration_system.course c
            WHERE g.courseUndergraduateName LIKE c.courseName
              AND d.departmentName LIKE c.courseSubject
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
            //define table attributes
            $containerId = "cc-table-container";
            $tableId = "cc-table";
            $caption = "Undergraduate Courses";
            $rowClick = "onclick=\"ccUpdateCourseDescription(this)\"";
            //generate html table
            table($result, $containerId, $tableId, $caption, $rowClick);
        }
        else
        {
            header("Location: cc_undergraduate.php");
            exit();
        }
    }

    require "includes/cc-console.inc.php";

    echo '</main>';

    require "footer.php";
