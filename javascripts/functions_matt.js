function massiveTableInstantSearch(tableId, searchId, helperTextId, activeHelperText, defaultHelperText, lastColumnToSearch)
{
    var table = document.getElementById(tableId);
    var keyword = document.getElementById(searchId).value.toLowerCase();
    var helperText = document.getElementById(helperTextId);
    var newHelperText = activeHelperText;

    //only display rows containing keyword
    for (var i = 1; i < table.rows.length; i++)
    {
        if (keyword.length > 1)
        {
            var textToSearch = "";
            var lastColumn = 0;
            if (lastColumnToSearch >= 0 &&
                lastColumnToSearch <= table.rows[i].cells.length - 1)
            {
                lastColumn = lastColumnToSearch;
            }

            for (var j = 0; j <= lastColumn; j++)
            {
                textToSearch += table.rows[i].cells[j].innerText + " ";
            }

            textToSearch = textToSearch.toLowerCase();
            var match = textToSearch.match(keyword);
            if (match == null)
            {
                table.rows[i].style.display = 'none'
            }
            else
            {
                table.rows[i].style.display = ''
            }
        }
        else
        {
            table.rows[i].style.display = '';
            helperText.innerHTML = defaultHelperText;
        }
    }

    //update helper text
    if (keyword.length > 1)
    {
        newHelperText += keyword + "'";
        helperText.innerHTML = newHelperText;
    }
}

function accountClick(adminId)
{
    var adminEmail = adminId.cells[0].innerText;

    var textFieldEdit = document.getElementById('ac-name-text-box-1');
    var textFieldDelete = document.getElementById('ac-delete-email-text-box');

    textFieldEdit.value = adminEmail;
    textFieldDelete.value = adminEmail;
}

function sectionClick(sectionClicked)
{
    var sectionCRN = sectionClicked.cells[0].innerText;
    var sectionTitle = sectionClicked.cells[3].innerText;

    var textFieldAddTitle = document.getElementById('ac-add-course-title-text-box');
    var textFieldEditTitle = document.getElementById('ac-edit-course-title-text-box');
    var textFieldDeleteCRN = document.getElementById('ac-delete-section-text-box');

    textFieldAddTitle.value = sectionTitle;
    textFieldEditTitle.value = sectionTitle;
    textFieldDeleteCRN.value = sectionCRN;
}

function ccAdminFilter()
{
    var ccTable = document.getElementById("ac-table-courses");
    if (document.getElementById("admin-cc-keyword") !== null)
    {
        var keyword = document.getElementById("admin-cc-keyword").value;
    }
    var helperText = document.getElementById("cc-helper-text");
    var min = document.getElementById("cc-range-min").value;
    var max = document.getElementById("cc-range-max").value;
    var subject = document.getElementById("admin-cc-subject-dropdown").value;
    if (document.getElementById("cc-attribute-dropdown") !== null)
    {
        var attribute = document.getElementById("cc-attribute-dropdown").value;
    }
    var newHelperText = "Showing all courses filtered by...";

    for (var i = 1; i < ccTable.rows.length; i++)
    {
        //if min is set
        if (min !== "")
        {
            //check min
            if (parseInt(ccTable.rows[i].cells[1].innerText.substring(3, 7)) < min)
            {
                ccTable.rows[i].style.display = 'none';
            }
        }
        //if max is set
        if (max !== "")
        {
            //check max
            if (parseInt(ccTable.rows[i].cells[1].innerText.substring(3, 7)) > max)
            {
                ccTable.rows[i].style.display = 'none';
            }
        }
        //if subject is set
        if (subject !== "null")
        {
            //check subject
            if (subject !== ccTable.rows[i].cells[2].innerText)
            {
                ccTable.rows[i].style.display = 'none';
            }
        }
        //if attribute is set
        if (attribute !== "null" && attribute != null)
        {
            //check attribute
            if (attribute !== ccTable.rows[i].cells[4].innerText)
            {
                ccTable.rows[i].style.display = 'none';
            }
        }
    }

    //if filter not blank
    if (!(min === "" && max === "" && subject === "null" && attribute === "null"))
    {
        //update helper text
        if (min !== "")
        {
            newHelperText += "<br>Minimum course number: " + min;
        }
        if (max !== "")
        {
            newHelperText += "<br>Maximum course number: " + max;
        }
        if (subject !== "null")
        {
            newHelperText += "<br>Course subject: '" + subject + "'";
        }
        if (attribute !== "null")
        {
            newHelperText += "<br>Course attribute: '" + attribute + "'";
        }
        if (keyword.length > 1)
        {
            newHelperText += "<br>Containing: '" + keyword + "'";
        }
        helperText.innerHTML = newHelperText;
    }
    else
    {
        //else, default helper text
        helperText.innerHTML = "Showing all courses...";
    }
}

function tableAdminReset($tableId, $helperTextId, $defaultHelperText)
{
    var ccTable = document.getElementById($tableId);
    var helperText = document.getElementById($helperTextId);

    //show all rows
    for (var i = 1; i < ccTable.rows.length; i++)
    {
        ccTable.rows[i].style.display = '';
    }

    helperText.innerHTML = $defaultHelperText;
}