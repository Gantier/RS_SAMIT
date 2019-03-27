<?php
require "header.php";
require "includes/cc.inc.php";
require "includes/dbh.inc.php";

$sql = "SELECT c.courseName, c.courseNumber, c.courseSubject, c.courseSubject, c.courseCredits, c.courseAttribute 
FROM registration_system.course_undergraduate g, registration_system.course c 
WHERE g.courseUndergraduateName LIKE c.courseName
ORDER BY c.courseSubject";
$statement = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($statement, $sql))
{
    header("Location: ../cc_graduate.php?error=sqlError");
    exit();
}
else
{
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    if ($row = mysqli_fetch_assoc($result))
    {
        /*echo "<table>";
        echo "<tr><th>Name</th><th>Number</th><th>Subject</th><th>Credits</th><th>Attribute</th></tr>";

        while($row = mysqli_fetch_array($result)) {
            $courseName = $row['courseName'];
            $courseNumber= $row['courseNumber'];
            $courseSubject = $row['courseSubject'];
            $courseCredits= $row['courseCredits'];
            $courseAttribute= $row['courseAttribute'];
            echo "<tr><td>".$courseName."</td><td>".$courseNumber."</td><td>".$courseSubject."</td><td>".$courseCredits."</td><td>".$courseAttribute."</td></tr>";
        }

        echo "</table>";*/

        function table( $result ) {
            $result->fetch_array( MYSQLI_ASSOC );
            echo '<table>';
            tableHead( $result );
            tableBody( $result );
            echo '</table>';
        }

        function tableHead( $result ) {
            echo '<thead>';
            foreach ( $result as $x ) {
                echo '<tr>';
                foreach ( $x as $k => $y ) {
                    echo '<th>' . preg_replace("[course]", "", $k) . '</th>'; //THIS IS LAZY FIX LATER
                }
                echo '</tr>';
                break;
            }
            echo '</thead>';
        }

        function tableBody( $result ) {
            echo '<tbody>';
            foreach ( $result as $x ) {
                echo '<tr>';
                foreach ( $x as $y ) {
                    echo '<td>' . $y . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody>';
        }

        table($result);
    }
    else
    {
        header("Location: ../index.php?error=noUser");
        exit();
    }


}
require "footer.php";