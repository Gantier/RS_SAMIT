<div id="cc-console-container">
    <div class="card" id="cc-filter-card">
        <div class="card-title">
            Filter Courses
        </div>
        <div class="card-body">
            <form action="<?php echo $current_page ?>" method="post">
                <input class="form-text-field search-cc" type="text" name="keyword" placeholder="Search keyword..."><br>
                <label>Course number range:</label><br>
                <input class="form-text-field small min" type="number" name="range-min" placeholder="Minimum">
                <input class="form-text-field small max" type="number" name="range-max" placeholder="Maximum"><br>
                <select name="subject-dropdown">
                    <option value="HiddenOption" selected hidden>Select subject...</option>
                    <option value="Business">Business</option>
                    <option value="Chemistry and Physics">Chemistry and Physics</option>
                    <option value="Computer Sciences">Computer Sciences</option>
                    <option value="History and Philosophy">History and Philosophy</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Psychology">Psychology</option>
                    <option value="Visual Arts">Visual Arts</option>
                </select><br>
                <select name="attribute-dropdown">
                    <option value="HiddenOption" selected hidden>Select attribute...</option>
                    <option value="Liberal Arts">Liberal Arts</option>
                    <option value="Natural Sciences">Natural Sciences</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Western Traditions">Western Traditions</option>
                    <option value="Major Cultures">Major Cultures</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Social Science Designation">Social Science Designation</option>
                    <option value="Creativity and the Arts">Creativity and the Arts</option>
                </select><br>
                <button class="big-button outlined secondary" type="submit" name="cc-filter-submit">Filter</button>
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
            <?php echo $filterResults ?>
        </p>
    </div>
</div>


