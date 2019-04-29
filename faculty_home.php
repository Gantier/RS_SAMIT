<?php
    require "header.php";
    require "includes/dbh.inc.php";
    require "includes/faculty.inc/data.inc.php";

    echo "<div id=\"home-backdrop\"></div>";
    require "includes/faculty.inc/view_edit-password.inc.php";

    echo "<main id='faculty-inc-home-container'>";

    echo '<div id="fh-schedule-container">';
    require "includes/faculty.inc/view_schedule.inc.php";
    echo '</div>';
    echo '<div id="fh-details-container">';
    require "includes/faculty.inc/view_account.inc.php";
    require "includes/faculty.inc/view_advisees.inc.php";
    echo '</div>';

    echo "</main>";

    echo '<img class="background" src="images/college3CroppedFade.jpg" alt="collegeCampus">';

    require "includes/messages.inc.php";

    require "footer.php";
