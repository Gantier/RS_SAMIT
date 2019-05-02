<?php
    session_start();

    require "../constants.inc.php";
    require "../globals.inc.php";
    require "../functions.inc.php";
    require "../functions_alex.inc.php";

    if (isset($_POST['drop-sec-submit']))
    {
        require '../dbh.inc.php';
        require 'data.inc.php';

        //possible section names from post
        $sections = ['section-crn0', 'section-crn1', 'section-crn2', 'section-crn3', 'section-crn4'];
        $sectionsActual = [];

        foreach ($sections as $section)
        {
            if (isset($_POST[$section]))
            {
                //get section from post
                $sectionCRN = $_POST[$section];
                //collect actual sections dropped for resulting message
                array_push($sectionsActual, $sectionCRN);

                //drop section
                $sqlDropSection = "DELETE
                                   FROM registration_system.registration
                                   WHERE sectionCRN = " . $sectionCRN . "
                                     AND studentAccount = '" . $_SESSION['userId'] . "';";
                $conn->query($sqlDropSection);
            }
        }

        //send message of sections dropped
        $listSectionsDropped = "";
        foreach ($sectionsActual as $item)
        {
            $listSectionsDropped .= $item . "\n";
        }
        $messageBody = Constants::MESSAGE_BODS['SDS'] . $_SESSION['nextSemester'] . "...\n\n" . $listSectionsDropped;
        $sqlDropMessage = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                           VALUES ('" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['SDS'] . "', '" . $messageBody . "');";
        $conn->query($sqlDropMessage);

        header("Location: ../../student_home.php");
        exit();
    }

