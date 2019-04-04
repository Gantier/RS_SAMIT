// noinspection JSUnusedGlobalSymbols
function ccUpdateCourseDescription(courseIdSelected)
{
    document.getElementById("cc-description-text").innerHTML =
        "Course Name:<br>" +
        courseIdSelected.cells[1].innerText + " - " +
        courseIdSelected.cells[0].innerText +
        "<br><br>Course Description:<br>" +
        courseIdSelected.cells[5].innerText;
}

function ccInstantSearch()
{
    var ccTable = document.getElementById("cc-table");
    var keyword = document.getElementById("keyword").value.toLowerCase();
    var helperText = document.getElementById("cc-helper-text");
    var newHelperText = "Showing all courses containing: '";

    //only display rows containing keyword
    for (var i = 1; i < ccTable.rows.length; i++)
    {
        if (keyword.length > 1)
        {
            var textToSearch = ccTable.rows[i].cells[0].innerText + " " +
                ccTable.rows[i].cells[1].innerText + " " +
                ccTable.rows[i].cells[2].innerText + " " +
                ccTable.rows[i].cells[4].innerText;
            textToSearch = textToSearch.toLowerCase();
            var match = textToSearch.match(keyword);
            if (match == null)
            {
                ccTable.rows[i].style.display = 'none'
            }
            else
            {
                ccTable.rows[i].style.display = ''
            }
        }
        else
        {
            ccTable.rows[i].style.display = '';
            helperText.innerHTML = "Showing all courses...";
        }
    }

    //update helper text
    if (keyword.length > 1)
    {
        newHelperText += keyword + "'";
        helperText.innerHTML = newHelperText;
    }
}

function ccFilter()
{
    var ccTable = document.getElementById("cc-table");
    var keyword = document.getElementById("keyword").value;
    var helperText = document.getElementById("cc-helper-text");
    var min = document.getElementById("range-min").value;
    var max = document.getElementById("range-max").value;
    var subject = document.getElementById("subject-dropdown").value;
    var attribute = document.getElementById("attribute-dropdown").value;
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
        if (attribute !== "null")
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

function ccReset()
{
    var ccTable = document.getElementById("cc-table");
    var helperText = document.getElementById("cc-helper-text");

    //show all rows
    for (var i = 1; i < ccTable.rows.length; i++)
    {
        ccTable.rows[i].style.display = '';
    }

    helperText.innerHTML = "Showing all courses...";
}
