<div id="ms-console-container">
    <div class="card" id="ms-filter-card">
        <div class="card-title">
            Search Sections
        </div>
        <div class="card-body">
            <form>
                <input class="form-text-field" type="text" id="ms-keyword"
                       oninput="tableInstantSearch('ms-table', 'ms-keyword', 'ms-helper-text',
                       <?php echo Constants::ACTIVE_SEARCH_SECTION_HELPER . ", " . Constants::DEFAULT_SECTION_HELPER ?>, 6)"
                       placeholder="Instant search all..."><br><br>
                <hr>
                <label>Filter Sections</label><br>
                <label for="ms-subject-dropdown"></label>
                <select id="ms-subject-dropdown">
                    <option value="null" selected hidden>Select subject...</option>
                    <?php
                    for ($i = 0; $i < sizeof(Constants::SUBJECTS); $i++)
                    {
                        echo '<option value="' . Constants::SUBJECTS[$i] . '">' . Constants::SUBJECTS[$i] . '</option>';
                    }
                    ?>
                </select><br>
                <label>Course number range:</label><br>
                <input class="form-text-field small" type="number" id="ms-range-min" placeholder=" Minimum">
                <input class="form-text-field small" type="number" id="ms-range-max" placeholder=" Maximum"><br>
                <button class="small-button outlined secondary" type="reset"
                        onclick="tableReset('ms-table', 'ms-helper-text', <?php echo Constants::DEFAULT_SECTION_HELPER; ?>)">
                    Reset
                </button>
                <button class="small-button outlined secondary" type="button" onclick="msFilter()">Filter</button>
            </form>
        </div>
    </div>
    <div class="card" id="ms-details-card">
        <div class="card-title" id="ms-details-title">
            Section Details
        </div>
        <div class="card-body" id="ms-details-body">
            <div id="ms-details-text">
                Select a section from the table on the right to view details...
            </div>
        </div>
    </div>
    <div class="card card-body helper">
        <div class="helper" id="ms-helper-text">
            <?php echo Constants::DEFAULT_SECTION_HELPER ?>
        </div>
    </div>
</div>


