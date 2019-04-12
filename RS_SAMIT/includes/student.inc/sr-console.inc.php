<div id="sr-console-container">
    <div class="card" id="sr-filter-card">
        <div class="card-title">
            Search Sections
        </div>
        <div class="card-body">
            <form>
                <input class="form-text-field" type="text" id="sr-keyword"
                       oninput="tableInstantSearch('sr-table', 'sr-keyword', 'sr-helper-text',
                       <?php echo Constants::ACTIVE_SEARCH_SECTION_HELPER . ", " . Constants::DEFAULT_SECTION_HELPER ?>, 6)"
                       placeholder="Instant search all..."><br><br>
                <hr>
                <label>Filter Sections</label><br>
                <label for="sr-subject-dropdown"></label>
                <select id="sr-subject-dropdown">
                    <option value="null" selected hidden>Select subject...</option>
                    <?php
                        for ($i = 0; $i < sizeof(Constants::SUBJECTS); $i++)
                        {
                            echo '<option value="' . Constants::SUBJECTS[$i] . '">' . Constants::SUBJECTS[$i] . '</option>';
                        }
                    ?>
                </select><br>
                <label>Course number range:</label><br>
                <input class="form-text-field small" type="number" id="sr-range-min" placeholder=" Minimum">
                <input class="form-text-field small" type="number" id="sr-range-max" placeholder=" Maximum"><br>
                <button class="small-button outlined secondary" type="reset"
                        onclick="tableReset('sr-table', 'sr-helper-text', <?php echo Constants::DEFAULT_SECTION_HELPER; ?>)">
                    Reset
                </button>
                <button class="small-button outlined secondary" type="button" onclick="srFilter()">Filter</button>
            </form>
        </div>
    </div>
    <div class="card" id="sr-details-card">
        <div class="card-title" id="sr-details-title">
            Section Details
        </div>
        <div class="card-body" id="sr-details-body">
            <div id="sr-details-text">
                Select a section from the table on the right to view details and add to worksheet...
            </div>
        </div>
        <button class="big-button outlined secondary" id="sr-add-to-worksheet-button" type="button"
                onclick="addSectionToWorksheet()">Add to Worksheet
        </button>
    </div>
    <div class="card" id="sr-worksheet-card">
        <div class="card-title">
            Worksheet
        </div>
        <div class="card-body">
            <form action="register.inc.php" method="post" id="sr-register">
                <div>
                    <div class="sr-worksheet-entry">
                        <label for="sr-entry0"></label><input readonly class="sr-entry-text" id="sr-entry0"
                                                              name="sr-entry0" onclick="entryOnClickHelper()">
                        <div class="sr-entry-clear-button">
                            <button class="tiny-button outlined secondary" type="button">
                                <i class="material-icons sr-entry-icon" onclick="clearWorksheetEntry('sr-entry0')">
                                    clear</i>
                            </button>
                        </div>
                    </div>
                    <div class="sr-worksheet-entry">
                        <label for="sr-entry1"></label><input readonly class="sr-entry-text" id="sr-entry1"
                                                              name="sr-entry1" onclick="entryOnClickHelper()">
                        <div class="sr-entry-clear-button">
                            <button class="tiny-button outlined secondary" type="button">
                                <i class="material-icons sr-entry-icon" onclick="clearWorksheetEntry('sr-entry1')">
                                    clear</i>
                            </button>
                        </div>
                    </div>
                    <div class="sr-worksheet-entry">
                        <label for="sr-entry2"></label><input readonly class="sr-entry-text" id="sr-entry2"
                                                              name="sr-entry2" onclick="entryOnClickHelper()">
                        <div class="sr-entry-clear-button">
                            <button class="tiny-button outlined secondary" type="button">
                                <i class="material-icons sr-entry-icon" onclick="clearWorksheetEntry('sr-entry2')">
                                    clear</i>
                            </button>
                        </div>
                    </div>
                </div>
                <button class="big-button outlined secondary" type="submit">Register</button>
            </form>
        </div>
    </div>
    <div class="card card-body helper">
        <div class="helper" id="sr-helper-text">
            <?php echo Constants::DEFAULT_SECTION_HELPER ?>
        </div>
    </div>
</div>


