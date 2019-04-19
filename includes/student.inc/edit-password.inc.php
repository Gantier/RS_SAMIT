<?php
    session_start();

    require "../constants.inc.php";
    require "../globals.inc.php";
    require "../functions.inc.php";
    require "../functions_alex.inc.php";
    require "../dbh.inc.php";

    if (isset($_POST['edit-pw-submit']))
    {
        $current = $_POST['edit-pw-current'];
        $repeat = $_POST['edit-pw-repeat'];
        $new = $_POST['edit-pw-new'];

        if (empty($current) || empty($repeat) || empty($new))
        {
            header("Location: ../../student_home.php?error=emptyFields");
            exit();
        }
        else
        {
            //get current password
            $sqlCurrentPassword = "SELECT accountPassword
                                   FROM registration_system.account
                                   WHERE accountEmail = '" . $_SESSION['userId'] . "';";
            $resultCurrentPassword = $conn->query($sqlCurrentPassword);
            $currentPassword = mysqli_fetch_row($resultCurrentPassword);

            //validate password input
            if ($currentPassword[0] === $current && $currentPassword[0] === $repeat)
            {
                if (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $new) === 0)
                {
                    //send message password edit failure
                    $sqlPasswordUnchangedMessage = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                    VALUES ('" . $_SESSION['userId'] . "', 'Password Unchanged', " .
                        "'New password must be at least 8 characters and must contain at least one lower case letter, " .
                        "one upper case letter, and one digit.');";
                    $conn->query($sqlPasswordUnchangedMessage);

                    header("Location: ../../student_home.php?error=weakPassword");
                    exit();
                }
                else
                {
                    $sqlNewPassword = "UPDATE registration_system.account
                                       SET accountPassword = '" . $new . "'
                                       WHERE accountEmail = '" . $_SESSION['userId'] . "';";
                    if ($conn->query($sqlNewPassword) === true)
                    {
                        //send message password edit successful
                        $sqlPasswordUnchangedMessage = "INSERT INTO registration_system.message (messageReceiver, messageSubject, messageBody)
                                    VALUES ('" . $_SESSION['userId'] . "', 'Password Changed', " .
                            "'Your account password was successfully edited.');";
                        $conn->query($sqlPasswordUnchangedMessage);

                        header("Location: ../../student_home.php?success=passwordChanged");
                        exit();
                    }
                    else
                    {
                        header("Location: ../../student_home.php?error=sqlError");
                        exit();
                    }
                }
            }
            else
            {
                header("Location: ../../student_home.php?error=incorrectPassword");
                exit();
            }
        }
    }
