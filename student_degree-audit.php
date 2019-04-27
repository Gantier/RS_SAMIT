<?php
    require "header.php";

    echo '<img class="background" src="images/college3CroppedFade.jpg" alt="collegeCampus">';

    echo "<main id='student-inc-academics-da-container'>";

    require "includes/dbh.inc.php";
    require "includes/student.inc/data.inc.php";

    require "includes/student.inc/view_degree-audit.inc.php";

    echo "</main>";
