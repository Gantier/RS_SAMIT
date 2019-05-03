<?php
require "header.php";

echo '<main id="cc-container">';

require "includes/dbh.inc.php";

?>

    <form action="researcher_courses_graduate.php" method="post">
        <div class="card-title">Courses For Graduates</div>
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


    $sql = "SELECT 
sec.sectionCourse as Courses,
s.studentStatus as Status, 
COUNT(*) as T_Students,
Sum(finalGrade)/COUNT(finalGrade) AS AverageGPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount 
LEFT JOIN registration_system.section sec on sec.sectionCRN = r.sectionCRN 
INNER JOIN registration_system.course_graduate cg on cg.courseGraduateName = sec.sectionCourse 
WHERE  s.studentStatus ='active'  
GROUP by sec.sectionCourse 
order BY T_Students ";


    if ($Program == "Most Popular" or $Program == "Least Popular") {
        if ($Program == "Most Popular")
            $sql = $sql . 'DESC';

        $run = mysqli_query($conn, $sql);

        if ($run == true) {

            ?>

            <table>
                <tr>

                    <th>Courses</th>
                    <th>No of Enrollments</th>
                    <th>Average Course GPA</th>


                </tr>

                <?php
                while ($data = mysqli_fetch_assoc($run)) {
                    $counter++;

                    ?>
                    <tr>

                        <td><?php echo $data['Courses']; ?></td>
                        <td><?php echo $data['T_Students']; ?></td>
                        <td><?php echo round($data['AverageGPA'], 2); ?></td>

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



