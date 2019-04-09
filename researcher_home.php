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
        height: 330px;
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
        top: 192px;
        left: 512px;
    }

    .heading_n h2 {
        font-size: 30px;
        text-align: center;
    }

    body {
        background-image: url("images/campus.jpg");
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
        <li><a href="#">Program</a></li>
        <li><a href="#">Courses</a></li>
    </ul>
</div>
<?php
require "footer.php";
?>