<?php
    require "header.php";

    echo "<div id=\"home-backdrop\"></div>";
    require "includes/admin.inc/view_edit-password.inc.php";

    require "includes/dbh.inc.php";
    require "includes/admin.inc/data.inc.php";

    //<main>
    require "includes/welcome.inc.php";
    //</main>

    require "includes/admin.inc/view_account.inc.php";
    require "includes/messages.inc.php";

    echo '<img class="background" src="images/college3CroppedFade.jpg" alt="collegeCampus">';

    require "footer.php";
