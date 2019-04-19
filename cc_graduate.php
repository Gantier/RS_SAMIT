<?php
    require "header.php";

    echo '<main id="cc-container">';

    require "includes/dbh.inc.php";
    require "includes/student.inc/data.inc.php";

    viewCourseCatalog($conn, "Graduate", $preReqArray);

    require "includes/cc-console.inc.php";

    echo '</main>';
