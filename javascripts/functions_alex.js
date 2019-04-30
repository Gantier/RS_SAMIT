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

function faFilter()
{
    var faTable = document.getElementById("fa-table");
    if (document.getElementById("fa-keyword") !== null)
    {
        var keyword = document.getElementById("fa-keyword").value;
    }
    var helperText = document.getElementById("fa-helper-text");
    var section = document.getElementById("fa-section-dropdown").value;

    var newHelperText = "Showing all students filtered by...";

    for (var i = 1; i < faTable.rows.length; i++)
    {
        //if section is set
        if (section !== "null")
        {
            //check section
            if (section !== faTable.rows[i].cells[2].innerText)
            {
                faTable.rows[i].style.display = 'none';
            }
        }
    }

    //if filter not blank
    if (section !== "null")
    {
        //update helper text
        newHelperText += "<br>Section CRN: '" + section + "'";
        if (keyword.length > 1)
        {
            newHelperText += "<br>Containing: '" + keyword + "'";
        }
        helperText.innerHTML = newHelperText;
    }
    else
    {
        //else, default helper text
        helperText.innerHTML = "Showing all students...";
    }
}

// noinspection JSUnusedGlobalSymbols
function updateStudentRegistrationDetails(
    sectionIdSelected, detailsTextId, detailsTitleId, addButton, descriptionColumn, allPreReqs)
{
    var courseTitle = sectionIdSelected.cells[3].innerText;
    document.getElementById(detailsTextId).innerHTML =
        "<h4>Course Title:</h4>" +
        courseTitle + " - " +
        sectionIdSelected.cells[1].innerText +
        "<br><br><h4>Prerequisites:</h4>" +
        getPrintablePreReqsOfCourse(courseTitle, allPreReqs) +
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
    sectionIdSelected, detailsTextId, detailsTitleId, descriptionColumn, allPreReqs)
{
    var courseTitle = sectionIdSelected.cells[3].innerText;
    document.getElementById(detailsTextId).innerHTML =
        "<h4>Course Title:</h4>" +
        courseTitle + " - " +
        sectionIdSelected.cells[1].innerText +
        "<br><br><h4>Prerequisites:</h4>" +
        getPrintablePreReqsOfCourse(courseTitle, allPreReqs) +
        "<br><br><h4>Course Description:</h4>" +
        sectionIdSelected.cells[descriptionColumn].innerText;
    document.getElementById(detailsTitleId).innerHTML =
        "Section Details - CRN: " +
        sectionIdSelected.cells[0].innerText;
}

// noinspection JSUnusedGlobalSymbols
function updateFacultyAcademics(sectionIdSelected, detailsTextId0, detailsTextId1, accountId, sectionId)
{
    var studentName = sectionIdSelected.cells[0].innerText;
    var studentAccount = sectionIdSelected.cells[1].innerText;
    var studentSection = sectionIdSelected.cells[2].innerText.substr(0, 4);

    document.getElementById(detailsTextId0).innerHTML =
        "Section " + studentSection + " - " +
        studentName + "<br>";
    document.getElementById(detailsTextId1).innerHTML =
        studentAccount;
    document.getElementById(accountId).value = studentAccount;
    document.getElementById(sectionId).value = studentSection;
}

function fAAddToBatchOnClick()
{
    //check if a student is selected
    var helper = document.getElementById('fa-helper-text');
    var accountText = document.getElementById('fa-details-text1').innerText;
    if (accountText !== "")
    {
        //get elements
        var midterm = document.getElementById('fa-midterm-dropdown');
        var final = document.getElementById('fa-final-dropdown');
        var absent = document.getElementById('fa-radio-absent');

        //get text
        var sectionText = document.getElementById('fa-student-section').value;
        var midtermText = (midterm.disabled === true) ?
            "null" : midterm.options[midterm.selectedIndex].value;
        var finalText = (final.disabled === true) ?
            "null" : final.options[final.selectedIndex].value;
        var attendanceText = (absent.checked === true) ? "absent" : "present";
        var key = accountText + ";" + sectionText;
        var addTextToBatch = accountText + ";" + sectionText + ";" + midtermText + ";" +
            finalText + ";" + attendanceText + ",";

        //add to helper text
        var helperAfter = "";
        if (midtermText !== "null")
        {
            helperAfter += "\nMidterm grade: " + midtermText;
        }
        if (finalText !== "null")
        {
            helperAfter += "\nFinal grade: " + finalText;
        }
        helperAfter += "\nAttendance: " + attendanceText;

        //check batch for duplicates
        var batch = document.getElementById('fa-batch');
        var textToSearch = batch.value;
        var match = textToSearch.match(key);
        if (match == null)//no duplicates
        {
            //add to batch
            batch.value += addTextToBatch;

            //adjust the bar
            var table = document.getElementById('fa-table');
            var numRows = table.rows.length - 1;
            var progressBar = document.getElementById('fa-hr-progress-bar');
            var maxWidth = 316;
            var currentWidth = progressBar.offsetWidth - 2;
            var increment = maxWidth / numRows;
            var newWidth = currentWidth + increment;
            progressBar.style.width = newWidth + "px";

            //update helper
            if (midtermText === "null" && finalText === "null")
            {
                helper.innerText = "Recorded attendance for the following student..." +
                    "\nAccount: " + accountText + ", section: " + sectionText + helperAfter;
            }
            else
            {
                helper.innerText = "Updated grades and attendance for the following student..." +
                    "\nAccount: " + accountText + ", section: " + sectionText + helperAfter;
            }
        }
        else
        {
            helper.innerText = "Overwriting previous entry for the following student..." +
                "\nAccount: " + accountText + ", section: " + sectionText + helperAfter;
        }
    }
    else
    {
        helper.innerText = "Click a row from the table on the right to edit the respective " +
            "student's midterm/final grades and record daily attendance..."
    }
}

