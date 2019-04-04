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

    for (var i = 1; i < ccTable.rows.length; i++)
    {
        if (keyword !== "")
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
            ccTable.rows[i].style.display = ''
        }
    }
}
