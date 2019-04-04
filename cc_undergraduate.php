<?php
    require "header.php";

    echo '<main id="cc-container">';

    require "includes/dbh.inc.php";

    getCourseCatalog($conn, "Undergraduate");

    require "includes/cc-console.inc.php";

    echo '</main>';

    require "footer.php";
