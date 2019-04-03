function ccUpdateCourseDescription(courseIdSelected) {
    document.getElementById("cc-description-text").innerHTML =
        "Course Name:<br>" +
        courseIdSelected.cells[1].innerText + " - " +
        courseIdSelected.cells[0].innerText +
        "<br><br>Course Description:<br>" +
        courseIdSelected.cells[5].innerText;
}
