<?php
session_start();

require "../constants.inc.php";
require "../globals.inc.php";
require "../functions.inc.php";
require "../functions_matt.inc.php";

if (isset($_POST['update-hold-submit']))
{
    require "../dbh.inc.php";

    $studentEmail = $_POST['ac-academics-hold-email-hidden'];
    $newHold = $_POST['ac-update-holds-dropdown'];

    //Validation
    if (empty($studentEmail) || $newHold == "null")
    {
        header("Location: ../admin_academics.php?error=emptyField");
        exit();
    }
    else
    {
        //Correct midterm var
        switch($newHold)
        {
            case "Academic Hold":
                $newHold = "Academic";
                break;
            case "Financial Hold":
                $newHold = "Financial";
                break;
            case "Health Hold":
                $newHold = "Health";
                break;
        }


        if($newHold != "No Hold")
        {
            $sqlUpdateHold = "UPDATE registration_system.student
                                  SET studentHold = '" . $newHold . "' 
                                  WHERE studentAccount = '" . $studentEmail . "';";

            $statementUpdateHold = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statementUpdateHold, $sqlUpdateHold))
            {
                header("Location: ../admin_academics.php?error=SQL_ERROR_HOLD");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementUpdateHold);
                //COMPLETE
                header("Location: ../../admin_academics.php?HOLD_ADDED");
            }
        }
        else
        {
            $sqlUpdateHold = "UPDATE registration_system.student
                                  SET studentHold = null 
                                  WHERE studentAccount = '" . $studentEmail . "';";

            $statementUpdateHold = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statementUpdateHold, $sqlUpdateHold))
            {
                header("Location: ../admin_academics.php?error=SQL_ERROR_NO_HOLD");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementUpdateHold);
                //COMPLETE
                header("Location: ../../admin_academics.php?HOLD_REMOVED");
            }
        }





    }
}
