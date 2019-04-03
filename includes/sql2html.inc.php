<?php

    function table($result, $id, $caption, $rowClick)
    {
        $result->fetch_array(MYSQLI_ASSOC);
        echo '<div id="' . $id . '"><table  id="' . $id . '"><caption>' . $caption . '</caption>';
        tableHead($result);
        tableBody($result, $id, $rowClick);
        echo '</table></div>';
    }

    function tableHead($result)
    {
        echo '<thead>';
        foreach ($result as $x)
        {
            echo '<tr>';
            foreach ($x as $k => $y)
            {
                echo '<th>' . preg_replace("[^[a-z]+]", "", $k) . '</th>';
            }
            echo '</tr>';
            break;
        }
        echo '</thead>';
    }

    function tableBody($result, $id, $rowClick)
    {
        echo '<tbody>';
        foreach ($result as $x)
        {
            $printRow = '<tr class="' . $id . '" ';
            if ($rowClick)
            {
                $printRow .= $rowClick;
            }
            $printRow .= ">";
            echo $printRow;
            foreach ($x as $y)
            {
                echo '<td>' . $y . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
    }

    table($result, $id, $caption, $rowClick);
