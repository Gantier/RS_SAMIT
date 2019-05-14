<?php
session_start();

require "../constants.inc.php";
require "../globals.inc.php";
require "../functions.inc.php";
require "../functions_matt.inc.php";

if (isset($_POST['ac-modify-grades-submit']))
{
    require "../dbh.inc.php";

    $studentEmail = $_POST['ac-academics-grades-email-hidden'];
    $sectionCRN = $_POST['ac-update-grade-crn'];
    $midtermGrade = $_POST['ac-update-midterm-dropdown'];
    $finalGrade = $_POST['ac-update-final-dropdown'];

    //Validation
    if (empty($sectionCRN))
    {
        header("Location: ../admin_academics.php?error=emptyCRNField");
        exit();
    }
    else
    {
        //Correct midterm var
        switch($midtermGrade)
        {
            case "Satisfactory":
                $midtermGrade = "S";
                break;
            case "Unsatisfactory":
                $midtermGrade = "U";
                break;
            case "Failed":
                $midtermGrade = "F";
                break;
        }

        //Correct final var
        switch ($finalGrade)
        {
            case 'A':
                $finalGrade = 4.00;
                break;
            case 'A-':
                $finalGrade = 3.67;
                break;
            case 'B+':
                $finalGrade = 3.33;
                break;
            case 'B':
                $finalGrade = 3.00;
                break;
            case 'B-':
                $finalGrade = 2.67;
                break;
            case 'C+':
                $finalGrade = 2.33;
                break;
            case 'C':
                $finalGrade = 2.00;
                break;
            case 'C-':
                $finalGrade = 1.67;
                break;
            case 'D+':
                $finalGrade = 1.33;
                break;
            case 'D':
                $finalGrade = 1.00;
                break;
            case 'D-':
                $finalGrade = 0.67;
                break;
            case 'F':
                $finalGrade = 0.00;
                break;
        }

        //Update Midterm
        if($midtermGrade != "null")
        {
            $sqlUpdateMidterm = "UPDATE registration_system.registration 
                                  SET midtermGrade = '" . $midtermGrade . "' 
                                  WHERE studentAccount = '" . $studentEmail . "'
                                  AND sectionCRN = " . $sectionCRN . ";";

            $statementUpdateMidterm = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statementUpdateMidterm, $sqlUpdateMidterm))
            {
                header("Location: ../admin_academics.php?error=SQL_ERROR_MIDTERM");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementUpdateMidterm);
                //header("Location: ../../admin_courses.php");
            }
        }

        if($finalGrade != "null")
        {
            $sqlUpdateFinal = "UPDATE registration_system.registration 
                                  SET finalGrade = " . $finalGrade . " 
                                  WHERE studentAccount = '" . $studentEmail . "'
                                  AND sectionCRN = " . $sectionCRN . ";";

            $statementUpdateFinal = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statementUpdateFinal, $sqlUpdateFinal))
            {
                header("Location: ../admin_academics.php?error=SQL_ERROR_FINAL");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementUpdateFinal);
                //header("Location: ../../admin_courses.php");
            }
        }

        //COMPLETE
        header("Location: ../../admin_academics.php?SUCCESS");

    }
}
