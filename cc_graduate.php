<?php
require "header.php";

require "includes/dbh.inc.php";

if (isset($_POST['cc-filter-submit']))
{
    //Keyword
    $keyword = $_POST['keyword'];

    //Range
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

    //Subject

    // WRITE THE SQL STATEMENT SEQUENTIALLY
    
    $subject = $_POST['subject-dropdown'];
    $attribute = $_POST['attribute-dropdown'];

    if($subject == "HiddenOption" && $attribute == "HiddenOption") //IF NO DROPDOWN IS NOT SELECTED
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

require "includes/update_cc_form.inc.php";

require "footer.php";
