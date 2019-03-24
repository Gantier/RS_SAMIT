<?php

    if (isset($_POST['login-submit']))
    {
        require 'dbh.inc.php';
        $email = $_POST['email'];
        $password = $_POST['pwd'];

        if (empty($email) || empty($password))
        {
            header("Location: ../index.php?error=emptyFields");
            exit();
        }
        else
        {
            $sql = "SELECT * FROM registration_system.account WHERE accountEmail=?;";
            $statement = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statement, $sql))
            {
                header("Location: ../index.php?error=sqlError");
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($statement, "s", $email);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                if ($row = mysqli_fetch_assoc($result))
                {
                    //$pwdCheck = password_verify($password, $row['accountPassword']);
                    if ($password != $row['accountPassword'])
                    {
                        header("Location: ../index.php?error=wrongLogin");
                        exit();
                    }
                    else if ($password == $row['accountPassword'])
                    {
                        session_start();
                        $_SESSION['userId'] = $row['accountEmail'];

                        header("Location: ../index.php?login=success");
                        exit();
                    }
                    else
                    {
                        header("Location: ../index.php?error=wrongLogin");
                        exit();
                    }
                }
                else
                {
                    header("Location: ../index.php?error=noUser");
                    exit();
                }
            }
        }
    }
    else
    {
        header("Location: ../index.php");
        exit();
    }
