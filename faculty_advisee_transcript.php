<?php
    require "header.php";

    echo '<img class="background" src="images/college3CroppedFade.jpg" alt="collegeCampus">';

    require "includes/dbh.inc.php";
    require "includes/faculty.inc/data.inc.php";

    require "includes/faculty.inc/view_advisee_transcript.inc.php";

    require "includes/messages.inc.php";

    require "footer.php";
