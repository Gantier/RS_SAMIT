function srFilter()
{
    alert("under construction")
}

// noinspection JSUnusedGlobalSymbols
function updateStudentRegistrationDescription(courseIdSelected, descriptionTextId, descriptionColumn)
{
    document.getElementById(descriptionTextId).innerHTML =
        "Course Name:<br>" +
        courseIdSelected.cells[3].innerText + " - " +
        courseIdSelected.cells[1].innerText +
        "<br><br>Course Description:<br>(Placeholder) CRN=" +
        courseIdSelected.cells[descriptionColumn].innerText;
}

