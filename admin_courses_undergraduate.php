<?php
require "header.php";

echo "<main id='admin.courses-container'>";

require "includes/dbh.inc.php";

viewAdminCourseCatalog($conn, "Undergraduate");

require "includes/admin.inc/ac-console-courses.inc.php";

echo "</main>";

require "footer.php";
