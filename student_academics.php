<?php
    require "header.php";

    echo "<main id='student-inc-academics-container'>";

    require "includes/dbh.inc.php";
    require "includes/student.inc/data.inc.php";

    require "includes/student.inc/view_transcript.inc.php";
    require "includes/student.inc/da-console.inc.php";

    echo "</main>";

    require "footer.php";
