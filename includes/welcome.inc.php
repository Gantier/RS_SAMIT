<?php
    //test message on login
    if ($_SESSION['userType'] !== 'student')
    {
        echo "<body><h3 style='font-weight: lighter; margin-bottom: 16px'>Welcome, " . $_SESSION['userType'] . "!</h3></body>";
    }
    else
    {
        echo "<body><h3 style='font-weight: lighter; margin-bottom: 16px'>Welcome, " . $_SESSION['studentName'] . "!</h3></body>";
    }

