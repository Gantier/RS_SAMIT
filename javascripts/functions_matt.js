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
            var lastColumn = 1;
            if (lastColumnToSearch >= 0 &&
                lastColumnToSearch <= table.rows[i].cells.length - 1)
            {
                lastColumn = lastColumnToSearch;
            }

            textToSearch += table.rows[i].cells[1].innerText + " ";

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