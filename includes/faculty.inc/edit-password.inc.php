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
        $new = $_POST['edit-pw-new'];
        $repeat = $_POST['edit-pw-repeat'];

        $error = "\n\nError: ";

        //if a field is empty
        if (empty($current) || empty($repeat) || empty($new))
        {
            //send error message empty fields
            $error .= "empty fields";
            $sqlPasswordUnchangedMessage = "INSERT INTO registration_system.message 
                                                    (messageReceiver, messageSubject, messageBody)
                                                    VALUES ('" . $_SESSION['userId'] . "', '" .
                Constants::MESSAGE_SUBS['EP_FAIL'] . "', '" .
                Constants::MESSAGE_BODS['EP_FAIL'] . $error . "');";
            $conn->query($sqlPasswordUnchangedMessage);

            header("Location: ../../faculty_home.php?error=emptyFields");
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

            //get password lock status
            $sqlPasswordLock = "SELECT COUNT(*)
                                FROM registration_system.message
                                WHERE messageTime >= NOW() - INTERVAL 10 MINUTE
                                  AND messageSubject = 'Password Unchanged'
                                  AND messageReceiver = '" . $_SESSION['userId'] . "'
                                  AND messageBody LIKE '%incorrect password%';";
            $resultPasswordLock = $conn->query($sqlPasswordLock);
            $passwordLock = mysqli_fetch_row($resultPasswordLock);

            //if not locked from 5 failed attempts in past 10 minutes
            if ($passwordLock[0] < 5)
            {
                //validate password input
                if ($currentPassword[0] === $current)
                {
                    //validate new and repeated new are the same
                    if ($new === $repeat)
                    {
                        if (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $new) === 0)
                        {
                            //send error message password weak
                            $error .= "weak password";
                            $sqlPasswordUnchangedMessage = "INSERT INTO registration_system.message 
                                                            (messageReceiver, messageSubject, messageBody)
                                                            VALUES ('" . $_SESSION['userId'] . "', '" .
                                Constants::MESSAGE_SUBS['EP_FAIL'] . "', '" .
                                Constants::MESSAGE_BODS['EP_FAIL'] . $error . "');";
                            $conn->query($sqlPasswordUnchangedMessage);

                            header("Location: ../../faculty_home.php?error=weakPassword");
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
                                $sqlPasswordUnchangedMessage = "INSERT INTO registration_system.message 
                                                                (messageReceiver, messageSubject, messageBody)
                                                                VALUES ('" . $_SESSION['userId'] . "', '" .
                                    Constants::MESSAGE_SUBS['EP_SUCCESS'] . "', '" .
                                    Constants::MESSAGE_BODS['EP_SUCCESS'] . "');";
                                $conn->query($sqlPasswordUnchangedMessage);

                                header("Location: ../../faculty_home.php?success=passwordChanged");
                                exit();
                            }
                            else
                            {
                                header("Location: ../../faculty_home.php?error=sqlError");
                                exit();
                            }
                        }
                    }
                    else
                    {
                        //send error message typo in repeat
                        $error .= "typo in repeat";
                        $sqlPasswordUnchangedMessage = "INSERT INTO registration_system.message 
                                                        (messageReceiver, messageSubject, messageBody)
                                                        VALUES ('" . $_SESSION['userId'] . "', '" .
                            Constants::MESSAGE_SUBS['EP_FAIL'] . "', '" .
                            Constants::MESSAGE_BODS['EP_FAIL'] . $error . "');";
                        $conn->query($sqlPasswordUnchangedMessage);

                        header("Location: ../../faculty_home.php?error=typoInRepeat");
                        exit();
                    }
                }
                else
                {
                    //send error message password incorrect
                    $error .= "incorrect password";
                    $sqlPasswordUnchangedMessage = "INSERT INTO registration_system.message 
                                                        (messageReceiver, messageSubject, messageBody)
                                                        VALUES ('" . $_SESSION['userId'] . "', '" .
                        Constants::MESSAGE_SUBS['EP_FAIL'] . "', '" .
                        Constants::MESSAGE_BODS['EP_FAIL'] . $error . "');";
                    $conn->query($sqlPasswordUnchangedMessage);

                    header("Location: ../../faculty_home.php?error=incorrectPassword");
                    exit();
                }
            }
            else
            {
                //send error message password locked
                $error .= "too many failed attempts";
                $sqlPasswordUnchangedMessage = "INSERT INTO registration_system.message 
                                                            (messageReceiver, messageSubject, messageBody)
                                                            VALUES ('" . $_SESSION['userId'] . "', '" .
                    Constants::MESSAGE_SUBS['EP_LOCK'] . "', '" .
                    Constants::MESSAGE_BODS['EP_LOCK'] . $error . "');";
                $conn->query($sqlPasswordUnchangedMessage);

                header("Location: ../../faculty_home.php?error=passwordLocked");
                exit();
            }
        }
    }
