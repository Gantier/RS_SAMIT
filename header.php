<?php
session_start();
$current_page = preg_replace("[/RS_SAMIT/]", "", "$_SERVER[REQUEST_URI]");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SAMIT.edu</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="stylesheets/style.css">
    <script src="javascripts/functions.js"></script>
</head>
<header>

</header>
<nav>
    <?php

    if (isset($_SESSION['userId']))
    {
        switch ($_SESSION['userType'])
        {
            case 'student':
                {
                    echo '<ul class="nav-bar">';

                    //HOME
                    echo '<li class="';
                    if (preg_match("[student_home]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="student_home.php">Student Home</a></li> ';

                    //COURSE CATALOG
                    echo '<li class="dropdown';
                    if (preg_match("[cc_undergraduate]", $current_page) || preg_match("[cc_graduate]", $current_page))
                    {
                        echo " nav-bar-active";
                    }
                    echo '"><a href="javascript:void(0)" class="drop-button">Course Catalog</a>';
                    echo '<div class="dropdown-content">';
                    echo '<a class="dropdown-anchor" href="cc_undergraduate.php">Undergraduate</a>';
                    echo '<a class="dropdown-anchor" href="cc_graduate.php">Graduate</a></div></li>';

                    //MASTER SCHEDULE
                    echo '<li class="';
                    if (preg_match("[master_schedule]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="master_schedule.php">Master Schedule</a></li> ';

                    //REGISTRATION
                    echo '<li class="';
                    if (preg_match("[student_registration]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="student_registration.php">Registration</a></li> ';

                    //ACADEMICS
                    echo '<li class="';
                    if (preg_match("[student_academics]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="student_academics.php">Academics</a></li> ';

                    //LOGOUT
                    echo '<form action="includes/logout.inc.php" method="post">
                        <button class="logout-button" type="submit" name="logout-submit">Logout</button>
                        </form>';

                    echo '</ul>';
                    break;
                }
            case 'faculty':
                {
                    echo '<ul class="nav-bar">';

                    //HOME
                    echo '<li class="';
                    if (preg_match("[faculty_home]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="faculty_home.php">Faculty Home</a></li> ';

                    //COURSE CATALOG
                    echo '<li class="dropdown';
                    if (preg_match("[cc_undergraduate]", $current_page) || preg_match("[cc_graduate]", $current_page))
                    {
                        echo " nav-bar-active";
                    }
                    echo '"><a href="javascript:void(0)" class="drop-button">Course Catalog</a>';
                    echo '<div class="dropdown-content">';
                    echo '<a class="dropdown-anchor" href="cc_undergraduate.php">Undergraduate</a>';
                    echo '<a class="dropdown-anchor" href="cc_graduate.php">Graduate</a></div></li>';

                    //MASTER SCHEDULE
                    echo '<li class="';
                    if (preg_match("[master_schedule]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="master_schedule.php">Master Schedule</a></li> ';

                    //ACADEMICS
                    echo '<li class="';
                    if (preg_match("[faculty_academics]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="faculty_academics.php">Academics</a></li> ';

                    //LOGOUT
                    echo '<form action="includes/logout.inc.php" method="post">
                        <button class="logout-button" type="submit" name="logout-submit">Logout</button>
                        </form>';

                    echo '</ul>';
                    break;
                }
            case 'admin':
                {
                    echo '<ul class="nav-bar">';

                    //HOME
                    echo '<li class="';
                    if (preg_match("[admin_home]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="admin_home.php">Admin Home</a></li> ';

                    //COURSE CATALOG
                    echo '<li class="dropdown';
                    if (preg_match("[cc_undergraduate]", $current_page) || preg_match("[cc_graduate]", $current_page))
                    {
                        echo " nav-bar-active";
                    }
                    echo '"><a href="javascript:void(0)" class="drop-button">Course Catalog</a>';
                    echo '<div class="dropdown-content">';
                    echo '<a class="dropdown-anchor" href="cc_undergraduate.php">Undergraduate</a>';
                    echo '<a class="dropdown-anchor" href="cc_graduate.php">Graduate</a></div></li>';

                    //MASTER SCHEDULE
                    echo '<li class="';
                    if (preg_match("[master_schedule]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="master_schedule.php">Master Schedule</a></li> ';

                    //ACCOUNTS
                    echo '<li class="';
                    if (preg_match("[admin_accounts]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="admin_accounts.php">Accounts</a></li> ';

                    //COURSES
                    echo '<li class="';
                    if (preg_match("[admin_courses]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="admin_courses.php">Courses</a></li> ';

                    //SECTIONS
                    echo '<li class="';
                    if (preg_match("[admin_sections]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="admin_sections.php">Sections</a></li> ';

                    //REGISTRATION
                    echo '<li class="';
                    if (preg_match("[admin_registration]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="admin_registration.php">Registration</a></li> ';

                    //LOGOUT
                    echo '<form action="includes/logout.inc.php" method="post">
                        <button class="logout-button" type="submit" name="logout-submit">Logout</button>
                        </form>';

                    echo '</ul>';
                    break;
                }
            case 'researcher':
                {
                    echo '<ul class="nav-bar">';
                    echo '<li class="';
                    if (preg_match("[researcher_home]", $current_page))
                    {
                        echo "nav-bar-active";
                    }
                    echo '"><a href="researcher_home.php">Researcher Home</a></li> ';
                    echo '<li class="dropdown';
                    if (preg_match("[cc_undergraduate]", $current_page) || preg_match("[cc_graduate]", $current_page))
                    {
                        echo " nav-bar-active";
                    }
                    echo '"><a href="javascript:void(0)" class="drop-button">Course Catalog</a>';
                    echo '<div class="dropdown-content">';
                    echo '<a class="dropdown-anchor" href="cc_undergraduate.php">Undergraduate</a>';
                    echo '<a class="dropdown-anchor" href="cc_graduate.php">Graduate</a></div></li>';

                    echo '<form action="includes/logout.inc.php" method="post">
                        <button class="logout-button" type="submit" name="logout-submit">Logout</button>
                        </form>';

                    echo '</ul>';
                    break;
                }
        }
    }
    else
    {
        echo '<ul class="nav-bar">';
        echo '<li class="';
        if (preg_match("[index]", $current_page))
        {
            echo "nav-bar-active";
        }
        echo '"><a href="index.php">Home</a></li> ';
        echo '<li class="dropdown';
        if (preg_match("[cc_undergraduate]", $current_page) || preg_match("[cc_graduate]", $current_page))
        {
            echo " nav-bar-active";
        }
        echo '"><a href="javascript:void(0)" class="drop-button">Course Catalog</a>';
        echo '<div class="dropdown-content">';
        echo '<a class="dropdown-anchor" href="cc_undergraduate.php">Undergraduate</a>';
        echo '<a class="dropdown-anchor" href="cc_graduate.php">Graduate</a></div></li>';
        if (isset($_SESSION['userId']))
        {
            echo '<form action="includes/logout.inc.php" method="post">
                        <button class="logout-button" type="submit" name="logout-submit">Logout</button>
                        </form>';
        }
        echo '</ul>';
    }
    ?>
</nav>


