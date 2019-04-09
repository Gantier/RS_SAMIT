<?php
error_reporting(0);
require "header.php";

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "Shawaiz2018";
$dBName = "registration_system";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>

    <style>
        body {
            background-image: url("images/campus.jpg");
        }

        .top_head {

            width: 330px;
            height: 50px;
            background-color: #4c8c4a;
            color: white;
            line-height: 2;
            text-align: center;
        }

        .top_head h2 {
            font-size: 25px;
        }

        .filters {
            Percent of Male Students

            width: 100%;
            height: 70px;
            background-color: #4c8c4a;
            margin-top: 5px;
        }

        .filters ul {
            width: 100%;
        }

        .filters ul li {
            list-style: none;
            float: left;
            padding: 20px;
        }

        .filter_by {

            width: 324px;
            border: 1px solid white;
        }

        table {
            width: 100%;
            height: auto;
            padding: 30px;
        }

        thead {
            background-color: #003300;
            border-right: 1px solid #003300;

        }

        thead td {
            height: 35px;
            line-height: 2;
            color: white;
            text-align: center;
            font-size: 16px;
        }

        .rom td {
            text-align: center;
            background-color: cadetblue;
            color: white;
        }
    </style>

    <div class="top_head">
        <h2>Graduate Programs</h2>
    </div>

    <div class="filters">
    <form method="GET" action="">
        <ul>
            <li>
                <select id="" class="filter_byx" name="filter_name">
                    <option value="1"><?php
                        $nam = $_GET{'filter_name'};

                        if ($nam == 8) {
                            echo "Full Time Graduates";
                        } elseif ($nam == 9) {
                            echo "Part Time Graduates";
                        } elseif ($nam == 12) {
                            echo "Full Time Female Graduates";
                        } elseif ($nam == 13) {
                            echo "Full Time Male Graduates";
                        } else {
                            echo "Please Choose a Filter";
                        }
                        ?></option>

                    <option value="8">Full Time Graduates</option>
                    <option value="9">Part Time Graduates</option>
                    <option value="12">Full Time Female Graduates</option>
                    <option value="13">Full Time Male Graduates</option>

                </select>
            </li>
            <li><input type="submit" name="submit" class="submit" value="Submit"></li>
        </ul>
    </form>
<?php

