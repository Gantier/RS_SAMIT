function tableInstantSearch(tableId, searchId, helperTextId, activeHelperText, defaultHelperText, lastColumnToSearch)
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

function tableReset($tableId, $helperTextId, $defaultHelperText)
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

// noinspection JSUnusedGlobalSymbols
function updateCourseDescription(courseIdSelected, helperTextId, descriptionColumn)
{
    document.getElementById(helperTextId).innerHTML =
        "<h4>Course Title:</h4>" +
        courseIdSelected.cells[1].innerText + " - " +
        courseIdSelected.cells[0].innerText +
        "<br><br><h4>Course Description:</h4>" +
        courseIdSelected.cells[descriptionColumn].innerText;
}

function ccFilter()
{
    var ccTable = document.getElementById("cc-table");
    if (document.getElementById("cc-keyword") !== null)
    {
        var keyword = document.getElementById("cc-keyword").value;
    }
    var helperText = document.getElementById("cc-helper-text");
    var min = document.getElementById("cc-range-min").value;
    var max = document.getElementById("cc-range-max").value;
    var subject = document.getElementById("cc-subject-dropdown").value;
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
