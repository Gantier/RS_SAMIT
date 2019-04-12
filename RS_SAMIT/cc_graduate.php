<?php
    require "header.php";

    echo '<main id="cc-container">';

    require "includes/dbh.inc.php";

    viewCourseCatalog($conn, "Graduate");

    require "includes/cc-console.inc.php";

    echo '</main>';

    require "footer.php";
