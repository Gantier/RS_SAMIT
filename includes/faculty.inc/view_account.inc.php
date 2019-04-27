<div class="card home-view" id="fh-account-details">
    <div class="card-title align-left">
        Account Details
        <button id="edit-pw-button" onclick="toggleEditPassword()">Edit Password
        </button>
    </div>
    <div class="card-body align-left">
        <?php
            echo "Account: " . $_SESSION['userId'];
            echo "<br>Name: " . $_SESSION['facultyName'];
            if (isset($facultyDept))
            {
                echo "<br>Department: " . $facultyDept[0];
            }
            if (isset($facultyStatus))
            {
                echo "<br>Status: " . strtolower($facultyStatus[0]);
            }

            echo "<br><br>Schedule: " . strtolower($_SESSION['facultyType']);
            if (isset($facultyRank))
            {
                echo "<br>Rank: " . strtolower($facultyRank[0]);
            }
            if ($_SESSION['facultyType'] === 'Full-time')
            {
                if (isset($facultyTenure))
                {
                    echo "<br>Tenure status: " . $facultyTenure[0];
                }
                if (isset($facultySabbatical))
                {
                    echo "<br>Sabbatical: " . strtolower($facultySabbatical[0]);
                }
            }
        ?>
    </div>
</div>

