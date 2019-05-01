<?php if (isset($resultStudentCurrentSections)): ?>
    <div class="card sds-card">
        <div class="card-title sds-title">
            <button form="sds-form" type="submit" class="drop-sec-button"
                    id="edit-pw-button">Drop
            </button>
        </div>
        <div class="card-body sds-body">
            <?php for ($i = 0; $i < sizeof($resultStudentCurrentSections); $i++): ?>
                <!--suppress HtmlUnknownTarget -->
                <form method="post" action="includes/student.inc/drop-sections.php" id="sds-form">
                    <label>
                        <input type="checkbox" name="section-crn" class="check-box"
                               value="<?php echo $resultStudentCurrentSections[$i]['sectionCRN'] ?>">
                    </label>
                </form>
                <?php if ($i < sizeof($resultStudentCurrentSections) - 1): ?>
                    <br>
                <?php endif ?>
            <?php endfor ?>
        </div>
    </div>
<?php endif ?>
