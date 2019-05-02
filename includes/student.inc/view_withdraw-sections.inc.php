<?php if (isset($resultStudentCurrentSections)): ?>
    <div class="card sws-card">
        <div class="card-title sws-title">
            <button form="sws-form" type="submit" class="wd-sec-button" name="wd-sec-submit"
                    id="edit-pw-button">WD
            </button>
        </div>
        <div class="card-body sws-body">
            <!--suppress HtmlUnknownTarget -->
            <form method="post" action="includes/student.inc/withdraw-sections.inc.php" id="sws-form">
                <?php for ($i = 0;
                    $i < sizeof($resultStudentCurrentSections);
                    $i++): ?>
                <div class="check-box-container<?php
                    if ($i === sizeof($resultStudentCurrentSections) - 1)
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
                           value="<?php echo $resultStudentCurrentSections[$i]['sectionCRN'] ?>">
                </label>
        </div>
        <?php endfor ?>
        </form>
    </div>
    </div>
<?php endif ?>
