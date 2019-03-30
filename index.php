<?php
    require "header.php";
?>

<body class="index">
    <?php
        if (!isset($_SESSION['userId']))
        {
            echo '<div class="card login-card"><div class="card-title login-title">SAMIT Account Login</div>
                    <form action="includes/login.inc.php" method="post">
                    <input class="form-text-field" type="text" name="email" placeholder="email@samit.edu"><br>
                    <input class="form-text-field" type="password" name="pwd" placeholder="password"><br>
                    <button class="big-button material primary" type="submit" name="login-submit">Login</button>
                    </form></div>';
        }
    ?>
</body>

<?php
    require "footer.php";
?>
