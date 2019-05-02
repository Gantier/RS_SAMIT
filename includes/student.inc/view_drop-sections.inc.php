<?php if (isset($resultStudentNextSections)): ?>
    <div class="card sws-card">
        <div class="card-title sws-title">
            <button form="sds-form" type="submit" class="drop-sec-button" name="drop-sec-submit"
                    id="edit-pw-button">Drop
            </button>
        </div>
        <div class="card-body sws-body">
            <!--suppress HtmlUnknownTarget -->
            <form method="post" action="includes/student.inc/drop-sections.inc.php" id="sds-form">
                <?php for ($i = 0;
                    $i < sizeof($resultStudentNextSections);
                    $i++): ?>
                <div class="check-box-container<?php
                    if ($i === sizeof($resultStudentNextSections) - 1)
                    {
                        echo ' last';
                    }
                    if ($i === 0)
                    {
                        echo ' first';
                    }
                    if ($i % 2 !== 0)
                    {
                        echo ' odd';
                    }
                    else
                    {
                        echo ' even';
                    } ?>"
                <label>
                    <input type="checkbox" name="section-crn<?php echo $i; ?>" class="check-box"
                           value="<?php echo $resultStudentNextSections[$i]['sectionCRN'] ?>">
                </label>
        </div>
        <?php endfor ?>
        </form>
    </div>
    </div>
<?php endif ?>
