<?php
    require "constants.inc.php";
    require "globals.inc.php";
    require "functions.inc.php";
    require "functions_alex.inc.php";

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
            $sqlAccount = "SELECT * FROM registration_system.account WHERE accountEmail=?;";

            $statementAccount = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statementAccount, $sqlAccount))
            {
                header("Location: ../index.php?error=sqlError");
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($statementAccount, "s", $email);
                mysqli_stmt_execute($statementAccount);
                $resultAccount = mysqli_stmt_get_result($statementAccount);
                if ($rowAccount = mysqli_fetch_assoc($resultAccount))
                {
                    if ($password != $rowAccount['accountPassword'])
                    {
                        header("Location: ../index.php?error=wrongLogin");
                        exit();
                    }
                    else if ($password == $rowAccount['accountPassword'])
                    {
                        //SET COMMON SESSION VARIABLES
                        session_start();
                        $_SESSION['userId'] = $rowAccount['accountEmail'];
                        $_SESSION['userType'] = $rowAccount['accountType'];

                        $sqlCurrentSemester = "SELECT semesterName
                                                FROM registration_system.semester
                                                WHERE semesterEndDate > CURRENT_DATE
                                                  AND semesterStartDate < CURRENT_DATE;";
                        $_SESSION['currentSemester'] = loadSqlResultFirstRow($conn, $sqlCurrentSemester, $current_page);

                        $sqlNextSemester = "SELECT semesterName
                                            FROM registration_system.semester
                                            WHERE semesterStartDate > CURRENT_DATE
                                            LIMIT 1;";
                        $_SESSION['nextSemester'] = loadSqlResultFirstRow($conn, $sqlNextSemester, $current_page);

                        //SET STUDENT SESSION VARIABLES
                        if ($_SESSION['userType'] === 'student')
                        {
                            $sqlStudentName = "SELECT CONCAT(CONCAT(CONCAT(studentFirstName, ' '), 
                                                  CONCAT(SUBSTR(studentMiddleName, 1, 1), '. ')),
                                                  studentLastName) AS name
                                              FROM registration_system.student
                                              WHERE studentAccount LIKE '" . $_SESSION['userId'] . "';";
                            $_SESSION['studentName'] = loadSqlResultFirstRow($conn, $sqlStudentName, $current_page);

                            $sqlStudentLevel = "SELECT programName
                                                  FROM registration_system.enrollment e, 
                                                       registration_system.program_graduate pg
                                                  WHERE e.programName LIKE pg.programGraduateName
                                                    AND e.studentAccount LIKE '" . $_SESSION['userId'] . "';";
                            if ($resultStudentLevel = $conn->query($sqlStudentLevel))
                            {
                                $rowCountStudentLevel = $resultStudentLevel->num_rows;
                                if ($rowCountStudentLevel > 0)
                                {
                                    $_SESSION['studentLevel'] = "Graduate";
                                }
                                else
                                {
                                    $_SESSION['studentLevel'] = "Undergraduate";
                                }
                            }
                        }

                        header("Location: ../" . $_SESSION['userType'] . "_home.php");
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
