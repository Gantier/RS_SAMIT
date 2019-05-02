<?php
    session_start();

    require "../constants.inc.php";
    require "../globals.inc.php";
    require "../functions.inc.php";
    require "../functions_alex.inc.php";

    if (isset($_POST['wd-sec-submit']))
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

                //check if already requested withdrawal for that section
                $sqlCheckRequest = "SELECT messageId
                                    FROM registration_system.message
                                    WHERE messageSubject = '" . Constants::MESSAGE_SUBS['FWD'] . "'
                                      AND messageSender = '" . $_SESSION['userId'] . "'
                                      AND messageBody LIKE '%" . $sectionCRN . "%';";
                $resultCheckRequest = $conn->query($sqlCheckRequest);

                if (mysqli_num_rows($resultCheckRequest) === 0)//if have not already requested withdrawal
                {
                    //collect actual sections dropped for resulting message to student
                    array_push($sectionsActual, $sectionCRN);

                    //get section instructor
                    $sqlSectionInstructor = "SELECT sectionInstructor
                                             FROM registration_system.section
                                             WHERE sectionCRN = " . $sectionCRN . ";";
                    $resultSectionInstructor = $conn->query($sqlSectionInstructor);
                    $sectionInstructor = mysqli_fetch_row($resultSectionInstructor);

                    //send request message to section instructor
                    $requestBody = Constants::MESSAGE_BODS['FWD'] . $sectionCRN . ".";
                    $sqlWithdrawRequestMessage =
                        "INSERT INTO registration_system.message (messageSender, messageReceiver, messageSubject, messageBody)
                         VALUES ('" . $_SESSION['userId'] . "', '" . $sectionInstructor[0] . "', '" .
                        Constants::MESSAGE_SUBS['FWD'] . "', '" . $requestBody . "');";
                    $conn->query($sqlWithdrawRequestMessage);
                }
            }
        }

        //if requests sent, send message of sections requested to student
        if (sizeof($sectionsActual) > 0)
        {
            $listSectionsRequested = "";
            foreach ($sectionsActual as $item)
            {
                $listSectionsRequested .= $item . "\n";
            }
            $messageBody = Constants::MESSAGE_BODS['SWD'] . $_SESSION['currentSemester'] . "...\n\n" . $listSectionsRequested;
            $sqlWithdrawMessage = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                               VALUES ('" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['SWD'] . "', '" . $messageBody . "');";
            $conn->query($sqlWithdrawMessage);
        }
        else
        {
            header("Location: ../../student_home.php?error=alreadyRequestedWithdrawal");
            exit();
        }

        header("Location: ../../student_home.php");
        exit();
    }


