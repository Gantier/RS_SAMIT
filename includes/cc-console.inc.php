<div id="cc-console-container">
    <div class="card" id="cc-filter-card">
        <div class="card-title">
            Search Courses
        </div>
        <div class="card-body">
            <form>
                <input class="form-text-field" type="text" name="keyword" id="keyword" oninput="ccInstantSearch()"
                       placeholder="Instant search all..."><br><br>
                <hr>
                <label>Filter Courses</label><br>
                <label for="subject-dropdown"></label>
                <select id="subject-dropdown">
                    <option value="null" selected hidden>Select subject...</option>
                    <option value="Business">Business</option>
                    <option value="Chemistry and Physics">Chemistry and Physics</option>
                    <option value="Computer Sciences">Computer Sciences</option>
                    <option value="History and Philosophy">History and Philosophy</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Psychology">Psychology</option>
                    <option value="Visual Arts">Visual Arts</option>
                </select><br>
                <label for="attribute-dropdown"></label>
                <select id="attribute-dropdown">
                    <option value="null" selected hidden>Select attribute...</option>
                    <option value="Liberal Arts">Liberal Arts</option>
                    <option value="Natural Sciences">Natural Sciences</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Western Traditions">Western Traditions</option>
                    <option value="Major Cultures">Major Cultures</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Social Science Designation">Social Science Designation</option>
                    <option value="Creativity and the Arts">Creativity and the Arts</option>
                </select>
                <label>Course number range:</label><br>
                <input class="form-text-field small" type="number" id="range-min" placeholder=" Minimum">
                <input class="form-text-field small" type="number" id="range-max" placeholder=" Maximum"><br>
                <button class="small-button outlined secondary" type="reset" onclick="ccReset()">Reset</button>
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


