<?php
require "header.php";

echo '<main id="cc-container">';

require "includes/dbh.inc.php";

require_once "includes/functions.inc.php";
?>

    <form action="researcher_students.php" method="post">

        <div class="card-title">Students Record</div>

        <hr>


        <table>

            <tr>
                <th>Student Gender</th>
                <th>Academic GPA</th>
                <th>Programme</th>
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
                        <option value="null" selected hidden>Select GPA...</option>
                        <option value="Highest GPA">Highest GPA</option>
                        <option value="Lowest GPA">Lowest GPA</option>
                        <option value="Average GPA">Average GPA</option>

                    </select></td>
                <td><label for="attribute-dropdown"></label>
                    <select id="attribute-dropdown" name="3">
                        <option value="null" selected hidden>Select ...</option>
                        <option value="Most Popular">Most Popular</option>
                        <option value="Least Popular">Least Popular</option>
                    </select></td>
                <td><label for="attribute-dropdown"></label>
                    <select id="attribute-dropdown" name="4">
                        <option value="null" selected hidden>Select ...</option>
                        <option value="Most Popular">Most Popular</option>
                        <option value="Least Popular">Least Popular</option>

                    </select></td>
            </tr>


        </table>


        <!--        <button class="small-button outlined secondary" type="reset" onclick="ccReset()">Reset</button>-->
        <!--        <button class="small-button outlined secondary" type="button" onclick="ccFilter()">Filter</button>-->
        <div align="center">
            <input class="small-button outlined secondary" type="submit" value="Reset"/>
            <input class="small-button outlined secondary" type="submit" value="Search" name="Search"/>
        </div>
    </form>


<?php


