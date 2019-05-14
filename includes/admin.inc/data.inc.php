<?php
//prerequisites
$sqlUpperLevels = "SELECT DISTINCT req.dependentCourseName
                       FROM registration_system.requirement req;";
$resultUpperLevels = mysqli_fetch_all($conn->query($sqlUpperLevels), MYSQLI_ASSOC);
$preReqArray = array();
//for every distinct upper level course add an array to the preReqArray with that course as the first element
foreach ($resultUpperLevels as &$upperLevel)
{
    $preReqArray[$upperLevel['dependentCourseName']] = array($upperLevel['dependentCourseName']);
}
foreach ($preReqArray as $preReq)
{
    $sql = "SELECT prerequiredCourseName
                FROM registration_system.requirement req
                WHERE dependentCourseName = '" . $preReq[0] . "';";
    $result = mysqli_fetch_all($conn->query($sql), MYSQLI_ASSOC);
    foreach ($result as $item)
    {
        $preReqArray[$preReq[0]][] = $item['prerequiredCourseName'];
    }
}
function getPreReqsOfCourse($dependentCourse, $fromPreReq2DArray)
{
    if (array_key_exists($dependentCourse, $fromPreReq2DArray))
    {
        $preReqs = array();
        for ($i = 1; $i < sizeof($fromPreReq2DArray[$dependentCourse]); $i++)
        {
            $preReqs[] = $fromPreReq2DArray[$dependentCourse][$i];
        }
        return $preReqs;
    }
    else
    {
        return null;
    }
}

if (isset($_SESSION['userId']))
{
    //student advisers (sql to associative array)
    $sqlStudentAdvisers = "SELECT CONCAT(CONCAT(CONCAT(f.facultyFirstName, ' '),
                                                     CONCAT(SUBSTR(f.facultyMiddleName, 1, 1), '. ')),
                                              f.facultyLastName)  AS adviserName,
                                        f.facultyDepartment       AS adviserDepartment,
                                        f.facultyAccount          AS adviserContact
                                FROM registration_system.faculty f,
                                     registration_system.adviser a
                                WHERE f.facultyAccount = a.facultyAccount
                                  AND a.studentAccount = '" . $_SESSION['userId'] . "';";
    $resultStudentAdvisers = mysqli_fetch_all($conn->query($sqlStudentAdvisers), MYSQLI_ASSOC);

    //student enrollments
    $sqlStudentEnrollments = "SELECT programName AS enrollmentProgram
                                  FROM registration_system.enrollment
                                  WHERE studentAccount = '" . $_SESSION['userId'] . "';";
    $resultStudentEnrollments = mysqli_fetch_all($conn->query($sqlStudentEnrollments), MYSQLI_ASSOC);

    //student total credits
    $sqlStudentCredits = "SELECT SUM(c.courseCredits) AS totalCredits
                              FROM registration_system.registration r,
                                   registration_system.course c,
                                   registration_system.section s
                              WHERE r.studentAccount = '" . $_SESSION['userId'] . "'
                                AND c.courseName = s.sectionCourse
                                AND s.sectionCRN = r.sectionCRN;";
    $resultStudentCredits = $conn->query($sqlStudentCredits);
    $studentCredits = mysqli_fetch_row($resultStudentCredits);

    //student hold
    $sqlStudentHold = "SELECT CASE
                                WHEN studentHold IS NULL THEN 'none'
                                ELSE studentHold END AS studentHold
                       FROM registration_system.student
                       WHERE studentAccount = '" . $_SESSION['userId'] . "'";
    $resultStudentHold = $conn->query($sqlStudentHold);
    $studentHold = mysqli_fetch_row($resultStudentHold);

    //student semesters attended
    $sqlStudentSemesters = "SELECT DISTINCT sec.sectionSemester AS semester
                                FROM registration_system.registration r,
                                     registration_system.section sec,
                                     registration_system.semester sem
                                WHERE r.sectionCRN = sec.sectionCRN
                                  AND sec.sectionSemester = sem.semesterName
                                  AND sem.semesterName != '" . $_SESSION['nextSemester'] . "'
                                  AND r.studentAccount = '" . $_SESSION['userId'] . "'
                                ORDER BY sem.semesterStartDate DESC";
    $resultStudentSemesters = mysqli_fetch_all($conn->query($sqlStudentSemesters), MYSQLI_ASSOC);

    //check if student satisfies preReq of given course
    function studentSatisfiesPreReqsOfCourse(mysqli $conn, $preReqArray, $studentId, $dependentCourse)
    {

        $preReqs = getPreReqsOfCourse($dependentCourse, $preReqArray);

        $sqlStudentSatisfiedCourses = "SELECT crse.courseName AS satisfiedCourse
                                           FROM registration_system.registration reg,
                                                registration_system.section sec,
                                                registration_system.course crse
                                           WHERE reg.sectionCRN = sec.sectionCRN
                                             AND sec.sectionCourse = crse.courseName
                                             AND reg.studentAccount = '" . $studentId . "'
                                             AND reg.finalGrade > 1.67;";
        $resultStudentSatisfiedCourses =
            mysqli_fetch_all($conn->query($sqlStudentSatisfiedCourses), MYSQLI_ASSOC);
        $satisfied = false;
        $countSatisfied = 0;
        foreach ($resultStudentSatisfiedCourses as $satisfiedCourse)
        {
            if (!empty($preReqs))
            {
                foreach ($preReqs as $preReq)
                {
                    //if satisfied
                    if ($preReq === $satisfiedCourse['satisfiedCourse'])
                    {
                        //count it
                        $countSatisfied++;
                    }
                }
            }
        }
        //if satisfied all preReqs
        if ($countSatisfied === sizeof($preReqs))
        {
            //then completely satisfied
            $satisfied = true;
        }
        return $satisfied;
    }

    //student messages
    $sqlStudentMessages = "SELECT messageSender, messageReceiver, messageSubject, messageBody, messageTime
                               FROM registration_system.message
                               WHERE messageReceiver = '" . $_SESSION['userId'] . "'
                               ORDER BY messageTime DESC;";
    $resultStudentMessages = mysqli_fetch_all($conn->query($sqlStudentMessages), MYSQLI_ASSOC);
}
