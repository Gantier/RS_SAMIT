<?php
    require "globals.inc.php";

    function loadSqlResultFirstRow(mysqli $conn, $sqlQuery, $current_page)
    {
        $statement = mysqli_stmt_init($conn);

        //if valid sql
        if (!mysqli_stmt_prepare($statement, $sqlQuery))
        {
            header("Location: " . $current_page . "?error=sqlError");
            exit();
        }
        else
        {
            mysqli_stmt_execute($statement);
            $sqlResult = mysqli_stmt_get_result($statement);

            //if results not empty
            if ($row = mysqli_fetch_row($sqlResult))
            {
                return $row[0];
            }
            else
            {
                header("Location: " . $current_page . "?error=noData");
                exit();
            }
        }
    }

    function viewFancyTableFromSQL(mysqli $conn, $sql, $current_page, $containerId, $tableId, $caption, $rowClick)
    {
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql))
        {
            header("Location: " . $current_page . "?error=sqlError");
            exit();
        }
        else
        {
            mysqli_stmt_execute($statement);
            $sqlResult = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($sqlResult))
            {
                //define table rowClick
                $rowClick = "onclick=\"" . $rowClick . "\"";
                //generate html table
                drawTableFromSQL($sqlResult, $containerId, $tableId, $caption, $rowClick);
                return $sqlResult;
            }
            else
            {
                header("Location: " . $current_page);
                exit();
            }
        }
    }

    function viewBasicTableFromSQL(mysqli $conn, $sql, $current_page, $tableClass): void
    {
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql))
        {
            header("Location: " . $current_page . "?error=sqlError");
            exit();
        }
        else
        {
            mysqli_stmt_execute($statement);
            $sqlResult = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($sqlResult))
            {
                //generate html table
                drawBasicTableFromSQL($sqlResult, $tableClass);
            }
            else
            {
                header("Location: " . $current_page);
                exit();
            }
        }
    }

    function viewTranscript(mysqli $conn, $current_page, $studentSemesters, $studentAccount, $studentName, $studentLevel)
    {
        echo '<p id="transcript-caption">Student Information</p>';
        $sqlTranscriptStudentInfo = "SELECT '" . $studentName . "'                                               AS studentName,
                                           '" . $studentLevel . "'                                               AS studentLevel,
                                           studentDOB                                                                        AS 'Date of Birth',
                                           CONCAT(UCASE(SUBSTRING(studentStatus, 1, 1)), LOWER(SUBSTRING(studentStatus, 2))) AS Status
                                     FROM registration_system.student
                                     WHERE studentAccount = '" . $studentAccount . "';";
        viewBasicTableFromSQL($conn, $sqlTranscriptStudentInfo, $current_page, 'transcript-student-info');

        echo '<p id="transcript-caption">Curriculum Information</p>';
        $sqlTranscriptCurriculumInfo = "SELECT RTRIM(REVERSE(SUBSTRING(REVERSE(e.programName),LOCATE(' ',REVERSE(e.programName))))) AS Program,
                                               CASE SUBSTRING(e.programName, -4)
                                                 WHEN 'B.S.' THEN 'Bachelor of Science'
                                                 WHEN ' B.S' THEN 'Bachelor of Science'
                                                 WHEN 'B.A.' THEN 'Bachelor of Art'
                                                 WHEN ' B.A' THEN 'Bachelor of Art'
                                                 WHEN 'M.S.' THEN 'Master of Science'
                                                 WHEN ' M.S' THEN 'Master of Science'
                                                 ELSE 'Minor' END                                                                   AS 'Degree Sought',
                                               e.dateEnrolled                                                                       AS 'Enrollment',
                                               e.dateGraduate                                                                       AS 'Graduation'
                                        FROM registration_system.enrollment e
                                        WHERE e.studentAccount = '" . $studentAccount . "'
                                        ORDER BY `Degree Sought`;";
        viewBasicTableFromSQL($conn, $sqlTranscriptCurriculumInfo, $current_page, 'transcript-curriculum-info');

        foreach ($studentSemesters as $semester)
        {
            $sqlTranscriptSemester = "SELECT CONCAT(CONCAT(d.departmentTag, ' '), c.courseNumber) AS transcriptCourse,
                                         c.courseName                                             AS transcriptTitle,
                                         c.courseCredits                                          AS transcriptCredits,
                                         CASE CONVERT(r.finalGrade, CHAR(4))
                                           WHEN '4.00' THEN 'A'
                                           WHEN '3.67' THEN 'A-'
                                           WHEN '3.33' THEN 'B+'
                                           WHEN '3.00' THEN 'B'
                                           WHEN '2.67' THEN 'B-'
                                           WHEN '2.33' THEN 'C+'
                                           WHEN '2.00' THEN 'C'
                                           WHEN '1.67' THEN 'C-'
                                           WHEN '1.33' THEN 'D+'
                                           WHEN '1.00' THEN 'D'
                                           WHEN '0.67' THEN 'D-'
                                           WHEN '0.00' THEN 'F'
                                           ELSE NULL END                                          AS transcriptGrade
                                  FROM registration_system.department d,
                                       registration_system.course c,
                                       registration_system.section s,
                                       registration_system.registration r
                                  WHERE d.departmentName = c.courseSubject
                                    AND s.sectionCRN = r.sectionCRN
                                    AND s.sectionCourse = c.courseName
                                    AND r.studentAccount = '" . $studentAccount . "'
                                    AND s.sectionSemester = '" . $semester['semester'] . "';";
            echo '<br><p id="transcript-semester-caption">' . $semester['semester'] . ' Grades</p>';
            viewBasicTableFromSQL($conn, $sqlTranscriptSemester, $current_page, 'transcript-semester');

            $sqlTranscriptSemesterTotal = "SELECT SUM(c.courseCredits)                      AS semesterAttempted,
                                                  (SELECT SUM(c.courseCredits)
                                                   FROM registration_system.registration r,
                                                        registration_system.course c,
                                                        registration_system.section s
                                                   WHERE r.studentAccount = '" . $studentAccount . "'
                                                     AND s.sectionCRN = r.sectionCRN
                                                     AND c.courseName = s.sectionCourse
                                                     AND r.finalGrade > 1.33
                                                     AND s.sectionSemester = '" . $semester['semester'] . "') AS semesterEarned,
                                                  (SELECT CAST(AVG(r.finalGrade) AS DECIMAL(3, 2))
                                                   FROM registration_system.registration r,
                                                        registration_system.course c,
                                                        registration_system.section s
                                                   WHERE r.studentAccount = '" . $studentAccount . "'
                                                     AND s.sectionCRN = r.sectionCRN
                                                     AND c.courseName = s.sectionCourse
                                                     AND s.sectionSemester = '" . $semester['semester'] . "') AS semesterGPA
                                           FROM registration_system.registration r,
                                                registration_system.course c,
                                                registration_system.section s
                                           WHERE r.studentAccount = '" . $studentAccount . "'
                                             AND c.courseName = s.sectionCourse
                                             AND s.sectionCRN = r.sectionCRN
                                             AND s.sectionSemester = '" . $semester['semester'] . "';";
            echo '<div class="transcript-semester-totals-bg">
                  <p id="transcript-semester-totals-caption">' . $semester['semester'] . ' Totals</p>';
            viewBasicTableFromSQL($conn, $sqlTranscriptSemesterTotal, $current_page, 'transcript-semester-totals');
            echo '</div>';
        }

        echo '<br><br><p id="transcript-caption">Transcript Totals</p>';
        $sqlTranscriptTotals = "WITH LogTotalGPA AS
                                      (
                                        SELECT CAST(AVG(r.finalGrade) AS DECIMAL(3, 2)) AS totalGPA
                                        FROM registration_system.registration r,
                                             registration_system.course c,
                                             registration_system.section s
                                        WHERE r.studentAccount = '" . $studentAccount . "'
                                          AND s.sectionCRN = r.sectionCRN
                                          AND c.courseName = s.sectionCourse
                                      )
                               SELECT SUM(c.courseCredits)        AS totalAttempted,
                                      (SELECT SUM(c.courseCredits)
                                       FROM registration_system.registration r,
                                            registration_system.course c,
                                            registration_system.section s
                                       WHERE r.studentAccount = '" . $studentAccount . "'
                                         AND s.sectionCRN = r.sectionCRN
                                         AND c.courseName = s.sectionCourse
                                         AND r.finalGrade > 1.33) AS totalEarned,
                                      CASE
                                        WHEN totalGPA > 3.00 THEN 'Excellent'
                                        WHEN totalGPA > 1.67 THEN 'Good'
                                        WHEN totalGPA > 0.00 THEN 'Poor'
                                        ELSE 'Pending'
                                        END                       AS 'Academic Standing',
                                      totalGPA
                               FROM registration_system.registration r,
                                    registration_system.course c,
                                    registration_system.section s,
                                    LogTotalGPA
                               WHERE r.studentAccount = '" . $studentAccount . "'
                                 AND c.courseName = s.sectionCourse
                                 AND s.sectionCRN = r.sectionCRN;";
        viewBasicTableFromSQL($conn, $sqlTranscriptTotals, $current_page, 'transcript-totals');
    }

    /**
     * Displays an account message from sql result
     *
     * @param $message
     */
    function displayMessage($message): void
    {
        echo '<div class="message-card">';
        echo '    <div class="message-subject">';
        echo $message['messageSubject'];
        echo '    </div>';
        echo '    <div class="message-body">';
        echo '        <p class="message-body-text">' . nl2br($message['messageBody']) . '</p>';
        if ($message['messageSender'] !== null)
        {
            echo '<span>- </span><a href="mailto: ' . $message['messageSender'] . '" class="message-body-from">' . $message['messageSender'] . '</a>';
        }
        echo '        <p class="message-body-timestamp">' . $message['messageTime'] . '</p>';
        echo '    </div>';
        echo '</div>';
    }