function executeQuery(mysqli $conn): void
{
    $counter = 0;
    $Student_Gender = $_POST['1'];
    $Academic_GPA = $_POST['2'];
    $Programme = $_POST['3'];
    $Courses = $_POST['4'];

    echo "<label class='card-title'>Search Criteria: ";
    if ($Student_Gender != 'null')
        echo $Student_Gender . ", ";
    if ($Academic_GPA != 'null')
        echo $Academic_GPA . ", ";
    if ($Programme != 'null')
        echo $Programme . ", ";
    if ($Courses != 'null')
        echo $Courses . " Courses";
    echo '</label>';


    $sql1 = "SELECT
CONCAT(CONCAT(CONCAT(CONCAT(s.studentFirstName, ' '), s.studentMiddleName),' '),s.studentLastname) AS Name, 
(CASE WHEN s.studentGender = 'M' THEN 'Male' WHEN studentGender = 'F' THEN 'Female' END) AS Gender ,
e.programName as Programme,
s.studentStatus as Status,
r.studentAccount as StudentAC,
sum(finalGrade)/count(finalGrade) AS GPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount
LEFT join registration_system.enrollment e  on s.studentAccount = e.studentAccount
WHERE s.studentStatus='active'
GROUP BY r.studentAccount 
ORDER BY Name ASC";
    $sql2 = "SELECT e.programName as Programme, COUNT(*) AS T_Student
FROM registration_system.student s
left join registration_system.enrollment e on s.studentAccount = e.studentAccount 
WHERE s.studentStatus='active' 
GROUP BY e.programName ORDER BY T_Student DESC";
    $sql3 = "SELECT 
sec.sectionCourse as Courses,
s.studentStatus as Status, 
COUNT(*) as T_Students,
Sum(finalGrade)/COUNT(finalGrade) AS AverageGPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount 
LEFT JOIN registration_system.section sec on sec.sectionCRN = r.sectionCRN 
WHERE  s.studentStatus ='active'  
GROUP by sec.sectionCourse 
order BY T_Students";

    if ($Programme != "null") {
        if ($Programme == "Full Time Graduate") {
            $sql1 = " SELECT
CONCAT(CONCAT(CONCAT(CONCAT(s.studentFirstName, ' '), s.studentMiddleName),' '),s.studentLastname) AS Name, 
(CASE WHEN s.studentGender = 'M' THEN 'Male' WHEN studentGender = 'F' THEN 'Female' END) AS Gender ,
e.programName as Programme,
s.studentStatus as Status,
r.studentAccount as StudentAC,
sum(finalGrade)/count(finalGrade) AS GPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount
LEFT join registration_system.enrollment e  on s.studentAccount = e.studentAccount

WHERE s.studentStatus='active'
GROUP BY r.studentAccount 
ORDER BY Name ASC";

            $sql3 = "SELECT 
sec.sectionCourse as Courses,
s.studentStatus as Status, 
COUNT(*) as T_Students,
Sum(finalGrade)/COUNT(finalGrade) AS AverageGPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount 
LEFT JOIN registration_system.section sec on sec.sectionCRN = r.sectionCRN
INNER JOIN registration_system.student_full_time_graduate sftg on s.studentAccount = sftg.studentFull_timeGraduateAccount
WHERE  s.studentStatus ='active'  
GROUP by sec.sectionCourse 
order BY T_Students";
        } else if ($Programme == "Part Time Graduate") {
            $sql1 = " SELECT
CONCAT(CONCAT(CONCAT(CONCAT(s.studentFirstName, ' '), s.studentMiddleName),' '),s.studentLastname) AS Name, 
(CASE WHEN s.studentGender = 'M' THEN 'Male' WHEN studentGender = 'F' THEN 'Female' END) AS Gender ,
e.programName as Programme,
s.studentStatus as Status,
r.studentAccount as StudentAC,
sum(finalGrade)/count(finalGrade) AS GPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount
LEFT join registration_system.enrollment e  on s.studentAccount = e.studentAccount
INNER JOIN registration_system.student_part_time_graduate sptg on s.studentAccount = sptg.studentPart_timeGraduateAccount
WHERE s.studentStatus='active'
GROUP BY r.studentAccount 
ORDER BY Name ASC";
            $sql3 = "SELECT 
sec.sectionCourse as Courses,
s.studentStatus as Status, 
COUNT(*) as T_Students,
Sum(finalGrade)/COUNT(finalGrade) AS AverageGPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount 
LEFT JOIN registration_system.section sec on sec.sectionCRN = r.sectionCRN
INNER JOIN registration_system.student_part_time_graduate sptg on s.studentAccount = sptg.studentPart_timeGraduateAccount
WHERE  s.studentStatus ='active'  
GROUP by sec.sectionCourse 
order BY T_Students";


        } else if ($Programme == "Full Time Undergraduate") {

            $sql1 = " SELECT
CONCAT(CONCAT(CONCAT(CONCAT(s.studentFirstName, ' '), s.studentMiddleName),' '),s.studentLastname) AS Name, 
(CASE WHEN s.studentGender = 'M' THEN 'Male' WHEN studentGender = 'F' THEN 'Female' END) AS Gender ,
e.programName as Programme,
s.studentStatus as Status,
r.studentAccount as StudentAC,
sum(finalGrade)/count(finalGrade) AS GPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount
LEFT join registration_system.enrollment e  on s.studentAccount = e.studentAccount
INNER JOIN registration_system.student_full_time_undergraduate sftu on s.studentAccount = sftu.studentFull_timeUndergraduateAccount
WHERE s.studentStatus='active'
GROUP BY r.studentAccount 
ORDER BY Name ASC";
            $sql3 = "SELECT 
sec.sectionCourse as Courses,
s.studentStatus as Status, 
COUNT(*) as T_Students,
Sum(finalGrade)/COUNT(finalGrade) AS AverageGPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount 
LEFT JOIN registration_system.section sec on sec.sectionCRN = r.sectionCRN
INNER JOIN registration_system.student_full_time_undergraduate sftu on s.studentAccount = sftu.studentFull_timeUndergraduateAccount
WHERE  s.studentStatus ='active'  
GROUP by sec.sectionCourse 
order BY T_Students";

        } else if ($Programme == "Part Time Undergraduate") {

            $sql1 = " SELECT
CONCAT(CONCAT(CONCAT(CONCAT(s.studentFirstName, ' '), s.studentMiddleName),' '),s.studentLastname) AS Name, 
(CASE WHEN s.studentGender = 'M' THEN 'Male' WHEN studentGender = 'F' THEN 'Female' END) AS Gender ,
e.programName as Programme,
s.studentStatus as Status,
r.studentAccount as StudentAC,
sum(finalGrade)/count(finalGrade) AS GPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount
LEFT join registration_system.enrollment e  on s.studentAccount = e.studentAccount
INNER JOIN registration_system.student_part_time_undergraduate sptu on s.studentAccount = sptu.studentPart_timeUndergraduateAccount
WHERE s.studentStatus='active'
GROUP BY r.studentAccount 
ORDER BY Name ASC";
            $sql3 = "SELECT 
sec.sectionCourse as Courses,
s.studentStatus as Status, 
COUNT(*) as T_Students,
Sum(finalGrade)/COUNT(finalGrade) AS AverageGPA
FROM registration_system.student s 
LEFT JOIN registration_system.registration r on s.studentAccount = r.studentAccount 
LEFT JOIN registration_system.section sec on sec.sectionCRN = r.sectionCRN
INNER JOIN registration_system.student_part_time_undergraduate sptu on s.studentAccount = sptu.studentPart_timeUndergraduateAccount
WHERE  s.studentStatus ='active'  
GROUP by sec.sectionCourse 
order BY T_Students";
        } else if ($Programme == "Most Popular") {
            $sql2 = "SELECT e.programName as Programme, COUNT(*) AS T_Student
FROM registration_system.student s
left join registration_system.enrollment e on s.studentAccount = e.studentAccount 
WHERE s.studentStatus='active' 
GROUP BY e.programName ORDER BY T_Student DESC";
        } else if ($Programme == "Least Popular") {
            $sql2 = "SELECT e.programName as Programme, COUNT(*) AS T_Student
FROM registration_system.student s
left join registration_system.enrollment e on s.studentAccount = e.studentAccount 
WHERE s.studentStatus='active' 
GROUP BY e.programName ORDER BY T_Student ASC ";
        }

    }

    if ($Student_Gender == "Male") {

        $temp = " WHERE s.studentGender = 'M' AND ";
        $sql1 = substr_replace($sql1, $temp, strpos($sql1, "WHERE"), strlen("WHERE"));
        $sql2 = substr_replace($sql2, $temp, strpos($sql2, "WHERE"), strlen("WHERE"));
        $sql3 = substr_replace($sql3, $temp, strpos($sql3, "WHERE"), strlen("WHERE"));
    }

    if ($Student_Gender == "Female") {

        $temp = " WHERE s.studentGender = 'F' AND ";
        $sql1 = substr_replace($sql1, $temp, strpos($sql1, "WHERE"), strlen("WHERE"));
        $sql2 = substr_replace($sql2, $temp, strpos($sql2, "WHERE"), strlen("WHERE"));
        $sql3 = substr_replace($sql3, $temp, strpos($sql3, "WHERE"), strlen("WHERE"));
    }

    if ($Academic_GPA == "Highest GPA") {

        $temp = " ORDER BY GPA DESC, ";
        $sql1 = substr_replace($sql1, $temp, strpos($sql1, "ORDER BY"), strlen("ORDER BY"));


        if ($Academic_GPA == "Highest GPA" && $Courses != 'null') {
            $sqlAvg = "SELECT MAX(AverageGPA) from (" . $sql3 . ") AS SUBQUERY";
            $runAvg = mysqli_query($conn, $sqlAvg);
            $dataGpaAvg = mysqli_fetch_assoc($runAvg);
            ?>
            <div class="card-title"><?php echo "Highest Courses GPA = " . round($dataGpaAvg['MAX(AverageGPA)'], 2); ?></div>
            <hr><?php
        }

    }
    if ($Academic_GPA == "Lowest GPA") {

        $temp = " ORDER BY GPA ASC, ";
        $sql1 = substr_replace($sql1, $temp, strpos($sql1, "ORDER BY"), strlen("ORDER BY"));

        if ($Academic_GPA == "Lowest GPA" && $Courses != 'null') {
            $sqlAvg = "SELECT MIN(AverageGPA) from (" . $sql3 . ") AS SUBQUERY";
            $runAvg = mysqli_query($conn, $sqlAvg);
            $dataGpaAvg = mysqli_fetch_assoc($runAvg);
            ?>
            <div class="card-title"><?php echo "Lowest Courses GPA = " . round($dataGpaAvg['MIN(AverageGPA)'], 2); ?></div>
            <hr><?php
        }

    }
    if ($Academic_GPA == "Average GPA") {

        $sqlAvg = "SELECT AVG(GPA) from (" . $sql1 . ") AS SUBQUERY";
        $runAvg = mysqli_query($conn, $sqlAvg);
        $dataGpaAvg = mysqli_fetch_assoc($runAvg);
        ?>
        <div class="card-title"><?php echo "Average GPA = " . round($dataGpaAvg['AVG(GPA)'], 2); ?></div>
        <hr><?php
    }


    if ($Programme == "Most Popular" or $Programme == "Least Popular") {

        $run = mysqli_query($conn, $sql2);

        if ($run == true) {

            ?>

            <table>
            <tr>

                <th>Programme</th>
                <th>No of Student</th>


            </tr>

            <?php
            while ($data = mysqli_fetch_assoc($run)) {
                $counter++;

                ?>
                <tr>

                    <td><?php echo $data['Programme']; ?></td>
                    <td><?php echo $data['T_Student']; ?></td>

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


    } else if ($Courses == "Most Popular" or $Courses == "Least Popular") {

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


    } else {

        $run = mysqli_query($conn, $sql1);
        if ($run == true) {

            ?>

            <table>
            <tr>
                <!--                <th>Name</th>-->
                <th>Gender</th>
                <th>Programme</th>
                <th>GPA</th>
                <!--                <th>Status</th>-->

            </tr>

            <?php
            while ($data = mysqli_fetch_assoc($run)) {
                $counter++;

                ?>
                <tr>
                    <!--                    <td>--><?php //echo $data['Name']; ?><!--</td>-->
                    <td><?php echo $data['Gender']; ?></td>
                    <td><?php echo $data['Programme']; ?></td>
                    <td><?php echo round($data['GPA'], 2); ?></td>
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



