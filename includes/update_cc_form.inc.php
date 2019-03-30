<div class="update-cc-card">
    <div class="card-title">
        Filter Courses
    </div>

    <form action="<?php $current_page ?>" method="post">
        <input class = "form-text-field" type = "text" name = "keyword" placeholder="Search..."> <br>
        <input class = "form-text-field" type = "number" name = "range-min" placeholder ="Minimum">
        <input class = "form-text-field" type = "number" name = "range-max" placeholder ="Maximum"><br>
        <select class = "form-text-field" name = "subject-dropdown">
            <option value="HiddenOption"  selected hidden>Select Course Subject</option>
            <option value="Business">Business</option>
            <option value="Chemistry and Physics">Chemistry and Physics</option>
            <option value="Computer Sciences">Computer Sciences</option>
            <option value="History and Philosophy">History and Philosophy</option>
            <option value="Mathematics">Mathematics</option>
            <option value="Psychology">Psychology</option>
            <option value="Visual Arts">Visual Arts</option>
        </select> <br>
        <select class = "form-text-field" name = "attribute-dropdown">
            <option value="HiddenOption"  selected hidden>Select Course Attribute</option>
            <option value="Liberal Arts">Liberal Arts</option>
            <option value="Natural Sciences">Natural Sciences</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Western Traditions">Western Traditions</option>
            <option value="Major Cultures">Major Cultures</option>
            <option value="Mathematics">Mathematics</option>
            <option value="Social Science Designation">Social Science Designation</option>
            <option value="Creativity and the Arts">Creativity and the Arts</option>
        </select>
        <button type="submit" name="cc-filter-submit">Refresh</button>
    </form>

</div>
