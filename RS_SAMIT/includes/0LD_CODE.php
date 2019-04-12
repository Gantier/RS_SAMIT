<?php
    /*$filterResults = "Showing all graduate courses ";
    if (isset($_POST['cc-filter-submit']))
    {
        //Step 0: Guaranteed part of sql
        $sql = "SELECT c.courseName,
                      CONCAT(CONCAT(d.departmentTag, ' '), c.courseNumber) AS courseNumber,
                      c.courseSubject,
                      c.courseCredits,
                      c.courseAttribute,
                      c.courseDescription
                FROM registration_system.department d,
                    registration_system.course_graduate g,
                    registration_system.course c
                WHERE (g.courseGraduateName LIKE c.courseName
                  AND d.departmentName LIKE c.courseSubject)";

        //Step 1: Check KEYWORD search
        $keyword = $_POST['keyword'];
        if (!(empty($keyword)))
        {
            $sql .= " AND
                (c.courseName LIKE '%" . $keyword . "%' OR
                c.courseSubject LIKE '%" . $keyword . "%' OR
                c.courseAttribute LIKE '%" . $keyword . "%') ";
            $filterResults .= "containing '" . $keyword . "' ";
        }

        //Step 2: Check RANGES
        $min = $_POST['range-min'];
        $max = $_POST['range-max'];

        if (!(empty($min) && empty($max)))
        {
            $filterResults .= "with course numbers ";
            if (empty($min) && !empty($max))
            {
                $min = 0;
                $filterResults .= "below " . $max . " ";
            }
            else if (empty($max) && !empty($min))
            {
                $max = PHP_INT_MAX;
                $filterResults .= "above " . $min . " ";
            }
            else if (!empty($min) && !empty($max))
            {
                $filterResults .= "between " . $min . " and " . $max . " ";
            }
            $sql .= " AND (c.courseNumber >= $min AND c.courseNumber <= $max) ";
        }

        //Step 3: Check SUBJECT dropdown
        $subject = $_POST['subject-dropdown'];

        if ($subject != "null")
        {
            $sql .= " AND c.courseSubject LIKE '" . $subject . "' ";
            $filterResults .= "with the subject '" . $subject . "' ";
        }

        //Step 4: Check ATTRIBUTE dropdown
        $attribute = $_POST['attribute-dropdown'];

        if ($attribute != "null")
        {
            $sql .= " AND c.courseAttribute LIKE '" . $attribute . "' ";
            $filterResults .= "with the attribute '" . $attribute . "'...";
        }

        //Step Final: Guaranteed closing part of sql
        $sql = $sql . " ORDER BY c.courseSubject, c.courseNumber";
    }
    else
    {
        default sql query...
    }*/
