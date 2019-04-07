<div id="sr-console-container">
    <div class="card" id="sr-filter-card">
        <div class="card-title">
            Search Sections
        </div>
        <div class="card-body">
            <form>
                <input class="form-text-field" type="text" name="keyword" id="sr-keyword"
                       oninput="tableInstantSearch('sr-table', 'sr-keyword', 'sr-helper-text',
                       <?php echo Constants::ACTIVE_SEARCH_SECTION_HELPER . ", " . Constants::DEFAULT_SECTION_HELPER ?>, 6)"
                       placeholder="Instant search all..."><br><br>
                <hr>
                <label>Filter Sections</label><br>
                <label for="subject-dropdown"></label>
                <select id="subject-dropdown">
                    <option value="null" selected hidden>Select subject...</option>
                    <?php
                        for ($i = 0; $i < sizeof(Constants::SUBJECTS); $i++)
                        {
                            echo '<option value="' . Constants::SUBJECTS[$i] . '">' . Constants::SUBJECTS[$i] . '</option>';
                        }
                    ?>
                </select><br>
                <label for="attribute-dropdown"></label>
                <select id="attribute-dropdown">
                    <option value="null" selected hidden>Select attribute...</option>
                    <?php
                        for ($i = 0; $i < sizeof(Constants::ATTRIBUTES); $i++)
                        {
                            echo '<option value="' . Constants::ATTRIBUTES[$i] . '">' . Constants::ATTRIBUTES[$i] . '</option>';
                        }
                    ?>
                </select>
                <label>Course number range:</label><br>
                <input class="form-text-field small" type="number" id="range-min" placeholder=" Minimum">
                <input class="form-text-field small" type="number" id="range-max" placeholder=" Maximum"><br>
                <button class="small-button outlined secondary" type="reset"
                        onclick="tableReset('sr-table', 'sr-helper-text', <?php echo Constants::DEFAULT_SECTION_HELPER; ?>)">
                    Reset
                </button>
                <button class="small-button outlined secondary" type="button" onclick="srFilter()">Filter</button>
            </form>
        </div>
    </div>
    <div class="card" id="sr-description-card">
        <div class="card-title">
            Section Details
        </div>
        <div class="card-body" id="sr-description-body">
            <p id="sr-description-text">
                Select a section from the table on the right to view details...
            </p>
        </div>
    </div>
    <div class="card card-body helper">
        <p class="helper" id="sr-helper-text">
            <?php echo Constants::DEFAULT_SECTION_HELPER ?>
        </p>
    </div>
</div>


