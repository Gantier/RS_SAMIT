<?php
session_start();

require "../constants.inc.php";
require "../globals.inc.php";
require "../functions.inc.php";
require "../functions_matt.inc.php";

if(isset($_POST['delete-account-submit']))
{
    require "../dbh.inc.php";

    //Universal variables
    $accountType = $_POST['ac-account-type'];
    $accountEmail = $_POST['ac-account-email'];

    //Validation
    if(empty($accountEmail))
    {
        header("Location: ../admin_accounts_student.php?error=emptyEmailField");
        exit();
    }
    else
    {
        $sqlDeleteAccount = "DELETE FROM registration_system.account
                                          WHERE accountEmail = '" . $accountEmail . "';";

        //DELETE FROM ACCOUNT TABLE
        $statementDelAcc = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statementDelAcc, $sqlDeleteAccount))
        {
            header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError1_" . $accountType);
            exit();
        }
        else
        {
            mysqli_stmt_execute($statementDelAcc);
            header("Location: ../../admin_accounts_" . $accountType . ".php");
        }
    }
}
