<?php

require "header.php";
echo '<main id="cc-container">';
require "includes/dbh.inc.php";
require_once "includes/functions.inc.php";

?>

    <form action="researcher_faculty.php" method="post">

        <div class="card-title">Faculty</div>

        <hr>


        <table>

            <tr>
                <th>Gender</th>
                <th>Academic</th>
                <th>Courses</th>
            </tr>
            <tr>
                <td><label for="subject-dropdown"></label>
                    <select id="subject-dropdown" name="1">
                        <option value="null" selected hidden>Select Gender...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="General">General</option>

                    </select></td>
                <td><label for="attribute-dropdown"></label>
                    <select id="attribute-dropdown" name="2">
                        <option value="null" selected hidden>Select...</option>
                        <option value="Pass/Fail By Courses">Pass/Fail By Courses</option>
                        <option value="Pass/Fail By Instructors">Pass/Fail By Instructors</option>


                    </select></td>

                <td><label for="attribute-dropdown"></label>
                    <select id="attribute-dropdown" name="3">
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
    $a = "Courses";
    $counter = 0;
    $Faculty_Gender = $_POST['1'];
    $Academic = $_POST['2'];
    $Courses = $_POST['3'];


    echo "<label class='card-title'>Search Criteria: ";
    if ($Faculty_Gender != 'null')
        echo $Faculty_Gender . ", ";
    if ($Academic != 'null')
        echo $Academic . ", ";

    if ($Courses != 'null')
        echo $Courses . " Courses";
    echo '</label>';


    $sql1 = "SELECT Name, Gender , Status, FacultyAC, COUNT(Course) as NoOfCourses , GROUP_CONCAT(Course) as CourseNames from (SELECT DISTINCT 
CONCAT(CONCAT(CONCAT(CONCAT(f.facultyFirstName, ' '), f.facultyMiddleName),' '),f.facultyLastName) AS Name, 
(CASE WHEN f.facultyGender = 'M' THEN 'Male' WHEN f.facultyGender = 'F' THEN 'Female' END) AS Gender , 
f.facultyStatus as Status, f.facultyAccount as FacultyAC, s.sectionCourse as Course 
FROM registration_system.faculty f 
LEFT JOIN registration_system.section s on f.facultyAccount = s.sectionInstructor 
WHERE f.facultyStatus='active' 
ORDER BY facultyAC ASC) AS SUBQUERY
WHERE Status = 'active'
GROUP by Name";

    $sql2 = "SELECT sec.sectionCourse AS Courses, 
sum(r.finalGrade >= 2) as T_Pass, 
sum(r.finalGrade < 2) as T_Fail, 
COUNT(r.finalGrade) as T_Student, 
(sum(r.finalGrade >= 2)/COUNT(r.finalGrade))*100 AS PassPercentage, 
(sum(r.finalGrade < 2)/COUNT(r.finalGrade))*100 AS FailPercentage 
FROM registration_system.registration r 
LEFT JOIN registration_system.section sec on r.sectionCRN = sec.sectionCRN 
LEFT JOIN registration_system.student s on r.studentAccount = s.studentAccount 
LEFT JOIN registration_system.faculty f on sec.sectionInstructor = f.facultyAccount 
WHERE s.studentStatus = 'active'
GROUP BY sec.sectionCourse
ORDER by sec.sectionCourse";

    $sql3 = "SELECT
sec.sectionCourse as Courses,
s.studentStatus as Status, 
COUNT(*) as T_Students,
Sum(finalGrade)/COUNT(*) AS AverageGPA
FROM registration_system.faculty f
LEFT JOIN registration_system.section sec on f.facultyAccount = sec.sectionInstructor
LEFT JOIN registration_system.registration r on sec.sectionCRN = r.sectionCRN
LEFT JOIN registration_system.student s on s.studentAccount = r.studentAccount 
WHERE  s.studentStatus ='active'
GROUP by sec.sectionCourse 
order BY T_Students ";

    $sql4 = "SELECT 
