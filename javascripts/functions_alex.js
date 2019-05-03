function srFilter()
{
    tableReset('sr-table', 'sr-helper-text',
        'Showing all sections...');

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
    tableReset('ms-table', 'ms-helper-text',
        'Showing all sections...');

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
    //restore all possible results
    tableReset('fa-table', 'fa-helper-text',
        'Showing all students...');
    var faTable = document.getElementById("fa-table");
    //restore base and limit rows to default
    if (!window.baseRow || !window.limitRow)
    {
        window.baseRow = 1;
        window.limitRow = faTable.rows.length;
    }

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

    //get index of first element in filter
    for (var j = 1; j < faTable.rows.length; j++)
    {
        if (faTable.rows[j].style.display === '')
        {
            window.baseRow = j;
            console.log(window.baseRow);
            break;
        }
    }

    //get number of new results from filtering
    var countVisibleRows = 0;
    console.log(countVisibleRows);
    for (var k = 1; k < faTable.rows.length; k++)
    {
        if (faTable.rows[k].style.display === '')
        {
            countVisibleRows++;
            console.log(countVisibleRows);
        }
    }
    window.limitRow = window.baseRow + countVisibleRows;

    //set highlighted row to base row after filtering
    faUpdateTableRow(faTable.rows[window.baseRow]);

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

function faReset()
{
    //restore all possible results
    tableReset('fa-table', 'fa-helper-text',
        'Showing all students...');
    var faTable = document.getElementById("fa-table");
    //restore base and limit rows to default
    window.baseRow = 1;
    window.limitRow = faTable.rows.length;
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
function faUpdateTableRow(rowElement)
{
    //clear drop-downs
    var midterm = document.getElementById('fa-midterm-dropdown');
    var final = document.getElementById('fa-final-dropdown');
    var present = document.getElementById('fa-radio-present');
    midterm.selectedIndex = midterm.options[0];
    final.selectedIndex = final.options[0];
    present.checked = true;

    //get relevant text from selected row
    var studentName = rowElement.cells[0].innerText;
    var studentAccount = rowElement.cells[1].innerText;
    var studentSection = rowElement.cells[2].innerText;
    var studentSectionText = rowElement.cells[2].innerText.substr(0, 4);

    //clear old row
    var table = document.getElementById('fa-table');
    if (window.currentRow > 0 && window.currentRow < table.rows.length)
    {
        table.rows[window.currentRow].style.backgroundColor = window.currentRowColor;
        for (var k = 0; k < table.rows[window.currentRow].cells.length; k++)
        {
            table.rows[window.currentRow].cells[k].style.borderColor = '#eff1f4';
            table.rows[window.currentRow].cells[k].style.color = '#6d7177';
        }
    }

    //save new row's color before it was highlighted
    window.currentRowColor = rowElement.style.backgroundColor;
    //highlight current row and label
    rowElement.style.backgroundColor = '#cee5d0';
    for (var j = 0; j < rowElement.cells.length; j++)
    {
        rowElement.cells[j].style.borderColor = '#cee5d0';
        rowElement.cells[j].style.color = '#1b5e20';
    }
    //update gui
    document.getElementById('fa-details-text0').style.backgroundColor = '#cee5d0';
    document.getElementById('fa-details-text0').style.color = '#1b5e20';
    document.getElementById('fa-details-text1').style.backgroundColor = '#cee5d0';
    document.getElementById('fa-details-text1').style.color = '#1b5e20';
    document.getElementById('traverse-table-button-container').style.display = '';

    //set new current row
    for (var i = 1; i < table.rows.length; i++)
    {
        if (table.rows[i].cells[1].innerText === studentAccount &&
            table.rows[i].cells[2].innerText === studentSection)
        {
            window.currentRow = i;
        }
    }

    //update labels
    document.getElementById('fa-details-text0').innerHTML =
        "Section " + studentSectionText + " - " +
        studentName + "<br>";
    document.getElementById('fa-details-text1').innerHTML =
        studentAccount;
    document.getElementById('fa-student-account').value = studentAccount;
    document.getElementById('fa-student-section').value = studentSectionText;
}

function faAddToBatchOnClick()
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
            var currentWidth = (progressBar.offsetWidth - 2);
            currentWidth = (currentWidth === 0) ? (currentWidth - 2) : parseFloat(progressBar.style.width);
            /*alert("currentWidth: " + currentWidth);*/
            var increment = maxWidth / numRows;
            /*alert("increment: " + increment);*/
            var newWidth = currentWidth + increment;
            /*alert("newWidth: " + newWidth);
            alert("newWidth: " + newWidth + "px");*/
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

function faClearBatchOnClick()
{
    var batch = document.getElementById('fa-batch');
    batch.value = "";

    //clear the bar
    var progressBar = document.getElementById('fa-hr-progress-bar');
    progressBar.style.width = "0";

    var helper = document.getElementById('fa-helper-text');
    helper.innerText = "Cleared all additions to the batch...";
}

function faTraverseTable(key)
{
    var faTable = document.getElementById('fa-table');
    //set globals
    if (!window.baseRow || !window.limitRow)
    {
        window.baseRow = 1;
        window.limitRow = faTable.rows.length;
    }
    //if current row is set
    if (window.currentRow)
    {
        var nextRow = (key === "ArrowUp") ? window.currentRow - 1 : window.currentRow + 1;
        var tableSize = window.limitRow;
        if (nextRow === window.baseRow - 1)//if at beginning
        {
            nextRow = tableSize - 1;//go to end
        }
        else if (nextRow === tableSize)//if at end
        {
            nextRow = window.baseRow;//go to beginning
        }
        faUpdateTableRow(faTable.rows[nextRow])
    }
}

// noinspection JSUnusedGlobalSymbols
function faLoadKeyListener()
{
    //hide traverse buttons
    document.getElementById('traverse-table-button-container').style.display = 'none';
    //set key listeners
    document.onkeydown = function (event)
    {
        event = event || window.event;
        var down = "ArrowDown";
        var up = "ArrowUp";
        if (event.key === down)
        {
            faTraverseTable(down);
        }
        if (event.key === up)
        {
            faTraverseTable(up);
        }
    };
}

// noinspection JSUnusedGlobalSymbols
function daLoadIcons(studentLevel)
{
    var tableIconLeg = document.getElementById('sada-icon-legend');
    var tableProgReq = document.getElementById('sada-program-req');
    if (studentLevel === 'Undergraduate')
    {
        var tableGenEdReq = document.getElementById('sada-gen-ed-req');
    }
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

    if (studentLevel === 'Undergraduate')
    {
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