if (isset($_GET['submit'])) {
    $name = $_GET['filter_name'];
    if ($name == 2) {

        $m_sql = "SELECT * FROM student WHERE studentStatus ='Active' AND studentGender = 'M'";

        if ($result = mysqli_query($conn, $m_sql)) {
            // Return the number of rows in result set
            $m_rowcount = mysqli_num_rows($result);

        }

        $all = "SELECT * FROM student WHERE studentStatus = 'Active'";
        if ($result = mysqli_query($conn, $all)) {
            // Return the number of rows in result set
            $all_rowcount = mysqli_num_rows($result);
            $percentage = $m_rowcount / $all_rowcount * 100;

        }

        //Highest Male GPA
        $m_gpa = "SELECT MAX(studentGPA) FROM student WHERE studentStatus='Active' AND studentGender-'M'";
        if ($result = mysqli_query($conn, $m_gpa)) {
            // Return the number of rows in result set
            $male_GPA = mysqli_num_rows($result);

        }

        //Average Male GPA
        $am_gpa = "SELECT COUNT(studentGPA) FROM student WHERE studentStatus='Active' AND studentGender-'M'";
        if ($result = mysqli_query($conn, $am_gpa)) {
            // Return the number of rows in result set
            $amale_GPA = mysqli_num_rows($result);


        }

        $all_GPA = "SELECT COUNT(studentGPA) FROM student WHERE studentStatus='Active'";
        if ($result = mysqli_query($conn, $all_GPA)) {
            // Return the number of rows in result set
            $amale_GPA = mysqli_num_rows($result);
            $avg_m_GPA = $amale_GPA / $all_GPA * 100;
        }


    }
    if ($name == 3) {

        $m_sql = "SELECT * FROM student WHERE studentStatus ='Active' AND studentGender = 'F'";

        if ($result = mysqli_query($conn, $m_sql)) {
            // Return the number of rows in result set
            $m_rowcount = mysqli_num_rows($result);

        }

        $all = "SELECT * FROM student WHERE studentStatus = 'Active'";
        if ($result = mysqli_query($conn, $all)) {
            // Return the number of rows in result set
            $all_rowcount = mysqli_num_rows($result);
            $percentage = $m_rowcount / $all_rowcount * 100;

        }

        //Highest Male GPA
        $m_gpa = "SELECT MAX(studentGPA) FROM student WHERE studentStatus='Active' AND studentGender-'F'";
        if ($result = mysqli_query($conn, $m_gpa)) {
            // Return the number of rows in result set
            $male_GPA = mysqli_num_rows($result);

        }

        //Average Male GPA
        $am_gpa = "SELECT COUNT(studentGPA) FROM student WHERE studentStatus='Active' AND studentGender-'F'";
        if ($result = mysqli_query($conn, $am_gpa)) {
            // Return the number of rows in result set
            $amale_GPA = mysqli_num_rows($result);


        }

        $all_GPA = "SELECT COUNT(studentGPA) FROM student WHERE studentStatus='Active'";
        if ($result = mysqli_query($conn, $all_GPA)) {
            // Return the number of rows in result set
            $amale_GPA = mysqli_num_rows($result);
            $avg_m_GPA = $amale_GPA / $all_GPA * 100;
        }
    }

    // Famous Program
    if ($name == 4) {
        $result = "SELECT student.studentGender,studentStatus,enrollment.programName , COUNT(*) Count_Duplicate FROM enrollment INNER JOIN student ON
student.studentAccount = enrollment.studentAccount WHERE student.studentGender = 'M'
AND
student.studentStatus = 'active'
GROUP BY programName HAVING COUNT(*) > 1
ORDER BY COUNT(*) DESC";
        $result = $conn->query($result);
        // $m_famous=mysqli_fetch_assoc($result);

    }

    //Least Famous Program
    if ($name == 5) {
        $result = "SELECT student.studentGender,studentStatus,enrollment.programName , COUNT(*) Count_Duplicate FROM enrollment INNER JOIN student ON
student.studentAccount = enrollment.studentAccount WHERE student.studentGender = 'M'
AND
student.studentStatus = 'active'
GROUP BY programName HAVING COUNT(*) > 1
ORDER BY COUNT(*) ASC ";
        $result = $conn->query($result);
        // $m_famous=mysqli_fetch_assoc($result);

    }

    // Famous  female program
    if ($name == 6) {
        $result = "SELECT student.studentGender,studentStatus,enrollment.programName , COUNT(*) Count_Duplicate FROM enrollment INNER JOIN student ON
student.studentAccount = enrollment.studentAccount WHERE student.studentGender = 'F'
AND
student.studentStatus = 'active'
GROUP BY programName HAVING COUNT(*) > 1
ORDER BY COUNT(*) DESC ";
        $result = $conn->query($result);
        // $m_famous=mysqli_fetch_assoc($result);

    }

    // Least FamousFemale pogram
    if ($name == 7) {
        $result = "SELECT student.studentGender,studentStatus,enrollment.programName , COUNT(*) Count_Duplicate FROM enrollment INNER JOIN student ON
student.studentAccount = enrollment.studentAccount WHERE student.studentGender = 'F'
AND
student.studentStatus = 'active'
GROUP BY programName HAVING COUNT(*) > 1
ORDER BY COUNT(*) ASC ";
        $result = $conn->query($result);
        // $m_famous=mysqli_fetch_assoc($result);

    }

    // Full Time Graduates
    if ($name == 8) {
        $sql = "SELECT * FROM student_full_time_graduate";

        if ($result = mysqli_query($conn, $sql)) {
            // Return the number of rows in result set
            $full_g_students = mysqli_num_rows($result);

        }

    }

    // Part Time Graduates
    if ($name == 9) {
        $sql = "SELECT * FROM student_part_time_graduate";

        if ($result = mysqli_query($conn, $sql)) {
            // Return the number of rows in result set
            $full_g_students = mysqli_num_rows($result);

        }

    }

    // full Time under graduate
    if ($name == 10) {
        $sql = "SELECT * FROM student_full_time_undergraduate";

        if ($result = mysqli_query($conn, $sql)) {
            // Return the number of rows in result set
            $student_full_time_undergraduate = mysqli_num_rows($result);

        }

    }

    // Full Time Female graduate
    if ($name == 12) {
        $sql = "SELECT student_full_time_graduate.studentFull_timeGraduateAccount , student.studentGender,student.studentStatus FROM student JOIN student_full_time_graduate
ON
  student_full_time_graduate.studentFull_timeGraduateAccount = student.studentAccount

WHERE studentStatus = 'active' AND studentGender = 'F'";

        if ($result = mysqli_query($conn, $sql)) {
            // Return the number of rows in result set
            $student_part_time_undergraduate = mysqli_num_rows($result);

        }

    }
    // Full Time Male graduate
    if ($name == 13) {
        $sql = "SELECT student_full_time_graduate.studentFull_timeGraduateAccount , student.studentGender,student.studentStatus FROM student JOIN student_full_time_graduate
ON
  student_full_time_graduate.studentFull_timeGraduateAccount = student.studentAccount

WHERE studentStatus = 'active' AND studentGender = 'M'";

        if ($result = mysqli_query($conn, $sql)) {
            // Return the number of rows in result set
            $student_part_time_undergraduate = mysqli_num_rows($result);

        }

    }


}
?>
    <div>
