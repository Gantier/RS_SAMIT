<?php
    require "header.php";

    echo "<div id=\"home-backdrop\"></div>";
    require "includes/student.inc/view-edit-password.inc.php";

    echo "<main id='student-inc-home-container'>";

    require "includes/dbh.inc.php";
    require "includes/student.inc/data.inc.php";

    echo '<div id="sh-schedule-container">';
    require "includes/student.inc/view_schedule.inc.php";
    echo '</div>';
    echo '<div id="sh-details-container">';
    require "includes/student.inc/view_account.inc.php";
    require "includes/student.inc/view_advisers.inc.php";
    echo '</div>';

    echo "</main>";

    require "includes/messages.inc.php";
    require "footer.php";
