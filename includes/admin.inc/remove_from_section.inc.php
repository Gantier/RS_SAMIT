<?php
    session_start();

    require "../constants.inc.php";
    require "../globals.inc.php";
    require "../functions.inc.php";
    require "../functions_matt.inc.php";

    if (isset($_POST['remove-from-section-submit']))
    {
        require "../dbh.inc.php";

        $sectionCRN = $_POST['ac-remove-from-section-crn'];
        $studentEmail = $_POST['ac-remove-from-section-email'];

        //Validation
        if (empty($sectionCRN) || empty($studentEmail))
        {
            header("Location: ../admin_registration_student.php?error=emptyField");
            exit();
        }
        else
        {
            $sqlRemoveFromSection = "DELETE FROM registration_system.registration
                                          WHERE sectionCRN = " . $sectionCRN .
                " AND studentAccount = '" . $studentEmail . "';";

            //DELETE FROM ACCOUNT TABLE
            $statementRemoveFromSection = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statementRemoveFromSection, $sqlRemoveFromSection))
            {
                header("Location: ../admin_registration_student.php?error=SQL_ERROR");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementRemoveFromSection);
                header("Location: ../../admin_registration_student.php?REMOVED_SUCCESSFULLY");
            }
        }
    }
