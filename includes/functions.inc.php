<?php

    function table($result, $containerId, $tableId, $caption, $rowClick)
    {
        echo '<div id="' . $containerId . '"><table  id="' . $tableId . '"><caption>' . $caption . '</caption>';
        tableHead($result);
        tableBody($result, $tableId, $rowClick);
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

    function tableBody($result, $tableId, $rowClick)
    {
        echo '<tbody>';
        foreach ($result as $x)
        {
            $printRow = '<tr class="' . $tableId . '" ';
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
