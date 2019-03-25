<?php
    require "header.php";
?>

<main>
    <?php
        if (isset($_SESSION['userId']))
        {
            echo '<p>You are logged in!</p><br>' . print_r($_SESSION);//prints session variables
        }
        else
        {
            echo '<p>You are logged out!</p>';
        }
    ?>
</main>

<?php
    require "footer.php";
?>
