function srFilter()
{
    var srTable = document.getElementById("sr-table");
    if (document.getElementById("sr-keyword") !== null)
    {
        var keyword = document.getElementById("sr-keyword").value;
    }
    var helperText = document.getElementById("sr-helper-text");
    var min = document.getElementById("sr-range-min").value;
    var max = document.getElementById("sr-range-max").value;
    var subject = document.getElementById("sr-subject-dropdown").value;

    var newHelperText = "Showing all sections filtered by...";

    for (var i = 1; i < srTable.rows.length; i++)
    {
        //if min is set
        if (min !== "")
        {
            //check min
            if (parseInt(srTable.rows[i].cells[1].innerText.substring(3, 7)) < min)
            {
                srTable.rows[i].style.display = 'none';
            }
        }
        //if max is set
        if (max !== "")
        {
            //check max
            if (parseInt(srTable.rows[i].cells[1].innerText.substring(3, 7)) > max)
            {
                srTable.rows[i].style.display = 'none';
            }
        }
        //if subject is set
        if (subject !== "null")
        {
            //check subject
            if (subject !== srTable.rows[i].cells[7].innerText)
            {
                srTable.rows[i].style.display = 'none';
            }
        }
    }

    //if filter not blank
    if (!(min === "" && max === "" && subject === "null"))
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
            newHelperText += "<br>Section subject: '" + subject + "'";
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
        helperText.innerHTML = "Showing all sections...";
    }
}

function msFilter()
{
    var msTable = document.getElementById("ms-table");
    if (document.getElementById("ms-keyword") !== null)
    {
        var keyword = document.getElementById("ms-keyword").value;
    }
    var helperText = document.getElementById("ms-helper-text");
    var min = document.getElementById("ms-range-min").value;
    var max = document.getElementById("ms-range-max").value;
    var subject = document.getElementById("ms-subject-dropdown").value;

    var newHelperText = "Showing all sections filtered by...";

    for (var i = 1; i < msTable.rows.length; i++)
    {
        //if min is set
        if (min !== "")
        {
            //check min
            if (parseInt(msTable.rows[i].cells[1].innerText.substring(3, 7)) < min)
            {
                msTable.rows[i].style.display = 'none';
            }
        }
        //if max is set
        if (max !== "")
        {
            //check max
            if (parseInt(msTable.rows[i].cells[1].innerText.substring(3, 7)) > max)
            {
                msTable.rows[i].style.display = 'none';
            }
        }
        //if subject is set
        if (subject !== "null")
        {
            //check subject
            if (subject !== msTable.rows[i].cells[7].innerText)
            {
                msTable.rows[i].style.display = 'none';
            }
        }
    }

    //if filter not blank
    if (!(min === "" && max === "" && subject === "null"))
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
            newHelperText += "<br>Section subject: '" + subject + "'";
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
        helperText.innerHTML = "Showing all sections...";
    }
}

// noinspection JSUnusedGlobalSymbols
function updateStudentRegistrationDetails(
    sectionIdSelected, detailsTextId, detailsTitleId, addButton, descriptionColumn)
{
    document.getElementById(detailsTextId).innerHTML =
        "<h4>Course Title:</h4>" +
        sectionIdSelected.cells[3].innerText + " - " +
        sectionIdSelected.cells[1].innerText +
        "<br><br><h4>Prerequisites:</h4>" +
        "(under construction)" +
        "<br><br><h4>Course Description:</h4>" +
        sectionIdSelected.cells[descriptionColumn].innerText;
    document.getElementById(detailsTitleId).innerHTML =
        "Section Details - CRN: " +
        sectionIdSelected.cells[0].innerText;
    document.getElementById(addButton).style.display = 'inline-block';
}

function addSectionToWorksheet()
{
    var entryText = document.getElementById("sr-details-title").innerText;
    entryText = entryText.substring(entryText.length - 4, entryText.length);
    var helperText = document.getElementById("sr-helper-text");

    var entry0 = document.getElementById("sr-entry0");
    var entry1 = document.getElementById("sr-entry1");
    var entry2 = document.getElementById("sr-entry2");

    //check for empty slots and duplicate entries
    if (entry0.value === "")
    {
        if (!((entry1.value.length > 0 && entryText === entry1.value) ||
            (entry2.value.length > 0 && entryText === entry2.value)))
        {
            entry0.value = entryText;
            helperText.innerText = "Added section " + entryText + " to worksheet...";
        }
        else
        {
            helperText.innerText = "Error: duplicate entry for " + entryText + " in worksheet...";
        }
    }
    else if (entry1.value === "")
    {
        if (!((entry0.value.length > 0 && entryText === entry0.value) ||
            (entry2.value.length > 0 && entryText === entry2.value)))
        {
            entry1.value = entryText;
            helperText.innerText = "Added section " + entryText + " to worksheet...";
        }
        else
        {
            helperText.innerText = "Error: duplicate entry for " + entryText + " in worksheet...";
        }
    }
    else if (entry2.value === "")
    {
        if (!((entry0.value.length > 0 && entryText === entry0.value) ||
            (entry1.value.length > 0 && entryText === entry1.value)))
        {
            entry2.value = entryText;
            helperText.innerText = "Added section " + entryText + " to worksheet...";
        }
        else
        {
            helperText.innerText = "Error: duplicate entry for " + entryText + " in worksheet...";
        }
    }
    else
    {
        helperText.innerText = "Error: no more room for worksheet entry...";
    }
}

function clearWorksheetEntry(entryToClear)
{
    var entry = document.getElementById(entryToClear);
    var pastEntry = entry.value;

    var helperText = document.getElementById("sr-helper-text");
    helperText.innerText = "Cleared section " + pastEntry + " from worksheet...";

    entry.value = "";
}

function entryOnClickHelper()
{
    var helperText = document.getElementById("sr-helper-text");
    helperText.innerText = "Click a row from the table in order to add its section to the worksheet..."
}

// noinspection JSUnusedGlobalSymbols
function updateMasterScheduleDetails(
    sectionIdSelected, detailsTextId, detailsTitleId, descriptionColumn)
{
    document.getElementById(detailsTextId).innerHTML =
        "<h4>Course Title:</h4>" +
        sectionIdSelected.cells[3].innerText + " - " +
        sectionIdSelected.cells[1].innerText +
        "<br><br><h4>Prerequisites:</h4>" +
        "(under construction)" +
        "<br><br><h4>Course Description:</h4>" +
        sectionIdSelected.cells[descriptionColumn].innerText;
    document.getElementById(detailsTitleId).innerHTML =
        "Section Details - CRN: " +
        sectionIdSelected.cells[0].innerText;
}

