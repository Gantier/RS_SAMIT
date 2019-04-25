<?php

function viewAdminCourseCatalog(mysqli $conn, $courseType): void
{
    $descriptionColumn = 4;
    $sql = "SELECT c.courseName                                     AS courseTitle,
                  CONCAT(CONCAT(d.departmentTag, ' '), c.courseNumber)  AS courseNumber,
                  c.courseSubject,
                  c.courseCredits, ";
    if (strtolower($courseType) === strtolower(Constants::UNDERGRADUATE))
    {
        $sql .= "c.courseAttribute, ";
        $descriptionColumn = 5;
    }
    $sql .= "c.courseDescription
            FROM registration_system.department d,
                registration_system.course_" . strtolower($courseType) . " g,
                registration_system.course c
            WHERE g.course" . $courseType . "Name LIKE c.courseName
              AND d.departmentName LIKE c.courseSubject
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
            $caption = $courseType . " Courses";
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

