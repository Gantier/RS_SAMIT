<?php
    if (isset($_POST['advisee-submit']))
    {
        $advisee = $_POST['advisee-name'];

        //student semesters attended
        $sqlAdviseeSemesters = "SELECT DISTINCT sec.sectionSemester AS semester
                                FROM registration_system.registration r,
                                     registration_system.section sec,
                                     registration_system.semester sem
                                WHERE r.sectionCRN = sec.sectionCRN
                                  AND sec.sectionSemester = sem.semesterName
                                  AND sem.semesterName != '" . $_SESSION['nextSemester'] . "'
                                  AND r.studentAccount = '" . $advisee . "'
                                ORDER BY sem.semesterStartDate DESC";
        $resultAdviseeSemesters = mysqli_fetch_all($conn->query($sqlAdviseeSemesters), MYSQLI_ASSOC);

        //student name
        $sqlAdviseeName = "SELECT CONCAT(CONCAT(CONCAT(studentFirstName, ' '), 
                                                  CONCAT(SUBSTR(studentMiddleName, 1, 1), '. ')),
                                                  studentLastName) AS name
                                              FROM registration_system.student
                                              WHERE studentAccount = '" . $advisee . "';";
        $adviseeName = loadSqlResultFirstRow($conn, $sqlAdviseeName, $current_page);

        //student level
        $sqlAdviseeLevel = "SELECT programName
                                                  FROM registration_system.enrollment e, 
                                                       registration_system.program_graduate pg
                                                  WHERE e.programName = pg.programGraduateName
                                                    AND e.studentAccount = '" . $advisee . "';";
        $adviseeLevel = "Undergraduate";
        if ($resultStudentLevel = $conn->query($sqlAdviseeLevel))
        {
            $rowCountStudentLevel = $resultStudentLevel->num_rows;
            if ($rowCountStudentLevel > 0)
            {
                $adviseeLevel = "Graduate";
            }
        }
    }
?>
<div class="card" id="fat-card">
    <div class="card-title" id="sag-card-title">
        Transcript - <?php if (isset($adviseeName))
        {
            echo $adviseeName;
        } ?>
    </div>
    <div class="card-body" id="sag-card-body">
        <?php
            if (isset($resultAdviseeSemesters))
            {
                if (isset($adviseeName))
                {
                    viewTranscript($conn, $current_page, $resultAdviseeSemesters,
                        $advisee, $adviseeName, $adviseeLevel);
                }
            }
        ?>
    </div>
</div>




