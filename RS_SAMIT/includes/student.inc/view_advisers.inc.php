<div class="card home-view">
    <div class="card-title">
        Academic Advising
    </div>
    <div class="card-body align-left">
        <?php
            echo "<br>";
            foreach ($resultStudentAdvisers as &$adviser)
            {
                echo "Adviser: " . $adviser['adviserName'] .
                    "<br>Department: " . $adviser['adviserDepartment'] .
                    "<br>Contact: <a href = \"mailto: " . $adviser['adviserContact'] . "\">" . $adviser['adviserContact'] . "</a>" .
                    "<br><br>";
            } ?>
    </div>
</div>
