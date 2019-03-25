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
    <ul class="nav-bar">
        <li class="nav-bar"><a class="nav-bar active" href="index.php">Home</a></li>
        <li class="nav-bar"><a class="nav-bar">Course Catalog</a></li>
        <li class="nav-bar"><a class="nav-bar">Master Schedule</a></li>
        <li class="nav-bar"><a class="nav-bar">About</a></li>
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


