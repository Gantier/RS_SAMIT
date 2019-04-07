<?php
    require "header.php";

    echo "<main id='student.inc-home-container'>";

    require "includes/student.inc/data.inc.php";

    require "includes/welcome.inc.php";
    require "includes/student.inc/view_account.inc.php";
    require "includes/student.inc/view_schedule.inc.php";
    require "includes/student.inc/view_advisers.inc.php";

    echo "</main>";

    require "footer.php";
