<div class="card home-view" id="sh-account-details">
    <div class="card-title">
        Account Details - <?php echo $_SESSION['userId'] ?>
    </div>
    <div class="card-body align-left">
        <?php
            echo "Name: " . $_SESSION['studentName'];
            echo "<br>Level: " . $_SESSION['studentLevel'];

            echo "<br><br>Enrollments...";
            foreach ($resultStudentEnrollments as &$enrollment)
            {
                echo "<br>Program: " . $enrollment['enrollmentProgram'];
            }
            echo "<br><br>Total credits: " . $studentCredits[0];

            echo "<br><br>Account hold: " . $studentHold[0];
        ?>
    </div>
</div>

