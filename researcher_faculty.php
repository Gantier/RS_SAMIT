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
    body
    {
        background-image : url("images/campus.jpg");
    }

    .top_head
    {

        width            : 200px;
        height           : 50px;
        background-color : #4c8c4a;
        color            : white;
        line-height      : 2;
        text-align       : center;
    }

    .top_head h2
    {
        font-size : 25px;
    }

    .filters
    {
        Percent of Male Students

        width            : 100%;
        height           : 70px;
        background-color : #4c8c4a;
        margin-top       : 5px;
    }

    .filters ul
    {
        width : 100%;
    }

    .filters ul li
    {
        list-style : none;
        float      : left;
        padding    : 20px;
    }

    .filter_by
    {

        width  : 324px;
        border : 1px solid white;
    }

    table
    {
        width   : 100%;
        height  : auto;
        padding : 30px;
    }

    thead
    {
        background-color : #003300;
        border-right     : 1px solid #003300;

    }

    thead td
    {
        height      : 35px;
        line-height : 2;
        color       : white;
        text-align  : center;
        font-size   : 16px;
    }

    .rom td
    {
        text-align       : center;
        background-color : cadetblue;
        color            : white;
    }
</style>

<div class="top_head">
    <h2>Faculty</h2>
</div>

<div class="filters">
    <form method="GET" action="">
        <ul>
            <li>
                <select id="" class="filter_byx" name="filter_name">
                    <option value="1"><?php
                        $nam = $_GET{'filter_name'};
                        if ($nam == 2) {
                            echo "Male Faculty";
                        } elseif ($nam == 3) {
                            echo "Female Faculty";
                        } elseif ($nam == 4) {
                            echo "List of courses Male Faculty Teaches";
                        } elseif ($nam == 5) {
                            echo "List of courses Female Faculty Teaches";
                        } elseif ($Nma == 6) {
                            echo "Part time Male Faculty Teaches";
                        } elseif ($nam == 7) {
                            echo "Part time Female Faculty Teaches";
                        } else {
                            echo "Please Choose a Filter";
                        }
                        ?></option>
                    <option value="2">Male Faculty</option>
                    <option value="3">Female Faculty</option>
                    <option value="4">List of courses Male Faculty Teaches</option>
                    <option value="5">List of courses Female Faculty Teaches</option>
                    <option value="6">Part time Male Faculty Teaches</option>
                    <option value="7">Part time Female Faculty Teaches</option>
                </select>
            </li>
            <li><input type="submit" name="submit" class="submit" value="Submit"></li>
        </ul>
    </form>
    <?php

    if (isset($_GET['submit'])) {
        $name = $_GET['filter_name'];
        if ($name == 2) {

            $result = "SELECT * FROM faculty WHERE facultyGender ='M' AND facultyStatus='active'";
            $result = $conn->query($result);
        }

        if ($name == 3) {

            $result = "SELECT * FROM faculty WHERE facultyGender ='F' AND facultyStatus='active'";
            $result = $conn->query($result);
        }
        if ($name == 4) {

            $result = "SELECT * FROM faculty WHERE facultyGender ='F' AND facultyStatus='active'";
            $result = $conn->query($result);
        }


    }
    ?>
    <div>
        <?php if ($_GET['filter_name'] == 1){ ?>
            <div class="results">
                <table>
                    <thead>
                    <td>Faculty Department</td>
                    <td>Faculty Gender</td>
                    <td>Faculty Status</td>
                    </thead>
                    <tr>
                        <td style="">No Result Found.....</td>
                    </tr>
                </table>
            </div>
        <?php } elseif ($_GET['filter_name'] == 2){ ?>
        <div class="results">
            <table>
                <thead>
                <td>Faculty Department</td>
                <td>Faculty Gender</td>
                <td>Faculty Status</td>
                </thead>
                <?php while ($m_famous = $result->fetch_assoc()) { ?>
                    <tr class="rom">
                        <td><?php echo $m_famous["facultyDepartment"]; ?></td>
                        <td><?php echo $m_famous["facultyGender"]; ?></td>
                        <td><?php echo $m_famous["facultyStatus"]; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
<?php } elseif ($_GET['filter_name'] == 3) { ?>
    <div class="results">
        <table>
            <thead>
            <td>Faculty Department</td>
            <td>Faculty Gender</td>
            <td>Faculty Status</td>
            </thead>
            <?php while ($m_famous = $result->fetch_assoc()) { ?>
                <tr class="rom">
                    <td><?php echo $m_famous["facultyDepartment"]; ?></td>
                    <td><?php echo $m_famous["facultyGender"]; ?></td>
                    <td><?php echo $m_famous["facultyStatus"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?>

    <?php

    require "footer.php";
    ?>
