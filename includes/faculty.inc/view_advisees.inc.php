<?php if (isset($resultFacultyAdvisees) && $_SESSION['facultyType'] === 'Full-time'): ?>
    <div class="card home-view fh-advisee-list-card">
        <div class="card-title align-left">
            Academic Advisees
        </div>
        <div class="card-body align-left fh-advisee-list-body">
            <?php for ($i = 0; $i < sizeof($resultFacultyAdvisees); $i++): ?>
                <!--suppress HtmlUnknownTarget -->
                <form method="post" action="faculty_advisee_transcript.php">
                    Advisee:
                    <button class="outlined secondary" type="submit" name="advisee-submit">
                        <?php echo $resultFacultyAdvisees[$i]['adviseeName'] ?></button>
                    <label>
                        <input type="text" name="advisee-name" style="display: none" readonly
                               value="<?php echo $resultFacultyAdvisees[$i]['adviseeContact'] ?>">
                    </label>
                </form>
                <p>Contact: <a href="mailto: <?php echo $resultFacultyAdvisees[$i]['adviseeContact'] ?>">
                        <?php echo $resultFacultyAdvisees[$i]['adviseeContact'] ?></a></p>
                <?php if ($i < sizeof($resultFacultyAdvisees) - 1): ?>
                    <br>
                <?php endif ?>
            <?php endfor ?>
        </div>
    </div>
<?php endif ?>


