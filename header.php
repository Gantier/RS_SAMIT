<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SAMIT.edu</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
        <div>
            <?php
                if (isset($_SESSION['userId']))
                {
                    echo '<form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form>';
                }
                else
                {
                    echo '<form action="includes/login.inc.php" method="post">
                    <input type="text" name="email" placeholder="email@samit.edu">
                    <input type="password" name="pwd" placeholder="password">
                    <button type="submit" name="login-submit">Login</button>
                </form>';
                }
            ?>
        </div>
    </nav>
</header>
