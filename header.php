<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SAMIT.edu</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <nav>
        <a href="index.php">Home</a>
        <div class="logout">
            <?php
                if (isset($_SESSION['userId']))
                {
                    echo '<form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form>';
                }
            ?>
        </div>
    </nav>
</header>
