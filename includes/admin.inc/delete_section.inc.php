<?php
    session_start();

    require "../constants.inc.php";
    require "../globals.inc.php";
    require "../functions.inc.php";
    require "../functions_matt.inc.php";

    if (isset($_POST['delete-section-submit']))
    {
        require "../dbh.inc.php";

        $sectionCRN = $_POST['ac-delete-section-title'];

        //Validation
        if (empty($sectionCRN))
        {
            header("Location: ../admin_sections.php?error=emptyCRNField");
            exit();
        }
        else
        {
            $sqlDeleteSection = "DELETE FROM registration_system.section
                                          WHERE sectionCRN = " . $sectionCRN . ";";

            //DELETE FROM ACCOUNT TABLE
            $statementDeleteSection = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statementDeleteSection, $sqlDeleteSection))
            {
                header("Location: ../admin_sections.php?error=SQL_ERROR");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementDeleteSection);
                header("Location: ../../admin_sections.php");
            }
        }
    }
