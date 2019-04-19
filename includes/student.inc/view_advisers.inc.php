<div class="card home-view">
    <div class="card-title align-left">
        Academic Advising
    </div>
    <div class="card-body align-left">
        <?php
            if (isset($resultStudentAdvisers))
            {
                echo "Adviser: " . $resultStudentAdvisers[0]['adviserName'] .
                    "<br>Department: " . $resultStudentAdvisers[0]['adviserDepartment'] .
                    "<br>Contact: <a href = \"mailto: " . $resultStudentAdvisers[0]['adviserContact'] . "\">" .
                    $resultStudentAdvisers[0]['adviserContact'] . "</a><br>";
                if (sizeof($resultStudentAdvisers) > 1)
                {
                    for ($i = 1; $i < sizeof($resultStudentAdvisers); $i++)
                    {
                        echo "<br>Adviser: " . $resultStudentAdvisers[$i]['adviserName'] .
                            "<br>Department: " . $resultStudentAdvisers[$i]['adviserDepartment'] .
                            "<br>Contact: <a href = \"mailto: " . $resultStudentAdvisers[$i]['adviserContact'] . "\">" .
                            $resultStudentAdvisers[$i]['adviserContact'] . "</a>";
                    }
                }
            } ?>
    </div>
</div>
