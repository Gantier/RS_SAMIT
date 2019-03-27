<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SAMIT.edu</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<header>

</header>
<nav>

    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Course Catalog</a>
            <div class="dropdown-content">
                <a href="cc_under.php">Undergraduate</a>
                <a href="cc_graduate.php">Graduate</a>
            </div>
        </li>

        <?php
        if (isset($_SESSION['userId']))
        {
            echo '<form action="includes/logout.inc.php" method="post">
                    <button class="logout-button" type="submit" name="logout-submit">Logout</button>
                </form>';
        }
        ?>

    </ul>

</nav>


