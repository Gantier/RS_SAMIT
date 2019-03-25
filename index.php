<?php
    require "header.php";
?>

<main>
    <?php
        if (!isset($_SESSION['userId']))
        {
            echo '<div class="login"><form action="includes/login.inc.php" method="post">
                    <input class="form-text-field" type="text" name="email" placeholder="email@samit.edu"><br>
                    <input class="form-text-field" type="password" name="pwd" placeholder="password"><br>
                    <button type="submit" name="login-submit">Login</button>
                </form></div>';
        }
    ?>
</main>

<?php
    require "footer.php";
?>