<?php if ($_GET['filter_name'] == 1) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Number of Male Students</td>
            <td>Percent of Male Students</td>
            <td>Highest GPA in Male Students</td>
            <td>Average Male Student GPA</td>

            </thead>
            <tr>
                <td style="">No Result Found.....</td>
            </tr>
        </table>
    </div>
<?php } else if ($_GET['filter_name'] == 2) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Number of Male Students</td>
            <td>Percent of Male Students</td>
            <td>Highest GPA in Male Students</td>
            <td>Average Male Student GPA</td>

            </thead>
            <tr class="rom">
                <td><?php echo $m_rowcount; ?></td>
                <td><?php echo number_format($percentage, 2) . '%' ?></td>
                <td><?php echo $male_GPA; ?></td>
                <td><?php echo number_format($avg_m_GPA, 2) . '%' ?></td>

            </tr>
        </table>
    </div>

<?php } else if ($_GET['filter_name'] == 3) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Number of Female Students</td>
            <td>Percent of Female Students</td>
            <td>Highest GPA in Female Students</td>
            <td>Average Female Student GPA</td>

            </thead>
            <tr class="rom">
                <td><?php echo $m_rowcount; ?></td>
                <td><?php echo number_format($percentage, 2) . '%' ?></td>
                <td><?php echo $male_GPA; ?></td>
                <td><?php echo number_format($avg_m_GPA, 2) . '%' ?></td>

            </tr>
        </table>
    </div>

    <!--- Male Famous Program----->
<?php } else if ($_GET['filter_name'] == 4) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Male Famous Program Name</td>
            <td>Male Famous Program's Students</td>
            </thead>
            <?php while ($m_famous = $result->fetch_assoc()) { ?>
                <tr class="rom">
                    <td><?php echo $m_famous["programName"]; ?></td>
                    <td><?php echo $m_famous["Count_Duplicate"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!---Least Male Famous Program----->
<?php } else if ($_GET['filter_name'] == 5) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Male Least Famous Program Name</td>
            <td>Male Least Famous Program's Students</td>
            </thead>
            <?php while ($lm_famous = $result->fetch_assoc()) { ?>
                <tr class="rom">
                    <td><?php echo $lm_famous["programName"]; ?></td>
                    <td><?php echo $lm_famous["Count_Duplicate"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!---Male  Famous Program----->
<?php } else if ($_GET['filter_name'] == 6) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Female Famous Program Name</td>
            <td>Female Famous Program's Students</td>
            </thead>
            <?php while ($lm_famous = $result->fetch_assoc()) { ?>
                <tr class="rom">
                    <td><?php echo $lm_famous["programName"]; ?></td>
                    <td><?php echo $lm_famous["Count_Duplicate"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!---Female Least  Famous Program----->
<?php } else if ($_GET['filter_name'] == 7) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Female Least Famous Program Name</td>
            <td>Female Least Famous Program's Students</td>
            </thead>
            <?php while ($lm_famous = $result->fetch_assoc()) { ?>
                <tr class="rom">
                    <td><?php echo $lm_famous["programName"]; ?></td>
                    <td><?php echo $lm_famous["Count_Duplicate"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <!---Full TIme Graduate Courses----->
<?php } else if ($_GET['filter_name'] == 8) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Full Time Graduates</td>
            </thead>
            <tr class="rom">

                <td><?php echo $full_g_students; ?></td>
            </tr>
        </table>
    </div>

    <!---Part Time Graduates--->
<?php } else if ($_GET['filter_name'] == 9) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Part Time Graduates</td>
            </thead>
            <tr class="rom">

                <td><?php echo $full_g_students; ?></td>
            </tr>
        </table>
    </div>

    <!---Part Time UnderGraduates--->
<?php } else if ($_GET['filter_name'] == 10) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Full Time Under Graduates</td>
            </thead>
            <tr class="rom">
                <td><?php echo $student_full_time_undergraduate; ?></td>
            </tr>
        </table>
    </div>
    <!---Full Time Under Graduates --->
<?php } else if ($_GET['filter_name'] == 11) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Part Time Under Graduates</td>
            </thead>
            <tr class="rom">
                <td><?php echo $student_part_time_undergraduate; ?></td>
            </tr>
        </table>
    </div>
    <!---Full Time Female Graduates --->
<?php } else if ($_GET['filter_name'] == 12) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Full Time Female Graduates</td>
            </thead>
            <tr class="rom">
                <td><?php echo $student_part_time_undergraduate; ?></td>
            </tr>
        </table>
    </div>
    <!---Full Time Male Graduates --->
<?php } else if ($_GET['filter_name'] == 13) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Full Time Male Graduates</td>
            </thead>
            <tr class="rom">
                <td><?php echo $student_part_time_undergraduate; ?></td>
            </tr>
        </table>
    </div>
<?php } ?>
<?php

require "footer.php";
?>