<?php
require "header.php";

echo '<main id="cc-container">';

require "includes/dbh.inc.php";

?>

    <form action="researcher_programs_minor.php" method="post">
        <div class="card-title">Minor Programs</div>
        <hr>
        <table>
            <tr>
                <th>Program</th>
            </tr>
            <tr>
                <td><label for="attribute-dropdown"></label>
                    <select id="attribute-dropdown" name="1">
                        <option value="null" selected hidden>Select ...</option>
                        <option value="Most Popular">Most Popular</option>
                        <option value="Least Popular">Least Popular</option>

                    </select></td>
            </tr>
        </table>
        <div align="center">
            <input class="small-button outlined secondary" type="submit" value="Reset"/>
            <input class="small-button outlined secondary" type="submit" value="Search" name="Search"/>
        </div>
    </form>

<?php


function executeQuery(mysqli $conn): void
{
    $counter = 0;

    $Program = $_POST['1'];


    $sql = "SELECT e.programName as Program, COUNT(*) AS T_Student
FROM registration_system.student s
left join registration_system.enrollment e on s.studentAccount = e.studentAccount 
INNER JOIN registration_system.program_minor pm on e.programName = pm.programMinorName 
WHERE s.studentStatus='active' 
GROUP BY e.programName ORDER BY T_Student ";


    if ($Program == "Most Popular" or $Program == "Least Popular") {
        if ($Program == "Most Popular")
            $sql = $sql . 'DESC';

        $run = mysqli_query($conn, $sql);

        if ($run == true) {

            ?>

            <table>
                <tr>

                    <th>Program</th>
                    <th>Number of Enrollments</th>


                </tr>

                <?php
                while ($data = mysqli_fetch_assoc($run)) {
                    $counter++;

                    ?>
                    <tr>

                        <td><?php echo $data['Program']; ?></td>
                        <td><?php echo $data['T_Student']; ?></td>

                    </tr>


                    <?php

                }

                ?>
                <tr>
                    <div class="card-title"><?php echo 'Total Record: ' . $counter; ?></div>
                    <hr>
                </tr>
            </table>
            <hr><?php


        }


    } else {

        ?>

        <div class="card-title"><?php echo 'First Select option from list' ?></div>

        <?php

    }


}

if (isset($_POST['Search'])) {


    executeQuery($conn);
}


require "footer.php";



