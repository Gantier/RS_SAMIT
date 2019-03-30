<?php
    require "header.php";

    require "includes/dbh.inc.php";

    //Old code, currently obsolete but saving just in case
    /*if (isset($_POST['cc-filter-submit']))
    {
        $keyword = $_POST['keyword'];

        if (!($_POST['range-min']))
        {
            $min = 0;
        }
        else
        {
            $min = $_POST['range-min'];
        }
        if (!($_POST['range-max']))
        {
            $max = PHP_INT_MAX;
        }
        else
        {
            $max = $_POST['range-max'];
        }

        $subject = $_POST['subject-dropdown'];
        $attribute = $_POST['attribute-dropdown'];

        if ($subject == "HiddenOption" && $attribute == "HiddenOption") //IF NO DROPDOWN IS NOT SELECTED
        {
            $sql = "SELECT c.courseName, CAST(c.courseNumber AS UNSIGNED) AS courseNumber, c.courseSubject, c.courseCredits, c.courseAttribute
                FROM registration_system.course_graduate g, registration_system.course c
                WHERE (g.courseGraduateName LIKE c.courseName) AND
                (c.courseName LIKE '%" . $keyword . "%' OR
                c.courseSubject LIKE '%" . $keyword . "%' OR
                c.courseAttribute LIKE '%" . $keyword . "%') AND
                (c.courseNumber >= $min AND c.courseNumber <= $max)
                ORDER BY c.courseSubject, c.courseNumber";

        }
        else //IF DROPDOWN IS SELECTED
        {
            $sql = "SELECT c.courseName, CAST(c.courseNumber AS UNSIGNED) AS courseNumber, c.courseSubject, c.courseCredits, c.courseAttribute
                FROM registration_system.course_graduate g, registration_system.course c
                WHERE (g.courseGraduateName LIKE c.courseName) AND
                (c.courseName LIKE '%" . $keyword . "%' OR
                c.courseSubject LIKE '%" . $keyword . "%' OR
                c.courseAttribute LIKE '%" . $keyword . "%') AND
                (c.courseNumber >= $min AND c.courseNumber <= $max) AND
                c.courseSubject LIKE '" . $subject . "'
                ORDER BY c.courseSubject, c.courseNumber";
        }
    }
    else
    {
        $sql = "SELECT c.courseName, c.courseNumber, c.courseSubject, c.courseCredits, c.courseAttribute
                FROM registration_system.course_graduate g, registration_system.course c
                WHERE g.courseGraduateName LIKE c.courseName
                ORDER BY c.courseSubject, c.courseNumber";
    }*/

    //Sequential construction of sql query:

    if (isset($_POST['cc-filter-submit']))
    {
        //Step 0: Guaranteed part of sql
        $sql = "SELECT c.courseName, c.courseNumber, c.courseSubject, c.courseCredits, c.courseAttribute 
                FROM registration_system.course_graduate g, registration_system.course c 
                WHERE (g.courseGraduateName LIKE c.courseName)";

        //Step 1: Check KEYWORD search
        $keyword = $_POST['keyword'];
        if (!(empty($keyword)))
        {
            $sql .= " AND
                (c.courseName LIKE '%" . $keyword . "%' OR
                c.courseSubject LIKE '%" . $keyword . "%' OR
                c.courseAttribute LIKE '%" . $keyword . "%') ";
        }

        //Step 2: Check RANGES
        $min = $_POST['range-min'];
        $max = $_POST['range-max'];

        if (empty($min))
        {
            $min = 0;
        }
        if (empty($max))
        {
            $max = PHP_INT_MAX;
        }

        /*Potential optimization. This would save one SQL condition,
        but add one PHP condition. Not sure how that works
        out realistically, so this is omitted for now.

        if(both $min and $max are empty)
        {
            don't touch the sql
        }
        else
        {
            add condition to sql
        }
        */

        $sql .= " AND (c.courseNumber >= $min AND c.courseNumber <= $max) ";

        //Step 3: Check SUBJECT dropdown
        $subject = $_POST['subject-dropdown'];

        if ($subject != "HiddenOption")
        {
            $sql .= " AND c.courseSubject LIKE '" . $subject . "' ";
        }

        //Step 4: Check ATTRIBUTE dropdown
        $attribute = $_POST['attribute-dropdown'];

        if ($attribute != "HiddenOption")
        {
            $sql .= " AND c.courseAttribute LIKE '" . $attribute . "' ";
        }

        //Step Final: Guaranteed closing part of sql
        $sql = $sql . " ORDER BY c.courseSubject, c.courseNumber";
    }
    else
    {
        $sql = "SELECT c.courseName, c.courseNumber, c.courseSubject, c.courseCredits, c.courseAttribute 
                FROM registration_system.course_graduate g, registration_system.course c 
                WHERE g.courseGraduateName LIKE c.courseName
                ORDER BY c.courseSubject, c.courseNumber";
    }

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
            $caption = "Graduate Courses";
            require "includes/sql2html.inc.php";
        }
        else
        {
            header("Location: cc_graduate.php");
            exit();
        }
    }

    require "includes/cc-filter.inc.php";

    require "footer.php";
