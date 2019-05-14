<?php
    session_start();

    require "../constants.inc.php";
    require "../globals.inc.php";
    require "../functions.inc.php";
    require "../functions_matt.inc.php";

    if (isset($_POST['add-account-submit']))
    {
        require "../dbh.inc.php";
        $currentDate = date("Y-m-d");

        //Universal variables
        $firstName = $_POST['ac-first-name'];
        $lastName = $_POST['ac-last-name'];
        $lowerLastName = strtolower($lastName);
        $middleName = $_POST['ac-middle-name'];

        $password = "pw" . $lastName;

        $accountType = $_POST['ac-account-type'];

        switch ($accountType)
        {
            case "student":
                {
                    $gender = $_POST['gender-radio'];
                    $program = $_POST['ac-subject-dropdown'];
                    $dateOfBirth = $_POST['student-dob'];
                    break;
                }
            case "faculty":
                {
                    $gender = $_POST['gender-radio'];
                    $department = $_POST['ac-department-dropdown'];
                    $fullTimePartTime = $_POST['time-radio'];
                    break;
                }
        }

        $newIdNum = mt_rand(100, 999);
        $newAccountEmail = $lowerLastName . $newIdNum . "@samit.edu";

        //Validation
        if (empty($firstName) || empty($lastName) || empty($middleName)) //CHECK IF NAME FIELDS ARE EMPTY
        {
            header("Location: ../admin_accounts_student.php?error=emptyNameFields");
            exit();
        }
        elseif (($accountType == "student" && (empty($gender) || empty($program))) || ($accountType == "faculty" && (empty($gender) || empty($department))))
        {
            /* Must enter here if either
             * 1) Student account has empty
             *      a) Gender
             *      b) Program
             * 2) Faculty account has empty
             *      a) Gender
             *      b) Department
             */
            header("Location: ../admin_accounts_student.php?error=emptyExclusiveFields");
            exit();
        }
        else //IF YOU ARE HERE, NONE OF THE FIELDS WERE EMPTY
        {
            //Should validate that the generated accountEmail does not already exist, gonna skip that for now

            switch ($accountType)
            {
                case "student":
                    {
                        $sqlInsertAccount = "INSERT INTO registration_system.account (accountEmail, accountPassword, accountType) 
                                    VALUES ('" . $newAccountEmail . "','" . $password . "' ,'" . $accountType . "');";

                        $sqlInsertAccountType = "INSERT INTO registration_system.account_student (studentAccountEmail) 
                                    VALUES ('" . $newAccountEmail . "');";

                        $sqlInsertAccountUnique = "INSERT INTO registration_system.student (studentAccount, studentFirstName, studentMiddleName, studentLastName, studentGender, studentDOB) 
                                    VALUES ('" . $newAccountEmail .
                            "' ,'" . $firstName .
                            "' ,'" . $middleName .
                            "' ,'" . $lastName .
                            "' ,'" . $gender .
                            "' ,'" . $dateOfBirth . "');";

                        $sqlInsertAccountEnroll = "INSERT INTO registration_system.enrollment (studentAccount, programName, dateEnrolled) 
                                    VALUES ('" . $newAccountEmail .
                            "' ,'" . $program .
                            "' ,'" . $currentDate . "');";
                        break;
                    }
                case "faculty":
                    {
                        $sqlInsertAccount = "INSERT INTO registration_system.account (accountEmail, accountPassword, accountType) 
                                    VALUES ('" . $newAccountEmail . "','" . $password . "' ,'" . $accountType . "');";

                        $sqlInsertAccountType = "INSERT INTO registration_system.account_faculty (facultyAccountEmail) 
                                    VALUES ('" . $newAccountEmail . "');";

                        $sqlInsertAccountUnique = "INSERT INTO registration_system.faculty (facultyAccount, facultyDepartment, facultyFirstName, facultyMiddleName, facultyLastName, facultyGender) 
                                    VALUES ('" . $newAccountEmail .
                            "' ,'" . $department .
                            "' ,'" . $firstName .
                            "' ,'" . $middleName .
                            "' ,'" . $lastName .
                            "' ,'" . $gender . "');";
                        if ($fullTimePartTime == "FT")
                        {
                            $sqlInsertAccountTime = "INSERT INTO registration_system.`faculty_full-time`(`facultyFull-timeAccount`, `facultyFull-timeRank`, facultyTenure, onSabbatical)
                                    VALUES ('" . $newAccountEmail .
                                "' ,'" . "professor" .
                                "' ,'" . "tenure-track" .
                                "' ,'" . "0" . "');";
                        }
                        else
                        {
                            $sqlInsertAccountTime = "INSERT INTO registration_system.`faculty_part-time`(`facultyPart-timeAccount`, `facultyPart-timeRank`)
                                    VALUES ('" . $newAccountEmail .
                                "' ,'" . "instructor" . "');";
                        }

                        break;
                    }
                case "admin":
                    {
                        $sqlInsertAccount = "INSERT INTO registration_system.account (accountEmail, accountPassword, accountType) 
                                    VALUES ('" . $newAccountEmail . "','" . $password . "' ,'" . $accountType . "');";

                        $sqlInsertAccountType = "INSERT INTO registration_system.account_admin (adminAccountEmail) 
                                    VALUES ('" . $newAccountEmail . "');";
                        break;
                    }
                case "researcher":
                    {
                        $sqlInsertAccount = "INSERT INTO registration_system.account (accountEmail, accountPassword, accountType) 
                                    VALUES ('" . $newAccountEmail . "','" . $password . "' ,'" . $accountType . "');";

                        $sqlInsertAccountType = "INSERT INTO registration_system.account_researcher (researcherAccountEmail) 
                                    VALUES ('" . $newAccountEmail . "');";
                        break;
                    }
            }

            //INSERT INTO ACCOUNT TABLE
            $statementAddAcc = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statementAddAcc, $sqlInsertAccount))
            {
                header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError1_" . $accountType);
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementAddAcc);
            }

            //INSERT INTO ACCOUNT_TYPE TABLE
            if (!mysqli_stmt_prepare($statementAddAcc, $sqlInsertAccountType))
            {
                header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError2");
                exit();
            }
            else
            {
                mysqli_stmt_execute($statementAddAcc);
                header("Location: ../../admin_accounts_" . $accountType . ".php");
            }

            //STUDENT/FACULTY TABLE INSERTION
            if ($accountType == "faculty" || $accountType == "student")
            {
                if (!mysqli_stmt_prepare($statementAddAcc, $sqlInsertAccountUnique))
                {
                    header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError3");
                    exit();
                }
                else
                {
                    mysqli_stmt_execute($statementAddAcc);
                    header("Location: ../../admin_accounts_" . $accountType . ".php");
                }
            }

            //FACULTY TIME TABLE INSERTION
            if ($accountType == "faculty")
            {
                if (!mysqli_stmt_prepare($statementAddAcc, $sqlInsertAccountTime))
                {
                    header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError4");
                    exit();
                }
                else
                {
                    mysqli_stmt_execute($statementAddAcc);
                    header("Location: ../../admin_accounts_" . $accountType . ".php");
                }
            }

            //STUDENT ENROLLMENT TABLE INSERTION
            if ($accountType == "student")
            {
                if (!mysqli_stmt_prepare($statementAddAcc, $sqlInsertAccountEnroll))
                {
                    header("Location: ../admin_accounts_" . $accountType . ".php?error=sqlError5");
                    exit();
                }
                else
                {
                    mysqli_stmt_execute($statementAddAcc);
                    header("Location: ../../admin_accounts_" . $accountType . ".php");
                }
            }

        }

    }
