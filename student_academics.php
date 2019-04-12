<?php
    require "header.php";

    echo "<main id='student.inc-home-container'>";

    require "includes/dbh.inc.php";
    require "includes/student.inc/data.inc.php";

    require "includes/student.inc/view_grades.php";

    echo "</main>";

    require "footer.php";
