<div id="cc-console-container">
    <div class="card" id="cc-filter-card">
        <div class="card-title">
            Search Courses
        </div>
        <div class="card-body">
            <form>
                <input class="form-text-field" type="text" name="keyword" id="cc-keyword"
                       oninput="tableInstantSearch('cc-table', 'cc-keyword', 'cc-helper-text',
                       <?php echo Constants::ACTIVE_SEARCH_COURSE_HELPER . ", " . Constants::DEFAULT_COURSE_HELPER ?>,
                       <?php if (preg_match("[undergraduate]", $current_page)): ?>4<?php else: ?>3<?php endif ?>)"
                       placeholder="Instant search all..."><br><br>
                <hr>
                <label>Filter Courses</label><br>
                <label for="cc-subject-dropdown"></label>
                <select id="cc-subject-dropdown">
                    <option value="null" selected hidden>Select subject...</option>
                    <?php
                        for ($i = 0; $i < sizeof(Constants::SUBJECTS); $i++)
                        {
                            echo '<option value="' . Constants::SUBJECTS[$i] . '">' . Constants::SUBJECTS[$i] . '</option>';
                        }
                    ?>
                </select><br>
                <?php if (preg_match("[undergraduate]", $current_page)): ?>
                    <label for="cc-attribute-dropdown"></label>
                    <select id="cc-attribute-dropdown">
                        <option value="null" selected hidden>Select attribute...</option>
                        <?php
                            for ($i = 0; $i < sizeof(Constants::ATTRIBUTES); $i++)
                            {
                                echo '<option value="' . Constants::ATTRIBUTES[$i] . '">' . Constants::ATTRIBUTES[$i] . '</option>';
                            }
                        ?>
                    </select>
                <?php endif ?>
                <label>Course number range:</label><br>
                <input class="form-text-field small" type="number" id="cc-range-min" placeholder=" Minimum">
                <input class="form-text-field small" type="number" id="cc-range-max" placeholder=" Maximum"><br>
                <button class="small-button outlined secondary" type="reset"
                        onclick="tableReset('cc-table', 'cc-helper-text', <?php echo Constants::DEFAULT_COURSE_HELPER; ?>)">
                    Reset
                </button>
                <button class="small-button outlined secondary" type="button" onclick="ccFilter()">Filter</button>
            </form>
        </div>
    </div>
    <div class="card" id="cc-description-card">
        <div class="card-title">
            Course Description
        </div>
        <div class="card-body" id="cc-description-body">
            <p id="cc-description-text">
                Select a course from the table on the right to view its detailed description...
            </p>
        </div>
    </div>
    <div class="card card-body helper">
        <p class="helper" id="cc-helper-text">
            Showing all courses...
        </p>
    </div>
</div>


