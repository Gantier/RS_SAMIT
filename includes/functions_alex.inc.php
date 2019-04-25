<?php
    require "globals.inc.php";
    /**
     * @param mysqli $conn
     * @param $sqlQuery
     * @param $current_page
     * @return string result
     */
    function loadSqlResultFirstRow(mysqli $conn, $sqlQuery, $current_page)
    {
        $statement = mysqli_stmt_init($conn);

        //if valid sql
        if (!mysqli_stmt_prepare($statement, $sqlQuery))
        {
            header("Location: " . $current_page . "?error=sqlError");
            exit();
        }
        else
        {
            mysqli_stmt_execute($statement);
            $sqlResult = mysqli_stmt_get_result($statement);

            //if results not empty
            if ($row = mysqli_fetch_row($sqlResult))
            {
                return $row[0];
            }
            else
            {
                header("Location: " . $current_page . "?error=noData");
                exit();
            }
        }
    }

    function viewTableFromSQL(mysqli $conn, $sql, $current_page, $containerId, $tableId, $caption, $rowClick): void
    {
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql))
        {
            header("Location: " . $current_page . "?error=sqlError");
            exit();
        }
        else
        {
            mysqli_stmt_execute($statement);
            $sqlResult = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($sqlResult))
            {
                //define table rowClick
                $rowClick = "onclick=\"" . $rowClick . "\"";
                //generate html table
                drawTableFromSQL($sqlResult, $containerId, $tableId, $caption, $rowClick);
            }
            else
            {
                header("Location: " . $current_page);
                exit();
            }
        }
    }
