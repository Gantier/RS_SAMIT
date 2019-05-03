<style>
    .center_main {

        width: 631px;
        height: auto;
        border: 1px solid #1b5e20;
        margin-top: 200px;
        margin-left: 400px;
    }

    .list_main_research {
        width: 98%;
        height: 410px;
        list-style-type: none;

    }

    .list_main_research li {
        background-color: #003300;
        color: #ffffff !important;
        font-size: 20px;
        padding: 20px;
        margin-top: 20px;
        margin-left: 2.5%;


    }

    .list_main_research a {
        text-decoration: none;
        color: #ffffff !important;
        font-size: 20px;
    }

    .heading_n {
        width: 452px;
        height: 66px;
        line-height: 2;
        background-color: #1b5e20;
        color: #ffff;
        position: absolute;
        top: 150px;
        left: 512px;
    }

    .heading_n h2 {
        font-size: 30px;
        text-align: center;
    }

    body {
        background-image: url("images/campus.jpg");
        background-position: center;
    }

</style>

<?php
require "header.php";
?>


<div class="heading_n"><h2>Researcher Home</h2></div>

<div class="center_main">
    <ul class="list_main_research">
        <li><a href="researcher_students.php">Students</a></li>
        <li><a href="researcher_faculty.php">Faculty</a></li>
        <li>Program : <a href="researcher_programs_major.php">Major</a> - <a
                    href="researcher_programs_minor.php">Minor</a> - <a
                    href="researcher_programs_graduate.php">Graduate</a></li>
        </li>
        <li>Courses : <a href="researcher_courses_undergraduate.php">Undergraduate</a> - <a
                    href="researcher_courses_graduate.php">Graduate</a></li>

        <li><a href="researcher_change_password.php">Change Password</a></li>
    </ul>
</div>

<?php
require "footer.php";
?>
