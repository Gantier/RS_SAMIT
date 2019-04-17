<?php
    if (isset($_POST['da-submit']))
    {
        //get any necessary data


        //get variables from posts
        $program = $_POST['da-program'];

        echo '<div class="card" id="sada-card">';
        echo '<div class="card-title" id="sada-card-title">Degree Audit</div>';
        echo '<div class="card-body" id="sada-card-body">';

        //student information
        echo '<p id="transcript-caption">Student Information</p>';
        $sqlDegreeAuditStudentView = "WITH LogTotalGPA AS
                                            (
                                              SELECT CAST(AVG(r.finalGrade) AS DECIMAL(3, 2)) AS studentGPA
                                              FROM registration_system.registration r,
                                                   registration_system.course c,
                                                   registration_system.section s
                                              WHERE r.studentAccount = '" . $_SESSION['userId'] . "'
                                                AND s.sectionCRN = r.sectionCRN
                                                AND c.courseName = s.sectionCourse
                                            )
                                     SELECT '" . $_SESSION['studentName'] . "'                                  AS Student,
                                            '" . $_SESSION['studentLevel'] . "'                                 AS studentLevel,
                                            RTRIM(REVERSE(SUBSTRING(REVERSE('" . $program . "'),
                                                                    LOCATE(' ', REVERSE('" . $program . "'))))) AS studentProgram,
                                            CASE SUBSTRING('" . $program . "', -4)
                                              WHEN 'B.S.' THEN 'Bachelor of Science'
                                              WHEN ' B.S' THEN 'Bachelor of Science'
                                              WHEN 'B.A.' THEN 'Bachelor of Art'
                                              WHEN ' B.A' THEN 'Bachelor of Art'
                                              WHEN 'M.S.' THEN 'Master of Science'
                                              WHEN ' M.S' THEN 'Master of Science'
                                              ELSE 'Minor'
                                              END                                                               AS 'Degree Sought',
                                            CASE
                                              WHEN " . $studentCredits[0] . " > 87 THEN 'Senior'
                                              WHEN " . $studentCredits[0] . " > 56 THEN 'Junior'
                                              WHEN " . $studentCredits[0] . " > 31 THEN 'Sophomore'
                                              ELSE 'Freshman'
                                              END                                                               AS 'Class Level',
                                            CASE
                                              WHEN studentGPA > 3.00 THEN 'Excellent'
                                              WHEN studentGPA > 1.67 THEN 'Good'
                                              WHEN studentGPA > 0.00 THEN 'Poor'
                                              ELSE 'Pending'
                                              END                                                               AS 'Academic Standing',
                                            studentGPA
                                     FROM registration_system.student s,
                                          registration_system.enrollment e,
                                          LogTotalGPA
                                     WHERE s.studentAccount = '" . $_SESSION['userId'] . "'
                                       AND e.studentAccount = '" . $_SESSION['userId'] . "'
                                     LIMIT 1;";
        viewBasicTableFromSQL($conn, $sqlDegreeAuditStudentView, $current_page, 'sada-student-view');

        //program requirements

        //general education requirements
        echo '<p id="transcript-caption">General Education Requirements (complete 6/8)</p>';
        $sqlDegreeAuditGenEdReqs =
            "WITH LiberalArts AS
            (
              SELECT CASE
                       WHEN reg.finalGrade >= 1.67 THEN 'complete'
                       ELSE 'incomplete'
                       END                                                   AS Progress,
                     crse.courseAttribute                                    AS Attribute,
                     CONCAT(CONCAT(d.departmentTag, ' '), crse.courseNumber) AS Course,
                     crse.courseName                                         AS Title,
                     CASE CONVERT(reg.finalGrade, CHAR(4))
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
                       ELSE 'IP' END                                         AS Grade,
                     sec.sectionSemester                                     AS Semester
              FROM course crse,
                   semester sem,
                   department d,
                   registration reg,
                   section sec
              WHERE d.departmentName = crse.courseSubject
                AND crse.courseAttribute = 'Liberal Arts'
                AND sec.sectionCRN = reg.sectionCRN
                AND sec.sectionCourse = crse.courseName
                AND reg.studentAccount = '" . $_SESSION['userId'] . "'
                AND sem.semesterName = sec.sectionSemester
              ORDER BY sem.semesterStartDate ASC
              LIMIT 1
            ),
          NaturalSciences AS
            (
              SELECT CASE
                       WHEN reg.finalGrade >= 1.67 THEN 'complete'
                       ELSE 'incomplete'
                       END                                                   AS Progress,
                     crse.courseAttribute                                    AS Attribute,
                     CONCAT(CONCAT(d.departmentTag, ' '), crse.courseNumber) AS Course,
                     crse.courseName                                         AS Title,
                     CASE CONVERT(reg.finalGrade, CHAR(4))
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
                       ELSE 'IP' END                                         AS Grade,
                     sec.sectionSemester                                     AS Semester
              FROM course crse,
                   semester sem,
                   department d,
                   registration reg,
                   section sec
              WHERE d.departmentName = crse.courseSubject
                AND crse.courseAttribute = 'Natural Sciences'
                AND sec.sectionCRN = reg.sectionCRN
                AND sec.sectionCourse = crse.courseName
                AND reg.studentAccount = '" . $_SESSION['userId'] . "'
                AND sem.semesterName = sec.sectionSemester
              ORDER BY sem.semesterStartDate ASC
              LIMIT 1
            ),
          ComputerScience AS
            (
              SELECT CASE
                       WHEN reg.finalGrade >= 1.67 THEN 'complete'
                       ELSE 'incomplete'
                       END                                                   AS Progress,
                     crse.courseAttribute                                    AS Attribute,
                     CONCAT(CONCAT(d.departmentTag, ' '), crse.courseNumber) AS Course,
                     crse.courseName                                         AS Title,
                     CASE CONVERT(reg.finalGrade, CHAR(4))
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
                       ELSE 'IP' END                                         AS Grade,
                     sec.sectionSemester                                     AS Semester
              FROM course crse,
                   semester sem,
                   department d,
                   registration reg,
                   section sec
              WHERE d.departmentName = crse.courseSubject
                AND crse.courseAttribute = 'Computer Science'
                AND sec.sectionCRN = reg.sectionCRN
                AND sec.sectionCourse = crse.courseName
                AND reg.studentAccount = '" . $_SESSION['userId'] . "'
                AND sem.semesterName = sec.sectionSemester
              ORDER BY sem.semesterStartDate ASC
              LIMIT 1
            ),
          WesternTraditions AS
            (
              SELECT CASE
                       WHEN reg.finalGrade >= 1.67 THEN 'complete'
                       ELSE 'incomplete'
                       END                                                   AS Progress,
                     crse.courseAttribute                                    AS Attribute,
                     CONCAT(CONCAT(d.departmentTag, ' '), crse.courseNumber) AS Course,
                     crse.courseName                                         AS Title,
                     CASE CONVERT(reg.finalGrade, CHAR(4))
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
                       ELSE 'IP' END                                         AS Grade,
                     sec.sectionSemester                                     AS Semester
              FROM course crse,
                   semester sem,
                   department d,
                   registration reg,
                   section sec
              WHERE d.departmentName = crse.courseSubject
                AND crse.courseAttribute = 'Western Traditions'
                AND sec.sectionCRN = reg.sectionCRN
                AND sec.sectionCourse = crse.courseName
                AND reg.studentAccount = '" . $_SESSION['userId'] . "'
                AND sem.semesterName = sec.sectionSemester
              ORDER BY sem.semesterStartDate ASC
              LIMIT 1
            ),
          MajorCultures AS
            (
              SELECT CASE
                       WHEN reg.finalGrade >= 1.67 THEN 'complete'
                       ELSE 'incomplete'
                       END                                                   AS Progress,
                     crse.courseAttribute                                    AS Attribute,
                     CONCAT(CONCAT(d.departmentTag, ' '), crse.courseNumber) AS Course,
                     crse.courseName                                         AS Title,
                     CASE CONVERT(reg.finalGrade, CHAR(4))
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
                       ELSE 'IP' END                                         AS Grade,
                     sec.sectionSemester                                     AS Semester
              FROM course crse,
                   semester sem,
                   department d,
                   registration reg,
                   section sec
              WHERE d.departmentName = crse.courseSubject
                AND crse.courseAttribute = 'Major Cultures'
                AND sec.sectionCRN = reg.sectionCRN
                AND sec.sectionCourse = crse.courseName
                AND reg.studentAccount = '" . $_SESSION['userId'] . "'
                AND sem.semesterName = sec.sectionSemester
              ORDER BY sem.semesterStartDate ASC
              LIMIT 1
            ),
          Mathematics AS
            (
              SELECT CASE
                       WHEN reg.finalGrade >= 1.67 THEN 'complete'
                       ELSE 'incomplete'
                       END                                                   AS Progress,
                     crse.courseAttribute                                    AS Attribute,
                     CONCAT(CONCAT(d.departmentTag, ' '), crse.courseNumber) AS Course,
                     crse.courseName                                         AS Title,
                     CASE CONVERT(reg.finalGrade, CHAR(4))
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
                       ELSE 'IP' END                                         AS Grade,
                     sec.sectionSemester                                     AS Semester
              FROM course crse,
                   semester sem,
                   department d,
                   registration reg,
                   section sec
              WHERE d.departmentName = crse.courseSubject
                AND crse.courseAttribute = 'Mathematics'
                AND sec.sectionCRN = reg.sectionCRN
                AND sec.sectionCourse = crse.courseName
                AND reg.studentAccount = '" . $_SESSION['userId'] . "'
                AND sem.semesterName = sec.sectionSemester
              ORDER BY sem.semesterStartDate ASC
              LIMIT 1
            ),
          SocialScienceDesignation AS
            (
              SELECT CASE
                       WHEN reg.finalGrade >= 1.67 THEN 'complete'
                       ELSE 'incomplete'
                       END                                                   AS Progress,
                     crse.courseAttribute                                    AS Attribute,
                     CONCAT(CONCAT(d.departmentTag, ' '), crse.courseNumber) AS Course,
                     crse.courseName                                         AS Title,
                     CASE CONVERT(reg.finalGrade, CHAR(4))
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
                       ELSE 'IP' END                                         AS Grade,
                     sec.sectionSemester                                     AS Semester
              FROM course crse,
                   semester sem,
                   department d,
                   registration reg,
                   section sec
              WHERE d.departmentName = crse.courseSubject
                AND crse.courseAttribute = 'Social Science Designation'
                AND sec.sectionCRN = reg.sectionCRN
                AND sec.sectionCourse = crse.courseName
                AND reg.studentAccount = '" . $_SESSION['userId'] . "'
                AND sem.semesterName = sec.sectionSemester
              ORDER BY sem.semesterStartDate ASC
              LIMIT 1
            ),
          CreativityAndTheArts AS
            (
              SELECT CASE
                       WHEN reg.finalGrade >= 1.67 THEN 'complete'
                       ELSE 'incomplete'
                       END                                                   AS Progress,
                     crse.courseAttribute                                    AS Attribute,
                     CONCAT(CONCAT(d.departmentTag, ' '), crse.courseNumber) AS Course,
                     crse.courseName                                         AS Title,
                     CASE CONVERT(reg.finalGrade, CHAR(4))
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
                       ELSE 'IP' END                                         AS Grade,
                     sec.sectionSemester                                     AS Semester
              FROM course crse,
                   semester sem,
                   department d,
                   registration reg,
                   section sec
              WHERE d.departmentName = crse.courseSubject
                AND crse.courseAttribute = 'Creativity and the Arts'
                AND sec.sectionCRN = reg.sectionCRN
                AND sec.sectionCourse = crse.courseName
                AND reg.studentAccount = '" . $_SESSION['userId'] . "'
                AND sem.semesterName = sec.sectionSemester
              ORDER BY sem.semesterStartDate ASC
              LIMIT 1
            ),
          LogTaken AS
            (
              SELECT LiberalArts.Progress,
                     LiberalArts.Attribute,
                     LiberalArts.Course,
                     LiberalArts.Title,
                     LiberalArts.Grade,
                     LiberalArts.Semester
              FROM LiberalArts
              UNION
              SELECT NaturalSciences.Progress,
                     NaturalSciences.Attribute,
                     NaturalSciences.Course,
                     NaturalSciences.Title,
                     NaturalSciences.Grade,
                     NaturalSciences.Semester
              FROM NaturalSciences
              UNION
              SELECT ComputerScience.Progress,
                     ComputerScience.Attribute,
                     ComputerScience.Course,
                     ComputerScience.Title,
                     ComputerScience.Grade,
                     ComputerScience.Semester
              FROM ComputerScience
              UNION
              SELECT WesternTraditions.Progress,
                     WesternTraditions.Attribute,
                     WesternTraditions.Course,
                     WesternTraditions.Title,
                     WesternTraditions.Grade,
                     WesternTraditions.Semester
              FROM WesternTraditions
              UNION
              SELECT MajorCultures.Progress,
                     MajorCultures.Attribute,
                     MajorCultures.Course,
                     MajorCultures.Title,
                     MajorCultures.Grade,
                     MajorCultures.Semester
              FROM MajorCultures
              UNION
              SELECT Mathematics.Progress,
                     Mathematics.Attribute,
                     Mathematics.Course,
                     Mathematics.Title,
                     Mathematics.Grade,
                     Mathematics.Semester
              FROM Mathematics
              UNION
              SELECT SocialScienceDesignation.Progress,
                     SocialScienceDesignation.Attribute,
                     SocialScienceDesignation.Course,
                     SocialScienceDesignation.Title,
                     SocialScienceDesignation.Grade,
                     SocialScienceDesignation.Semester
              FROM SocialScienceDesignation
              UNION
              SELECT CreativityAndTheArts.Progress,
                     CreativityAndTheArts.Attribute,
                     CreativityAndTheArts.Course,
                     CreativityAndTheArts.Title,
                     CreativityAndTheArts.Grade,
                     CreativityAndTheArts.Semester
              FROM CreativityAndTheArts
              ORDER BY Semester ASC
            ),
          LogCurriculum AS
            (
              SELECT DISTINCT 'notAttempted'  AS Progress,
                              courseAttribute AS Attribute,
                              ' '             AS Course,
                              ' '             AS Title,
                              ' '             AS Grade,
                              ' '             AS Semester
              FROM course
              ORDER BY Attribute DESC
              LIMIT 8
            )
     SELECT LogTaken.*
     FROM LogTaken
     UNION
     SELECT LogCurriculum.*
     FROM LogCurriculum
            LEFT JOIN LogTaken ON (LogCurriculum.Attribute = LogTaken.Attribute)
     WHERE LogTaken.Attribute IS NULL;";
        viewBasicTableFromSQL($conn, $sqlDegreeAuditGenEdReqs, $current_page, 'sada-gen-ed-req');

        echo '<p id="transcript-caption">Core Curriculum Requirements</p>';
        $sqlDegreeAuditCoreReqs = "WITH LogCurr AS
                                  (
                                    SELECT 'notAttempted'                                          AS Progress,
                                           crse.courseName                                         AS Title,
                                           CONCAT(CONCAT(d.departmentTag, ' '), crse.courseNumber) AS Course,
                                           ' '                                                     AS Grade,
                                           ' '                                                     AS Semester
                                    FROM course crse,
                                         department d,
                                         curriculum curr
                                    WHERE d.departmentName = crse.courseSubject
                                      AND curr.curriculumCourse = crse.courseName
                                      AND curr.curriculumProgram = '" . $program . "'
                                  ),
                                LogTaken AS
                                  (
                                    SELECT CASE
                                             WHEN reg.finalGrade IS NULL THEN 'inProgress'
                                             WHEN reg.finalGrade >= 1.67 THEN 'complete'
                                             ELSE 'incomplete'
                                             END                                                   AS Progress,
                                           crse.courseName                                         AS Title,
                                           CONCAT(CONCAT(d.departmentTag, ' '), crse.courseNumber) AS Course,
                                           CASE CONVERT(reg.finalGrade, CHAR(4))
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
                                             ELSE 'IP' END                                         AS Grade,
                                           sec.sectionSemester                                     AS Semester
                                    FROM course crse,
                                         semester sem,
                                         department d,
                                         curriculum curr,
                                         registration reg,
                                         section sec
                                    WHERE d.departmentName = crse.courseSubject
                                      AND curr.curriculumCourse = crse.courseName
                                      AND curr.curriculumProgram = '" . $program . "'
                                      AND sec.sectionCRN = reg.sectionCRN
                                      AND sec.sectionCourse = crse.courseName
                                      AND reg.studentAccount = '" . $_SESSION['userId'] . "'
                                      AND sem.semesterName = sec.sectionSemester
                                    ORDER BY sem.semesterStartDate ASC
                                  )
                           SELECT LogTaken.*
                           FROM LogTaken
                           UNION
                           SELECT LogCurr.*
                           FROM LogCurr
                                  LEFT JOIN LogTaken ON (LogCurr.Title = LogTaken.Title)
                           WHERE LogTaken.Title IS NULL;";
        viewBasicTableFromSQL($conn, $sqlDegreeAuditCoreReqs, $current_page, 'sada-core-req');

        echo '</div>';
        echo '</div>';
    }
