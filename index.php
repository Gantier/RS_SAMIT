<?php
    require "header.php";
?>

<?php
    if (!isset($_SESSION['userId']))
    {
        require "includes/dbh.inc.php";
        $sqlCurrentSemester = "SELECT semesterName
                                FROM registration_system.semester
                                WHERE semesterEndDate > CURRENT_DATE
                                  AND semesterStartDate < CURRENT_DATE;";
        $_SESSION['currentSemester'] = loadSqlResultFirstRow($conn, $sqlCurrentSemester, $current_page);
        $sqlNextSemester = "SELECT semesterName
                            FROM registration_system.semester
                            WHERE semesterStartDate > CURRENT_DATE
                            LIMIT 1;";
        $_SESSION['nextSemester'] = loadSqlResultFirstRow($conn, $sqlNextSemester, $current_page);

        echo '<div class="card login-card"><div class="card-title login-title">SAMIT Account Login</div>
                    <form action="includes/login.inc.php" method="post">
                    <input class="form-text-field" type="text" name="email" placeholder="email@samit.edu"><br>
                    <input class="form-text-field" type="password" name="pwd" placeholder="password"><br>
                    <button class="big-button material primary" type="submit" name="login-submit">Login</button>
                    </form></div>';
    }
    else
    {
        header("Location: " . $_SESSION['userType'] . "_home.php?error=loggedInRedirected");
    }
?>

<img class="background" src="images/college3Cropped.jpg" alt="collegeCampus">

<?php
    require "footer.php";
?>