f.facultyAccount, sec.sectionInstructor, (CASE WHEN f.facultyGender = 'M' THEN 'Male' WHEN f.facultyGender = 'F' THEN 'Female' END) AS Instructors,
sum(r.finalGrade >= 2) as T_Pass,
sum(r.finalGrade < 2) as T_Fail,
COUNT(r.finalGrade) as T_Student,
(sum(r.finalGrade >= 2)/COUNT(r.finalGrade))*100 AS PassPercentage,
(sum(r.finalGrade < 2)/COUNT(r.finalGrade))*100 AS FailPercentage
from registration_system.section sec
LEFT JOIN registration_system.faculty f on sec.sectionInstructor = f.facultyAccount
left JOIN registration_system.registration r on r.sectionCRN = sec.sectionCRN
WHERE f.facultyStatus ='active'
GROUP BY f.facultyAccount";


    if ($Faculty_Gender == "Male") {

        $temp = " WHERE f.facultyGender = 'M' AND ";
        $sql1 = substr_replace($sql1, $temp, strpos($sql1, "WHERE"), strlen("WHERE"));
        $sql2 = substr_replace($sql2, $temp, strpos($sql2, "WHERE"), strlen("WHERE"));
        $sql3 = substr_replace($sql3, $temp, strpos($sql3, "WHERE"), strlen("WHERE"));
        $sql4 = substr_replace($sql4, $temp, strpos($sql4, "WHERE"), strlen("WHERE"));


//        $temp = " WHERE s.studentGender='M' AND ";
//        $sql2 = substr_replace($sql2, $temp, strpos($sql2, "WHERE"), strlen("WHERE"));
//        $sql3 = substr_replace($sql3, $temp, strpos($sql3, "WHERE"), strlen("WHERE"));


    }

    if ($Faculty_Gender == "Female") {

        $temp = " WHERE f.facultyGender = 'F' AND ";
        $sql1 = substr_replace($sql1, $temp, strpos($sql1, "WHERE"), strlen("WHERE"));
        $sql2 = substr_replace($sql2, $temp, strpos($sql2, "WHERE"), strlen("WHERE"));
        $sql3 = substr_replace($sql3, $temp, strpos($sql3, "WHERE"), strlen("WHERE"));
        $sql4 = substr_replace($sql4, $temp, strpos($sql4, "WHERE"), strlen("WHERE"));

//        $temp = " WHERE s.studentGender='F' AND ";
//        $sql2 = substr_replace($sql2, $temp, strpos($sql2, "WHERE"), strlen("WHERE"));
//        $sql3 = substr_replace($sql3, $temp, strpos($sql3, "WHERE"), strlen("WHERE"));

    }


    if ($Courses != "null") {

        if ($Courses == "Most Popular")
            $sql3 .= " DESC";


        $run = mysqli_query($conn, $sql3);

        if ($run == true) {

            ?>

            <table>
            <tr>

                <th>Courses</th>
                <th>No of Student</th>
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
            </table><?php


        }


    } else if ($Academic != 'null') {


        if ($Academic == 'Pass/Fail By Instructors') {
            $a = "Instructors";
            $sql2 = $sql4;
        }

        $run = mysqli_query($conn, $sql2);

        if ($run == true) {

            ?>

            <table>
            <tr>
                <th><?php echo $a ?></th>
                <th>Total Students</th>
                <th>No of Pass Students</th>
                <th>No of Fail Students</th>
                <th>Pass Percentage</th>
                <th>Fail Percentage</th>
            </tr>

            <?php
            while ($data = mysqli_fetch_assoc($run)) {
                $counter++;

                ?>
                <tr>
                    <td><?php echo $data[$a]; ?></td>
                    <td><?php echo $data['T_Student']; ?></td>
                    <td><?php echo $data['T_Pass']; ?></td>
                    <td><?php echo $data['T_Fail']; ?></td>
                    <td><?php echo round($data['PassPercentage'], 2); ?></td>
                    <td><?php echo round($data['FailPercentage'], 2); ?></td>
                </tr>


                <?php

            }

            ?>
            <tr>
                <div class="card-title"><?php echo 'Total Record: ' . $counter; ?></div>
                <hr>
            </tr>
            </table><?php


        }
    } else {

        $run = mysqli_query($conn, $sql1);
        if ($run == true) {

            ?>

            <table>
            <tr>
                <!--                <th>Name</th>-->
                <th>Gender</th>
                <th>No of Course</th>
                <th>Course Names</th>
                <!--                <th>Status</th>-->

            </tr>

            <?php
            while ($data = mysqli_fetch_assoc($run)) {
                $counter++;

                ?>
                <tr>
                    <!--                    <td>--><?php //echo $data['Name']; ?><!--</td>-->
                    <td><?php echo $data['Gender']; ?></td>
                    <td><?php echo $data['NoOfCourses']; ?></td>
                    <td><?php echo $data['CourseNames']; ?></td>
                    <!--                    <td>--><?php //echo $data['Status']; ?><!--</td>-->
                </tr>


                <?php

            }

            ?>
            <tr>
                <div class="card-title"><?php echo 'Total Record: ' . $counter; ?></div>
                <hr>
            </tr></table><?php


        }

    }


}

if (isset($_POST['Search'])) {

    executeQuery($conn);
}

require "footer.php";



