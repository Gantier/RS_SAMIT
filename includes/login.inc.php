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

                        //SET STUDENT SESSION VARIABLES
                        if ($_SESSION['userType'] === 'student')
                        {
                            $sqlStudentName = "SELECT CONCAT(CONCAT(CONCAT(studentFirstName, ' '), 
                                                  CONCAT(SUBSTR(studentMiddleName, 1, 1), '. ')),
                                                  studentLastName) AS name
                                              FROM registration_system.student
                                              WHERE studentAccount = '" . $_SESSION['userId'] . "';";
                            $_SESSION['studentName'] = loadSqlResultFirstRow($conn, $sqlStudentName, $current_page);

                            $sqlStudentLevel = "SELECT programName
                                                  FROM registration_system.enrollment e, 
                                                       registration_system.program_graduate pg
                                                  WHERE e.programName = pg.programGraduateName
                                                    AND e.studentAccount = '" . $_SESSION['userId'] . "';";

                            $_SESSION['studentLevel'] = "Undergraduate";
                            $_SESSION['maxSemesterCredits'] = 24;
                            if ($resultStudentLevel = $conn->query($sqlStudentLevel))
                            {
                                $rowCountStudentLevel = $resultStudentLevel->num_rows;
                                if ($rowCountStudentLevel > 0)
                                {
                                    $_SESSION['studentLevel'] = "Graduate";
                                    $_SESSION['maxSemesterCredits'] = 18;
                                }
                            }
                        }
                        //SET FACULTY SESSION VARIABLES
                        else if ($_SESSION['userType'] === 'faculty')
                        {
                            echo 'ass';
                            $sqlFacultyName = "SELECT CONCAT(CONCAT(CONCAT(facultyFirstName, ' '),
                                                                    CONCAT(SUBSTR(facultyMiddleName, 1, 1), '. ')),
                                                             facultyLastName) AS name
                                               FROM registration_system.faculty
                                               WHERE facultyAccount = '" . $_SESSION['userId'] . "';";
                            $_SESSION['facultyName'] = loadSqlResultFirstRow($conn, $sqlFacultyName, $current_page);

                            $sqlFacultyType = "SELECT *
                                               FROM registration_system.faculty f,
                                                    registration_system.`faculty_full-time` `ff-t`
                                               WHERE f.facultyAccount = '" . $_SESSION['userId'] . "'
                                                 AND f.facultyAccount = `ff-t`.`facultyFull-timeAccount`;";

                            $_SESSION['facultyType'] = "Part-time";
                            if ($resultFacultyType = $conn->query($sqlFacultyType))
                            {
                                $rowCountFacultyType = $resultFacultyType->num_rows;
                                if ($rowCountFacultyType > 0)
                                {
                                    $_SESSION['facultyType'] = "Full-time";
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
