<?php
session_start();

require "../constants.inc.php";
require "../globals.inc.php";
require "../functions.inc.php";
require "../functions_matt.inc.php";

if (isset($_POST['edit-account-submit']) || isset($_POST['edit-department-submit'])) //This might have to be modified in the future once there are more edit buttons besides password
{
    require "../dbh.inc.php";

    if (isset($_POST['edit-account-submit']))
    {
        updatePassword($conn);
    }
    elseif (isset($_POST['edit-department-submit']))
    {
        updateDepartment($conn);
    }

}

function updatePassword($conn)
{
    //Universal variables
    $accountType = $_POST['ac-account-type'];
    $accountEmail = $_POST['ac-reset-email'];
    $currentPassword = $_POST['ac-current-pw'];
    $newPassword = $_POST['ac-new-pw'];
    $repeatPassword = $_POST['ac-repeat-pw'];

    $isCurrentPassCorrect = false;

    //Verify newPassword == repeatPassword
    if ($newPassword == $repeatPassword)
    {
        $isRepeatCorrect = true;
    }
    else
    {
        header("Location: ../admin_accounts_" . $accountType . ".php?error=Passwords_Do_Not_Match_" . $accountType);
        exit();
    }

    //Validation
    //Skipping this for now because it's going to get more complicated once other accounts/edits are in here
    if (empty($accountEmail))
    {
        header("Location: ../admin_accounts_" . $accountType . ".php?error=emptyEmailField_" . $accountType);
        exit();
    }
    else
    {
        //EDIT PASSWORD SECTION

        //1. Get current password of entered account
        $sqlGetCurrentPassword = "SELECT accountPassword
                                  FROM registration_system.account
                                  WHERE accountEmail = '" . $accountEmail . "';";

        $statementGetCurrentPass = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statementGetCurrentPass, $sqlGetCurrentPassword))
        {
            header("Location: ../admin_accounts_" . $accountType . ".php?error=getCurrentPwError_" . $accountType);
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($statementGetCurrentPass, "s", $sqlPW);
            mysqli_stmt_execute($statementGetCurrentPass);
            $resultAccount = mysqli_stmt_get_result($statementGetCurrentPass);

            if ($rowAccount = mysqli_fetch_assoc($resultAccount))
            {
                if ($currentPassword == $rowAccount['accountPassword'])
                {
                    $isCurrentPassCorrect = true;
                }
                else
                {
                    header("Location: ../admin_accounts_" . $accountType . ".php?error=Incorrect_Password_" . $accountType);
                    exit();
                }
            }
            else
            {
                header("Location: ../admin_accounts_" . $accountType . ".php?error=NoUser_" . $accountType);
                exit();
            }

        }

        //IF IT MADE IT HERE, CURRENTPASS MUST BE CORRECT

        //2. Update Account Password
        if ($isCurrentPassCorrect && $isRepeatCorrect)
        {
            //Change Password
            $sqlUpdatePassword = "UPDATE registration_system.account
                                 SET accountPassword = '" . $newPassword . "' 
                                 WHERE accountEmail = '" . $accountEmail . "';";

            $statementUpdatePassword = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statementUpdatePassword, $sqlUpdatePassword))
            {
                header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError_UpdatePass_" . $accountType);
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementUpdatePassword);
                header("Location: ../../admin_accounts_" . $accountType . ".php");
            }
        }
        else
        {
            //Something went wrong
            header("Location: ../admin_accounts_" . $accountType . ".php?error=PasswordValidationFailed_" . $accountType);
            exit();
        }

    }
}

function updateDepartment($conn)
{
    $accountType = $_POST['ac-account-type'];
    $accountEmail = $_POST['ac-reset-email'];
    $newDepartment = $_POST['ac-department-dropdown'];

    //Validation
    if ($newDepartment == NULL)
    {
        header("Location: ../admin_accounts_" . $accountType . ".php?error=EmptyDepartment_" . $accountType);
        exit();
    }
    else
    {
        $sqlUpdateDepartment = "UPDATE registration_system.faculty
                                 SET facultyDepartment = '" . $newDepartment . "' 
                                 WHERE facultyAccount = '" . $accountEmail . "';";

        $statementUpdateDepartment = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statementUpdateDepartment, $sqlUpdateDepartment))
        {
            header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError_UpdatePass_" . $accountType);
            exit();
        }
        else
        {
            mysqli_stmt_execute($statementUpdateDepartment);
            header("Location: ../../admin_accounts_" . $accountType . ".php");
        }
    }
}