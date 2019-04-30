<?php
    session_start();

    require "../constants.inc.php";
    require "../globals.inc.php";
    require "../functions.inc.php";
    require "../functions_alex.inc.php";
    require "../dbh.inc.php";

    if (isset($_POST['fa-submit']))
    {
        $batch = $_POST['fa-batch'];
        $batch = explode(',', $batch);
        for ($i = 0; $i < sizeof($batch); $i++)
        {
            $batch[$i] = explode(';', $batch[$i]);
        }

        //for all the graded students
        for ($i = 0; $i < sizeof($batch); $i++)
        {
            $studentAccount = $batch[$i][0];
            $studentSection = $batch[$i][1];
            $studentMidterm = $batch[$i][2];
            $studentFinal = $batch[$i][3];
            $studentAttendance = $batch[$i][4];

            $studentMidtermText = $studentMidterm;
            $studentFinalText = $studentFinal;

            //convert midterm value to valid
            switch ($studentMidterm)
            {
                case 'Satisfactory':
                    $studentMidterm = 'S';
                    break;
                case 'Unsatisfactory':
                    $studentMidterm = 'U';
                    break;
                case 'Failed':
                    $studentMidterm = 'F';
                    break;
            }

            //convert final value to valid
            switch ($studentFinal)
            {
                case 'A':
                    $studentFinal = 4.00;
                    break;
                case 'A-':
                    $studentFinal = 3.67;
                    break;
                case 'B+':
                    $studentFinal = 3.33;
                    break;
                case 'B':
                    $studentFinal = 3.00;
                    break;
                case 'B-':
                    $studentFinal = 2.67;
                    break;
                case 'C+':
                    $studentFinal = 2.33;
                    break;
                case 'C':
                    $studentFinal = 2.00;
                    break;
                case 'C-':
                    $studentFinal = 1.67;
                    break;
                case 'D+':
                    $studentFinal = 1.33;
                    break;
                case 'D':
                    $studentFinal = 1.00;
                    break;
                case 'D-':
                    $studentFinal = 0.67;
                    break;
                case 'F':
                    $studentFinal = 0.00;
                    break;
            }

            //get student grades, "null" if none
            $sqlStudentGrades = "SELECT CASE midtermGrade
                                    WHEN NOT NULL THEN midtermGrade
                                    ELSE 'null'
                                    END AS midterm,
                                  CASE finalGrade
                                    WHEN NOT NULL THEN finalGrade
                                    ELSE 'null'
                                    END AS final
                           FROM registration_system.registration
                           WHERE studentAccount = '" . $studentAccount . "'
                             AND sectionCRN = " . $studentSection . ";";
            $resultStudentGrades = $conn->query($sqlStudentGrades);
            $studentGrades = mysqli_fetch_assoc($resultStudentGrades);

            //midterm
            if ($studentMidterm !== "null")
            {
                //update midterm grade
                $sqlUpdateMidterm = "UPDATE registration_system.registration
                                     SET midtermGrade = '" . $studentMidterm . "'
                                     WHERE studentAccount = '" . $studentAccount . "'
                                      AND sectionCRN = " . $studentSection . ";";
                $conn->query($sqlUpdateMidterm);

                //send midterm grade message to student
                $sqlStudentMidtermMessage = "INSERT INTO registration_system.message (messageReceiver, messageSender, messageSubject, messageBody)
                                    VALUES ('" . $studentAccount . "', '" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['SA'] . "', '" .
                    Constants::MESSAGE_BODS['SA'] . $studentSection . "...\n\nMidterm: " . $studentMidtermText . "');";
                $conn->query($sqlStudentMidtermMessage);
            }

            //final
            if ($studentFinal !== "null")
            {
                //update final grade
                $sqlUpdateFinal = "UPDATE registration_system.registration
                                     SET finalGrade = " . $studentFinal . "
                                     WHERE studentAccount = '" . $studentAccount . "'
                                      AND sectionCRN = " . $studentSection . ";";
                $conn->query($sqlUpdateFinal);

                //send final grade message to student
                $sqlStudentFinalMessage = "INSERT INTO registration_system.message (messageReceiver, messageSender, messageSubject, messageBody)
                                    VALUES ('" . $studentAccount . "', '" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['SA'] . "', '" .
                    Constants::MESSAGE_BODS['SA'] . $studentSection . "...\n\nFinal: " . $studentFinalText . "');";
                $conn->query($sqlStudentFinalMessage);
            }

            //attendance
        }

        //send all grades message to faculty
        if (sizeof($batch) > 1)
        {
            $studentsGraded = "";
            for ($i = 0; $i < sizeof($batch) - 1; $i++)
            {
                $gradedAccount = $batch[$i][0];
                $gradedSection = $batch[$i][1];
                $studentsGraded .= $gradedSection . " - " . $gradedAccount . "\n";
            }
            $sqlFacultyGradesMessage = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                        VALUES ('" . $_SESSION['userId'] . "', '" . Constants::MESSAGE_SUBS['FA'] . "', '" .
                Constants::MESSAGE_BODS['FA'] . "\n\n" . $studentsGraded . "');";
            $conn->query($sqlFacultyGradesMessage);
        }
    }

    header("Location: ../../faculty_academics.php");
    exit();
