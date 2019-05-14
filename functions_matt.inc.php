<?php

    function viewAdminCourseCatalog(mysqli $conn, $courseType): void
    {
        $descriptionColumn = 5;
        $sql = "SELECT c.courseName                                     AS courseTitle,
                  CONCAT(CONCAT(d.departmentTag, ' '), c.courseNumber)  AS courseNumber,
                  c.courseSubject,
                  c.courseCredits, ";

        $sql .= "c.courseAttribute, ";

        $sql .= "c.courseDescription
            FROM registration_system.department d,
                registration_system.course c
            WHERE d.departmentName LIKE c.courseSubject
            ORDER BY c.courseSubject, c.courseNumber";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql))
        {
            header("Location: ../cc_" . strtolower($courseType) . ".php?error=sqlError");
            exit();
        }
        else
        {
            mysqli_stmt_execute($statement);
            $sqlResult = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($sqlResult))
            {
                //define table attributes
                $containerId = "adaccounts-table-container";
                $tableId = "ac-table-courses";
                $caption = "All Courses";
                $rowClick = "onclick=\"updateCourseDescription(this, 'cc-description-text', " . $descriptionColumn . ")\"";
                //generate html table
                drawTableFromSQL($sqlResult, $containerId, $tableId, $caption, $rowClick);
            }
            else
            {
                header("Location: cc_" . strtolower($courseType) . ".php");
                exit();
            }
        }
    }

