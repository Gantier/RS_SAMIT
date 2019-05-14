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
        //admin messages
        $sqlAdminMessages = "SELECT messageSender, messageReceiver, messageSubject, messageBody, messageTime
                               FROM registration_system.message
                               WHERE messageReceiver = '" . $_SESSION['userId'] . "'
                               ORDER BY messageTime DESC;";
        $resultAdminMessages = mysqli_fetch_all($conn->query($sqlAdminMessages), MYSQLI_ASSOC);
    }
