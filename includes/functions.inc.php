<?php

    function drawTableFromSQL($sqlResult, $containerId, $tableId, $caption, $rowClick)
    {
        echo '<div id="' . $containerId . '"><table  id="' . $tableId . '"><caption>' . $caption . '</caption>';
        tableHead($sqlResult);
        tableBody($sqlResult, $tableId, $rowClick);
        echo '</table></div>';
    }

    function tableHead($result)
    {
        echo '<thead>';
        foreach ($result as $x)
        {
            echo '<tr>';
            foreach ($x as $k => $y)
            {
                echo '<th>' . preg_replace("[^[a-z]+]", "", $k) . '</th>';
            }
            echo '</tr>';
            break;
        }
        echo '</thead>';
    }

    function tableBody($result, $tableId, $rowClick)
    {
        echo '<tbody>';
        foreach ($result as $x)
        {
            $printRow = '<tr class="' . $tableId . '" ';
            if ($rowClick)
            {
                $printRow .= $rowClick;
            }
            $printRow .= ">";
            echo $printRow;
            foreach ($x as $y)
            {
                echo '<td>' . $y . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
    }

    function drawBasicTableFromSQL($sqlResult, $tableClass)
    {
        echo '<table  class="basic';
        if ($tableClass !== "")
        {
            echo ' ' . $tableClass;
        }
        echo '" id="' . $tableClass . '"';
        tableHeadBasic($sqlResult);
        tableBodyBasic($sqlResult);
        echo '</table>';
    }

    function tableHeadBasic($result)
    {
        echo '<thead>';
        foreach ($result as $x)
        {
            echo '<tr>';
            foreach ($x as $k => $y)
            {
                echo '<th>' . preg_replace("[^[a-z]+]", "", $k) . '</th>';
            }
            echo '</tr>';
            break;
        }
        echo '</thead>';
    }

    function tableBodyBasic($result)
    {
        echo '<tbody>';
        foreach ($result as $x)
        {
            echo '<tr>';
            foreach ($x as $y)
            {
                echo '<td>' . $y . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
    }

    function viewCourseCatalog(mysqli $conn, $courseType): void
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
                $containerId = "cc-table-container";
                $tableId = "cc-table";
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