function fAClearBatchOnClick()
{
    var batch = document.getElementById('fa-batch');
    batch.value = "";

    //clear the bar
    var progressBar = document.getElementById('fa-hr-progress-bar');
    progressBar.style.width = "0";

    var helper = document.getElementById('fa-helper-text');
    helper.innerText = "Cleared all additions to the batch...";
}

// noinspection JSUnusedGlobalSymbols
function daLoadIcons()
{
    var tableIconLeg = document.getElementById('sada-icon-legend');
    var tableProgReq = document.getElementById('sada-program-req');
    var tableGenEdReq = document.getElementById('sada-gen-ed-req');
    var tableCoreReq = document.getElementById('sada-core-req');

    for (var h = 0; h < tableIconLeg.rows[1].cells.length; h++)
    {
        switch (tableIconLeg.rows[1].cells[h].innerText)
        {
            case 'complete':
                tableIconLeg.rows[1].cells[h].innerHTML =
                    '<i class="da-icon material-icons md-22 success">check_box</i>';
                break;
            case 'incomplete':
                tableIconLeg.rows[1].cells[h].innerHTML =
                    '<i class="da-icon material-icons md-22 failure">report</i>';
                break;
            case 'inProgress':
                tableIconLeg.rows[1].cells[h].innerHTML =
                    '<i class="da-icon material-icons md-22 neutral">indeterminate_check_box</i>';
                break;
            case 'notAttempted':
                tableIconLeg.rows[1].cells[h].innerHTML =
                    '<i class="da-icon material-icons md-22 blank">check_box_outline_blank</i>';
                break;
        }
    }

    for (var i = 0; i < tableProgReq.rows[1].cells.length; i++)
    {
        switch (tableProgReq.rows[1].cells[i].innerText)
        {
            case 'complete':
                tableProgReq.rows[1].cells[i].innerHTML =
                    '<i class="da-icon material-icons md-22 success">check_box</i>';
                break;
            case 'incomplete':
                tableProgReq.rows[1].cells[i].innerHTML =
                    '<i class="da-icon material-icons md-22 failure">report</i>';
                break;
            case 'inProgress':
                tableProgReq.rows[1].cells[i].innerHTML =
                    '<i class="da-icon material-icons md-22 neutral">indeterminate_check_box</i>';
                break;
            case 'notAttempted':
                tableProgReq.rows[1].cells[i].innerHTML =
                    '<i class="da-icon material-icons md-22 blank">check_box_outline_blank</i>';
                break;
        }
    }

    for (var j = 1; j < tableGenEdReq.rows.length; j++)
    {
        switch (tableGenEdReq.rows[j].cells[0].innerText)
        {
            case 'complete':
                tableGenEdReq.rows[j].cells[0].innerHTML =
                    '<i class="da-icon material-icons md-22 success">check_box</i>';
                break;
            case 'incomplete':
                tableGenEdReq.rows[j].cells[0].innerHTML =
                    '<i class="da-icon material-icons md-22 failure">report</i>';
                break;
            case 'inProgress':
                tableGenEdReq.rows[j].cells[0].innerHTML =
                    '<i class="da-icon material-icons md-22 neutral">indeterminate_check_box</i>';
                break;
            case 'notAttempted':
                tableGenEdReq.rows[j].cells[0].innerHTML =
                    '<i class="da-icon material-icons md-22 blank">check_box_outline_blank</i>';
                break;
        }
    }

    for (var k = 1; k < tableCoreReq.rows.length; k++)
    {
        switch (tableCoreReq.rows[k].cells[0].innerText)
        {
            case 'complete':
                tableCoreReq.rows[k].cells[0].innerHTML =
                    '<i class="da-icon material-icons md-22 success">check_box</i>';
                break;
            case 'incomplete':
                tableCoreReq.rows[k].cells[0].innerHTML =
                    '<i class="da-icon material-icons md-22 failure">report</i>';
                break;
            case 'inProgress':
                tableCoreReq.rows[k].cells[0].innerHTML =
                    '<i class="da-icon material-icons md-22 neutral">indeterminate_check_box</i>';
                break;
            case 'notAttempted':
                tableCoreReq.rows[k].cells[0].innerHTML =
                    '<i class="da-icon material-icons md-22 blank">check_box_outline_blank</i>';
                break;
        }
    }
}

function getPrintablePreReqsOfCourse(dependentCourse, fromPreReq2DArray)
{
    var preReqs;
    if (dependentCourse in fromPreReq2DArray)
    {
        //get preReqs
        preReqs = [];
        for (var i = 1; i < fromPreReq2DArray[dependentCourse].length; i++)
        {
            preReqs.push(fromPreReq2DArray[dependentCourse][i]);
        }
        //make printable
        var printPreReqs = "";
        printPreReqs += preReqs[0];
        if (preReqs.length > 1)
        {
            for (var j = 1; j < preReqs.length; j++)
            {
                printPreReqs += ",<br>";
                printPreReqs += preReqs[j];
            }
        }
        //return printable
        return printPreReqs;
    }
    else
    {
        return "None";
    }
}

function toggleEditPassword()
{
    var backdrop = document.getElementById('edit-pw-backdrop');
    var card = document.getElementById('edit-pw-card');

    if (backdrop.style.zIndex === '999')
    {
        backdrop.style.zIndex = '-999';
        card.style.zIndex = '-1000';
    }
    else
    {
        backdrop.style.zIndex = '999';
        card.style.zIndex = '1000';
    }
}


