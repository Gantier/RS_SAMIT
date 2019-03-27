<?php

    function table($result, $class)
    {
        $result->fetch_array(MYSQLI_ASSOC);
        echo '<table class="' . $class . '">';
        tableHead($result);
        tableBody($result);
        echo '</table>';
    }

    function tableHead($result)
    {
        echo '<thead>';
        foreach ($result as $x)
        {
            echo '<tr>';
            foreach ($x as $k => $y)
            {
                echo '<th>' . preg_replace("[course]", "", $k) . '</th>'; //THIS IS LAZY FIX LATER
            }
            echo '</tr>';
            break;
        }
        echo '</thead>';
    }

    function tableBody($result)
    {
        echo '<tbody>';
        foreach ($result as $x)
        {
            echo '<tr>';
            foreach ($x as $y)
            {
                echo '<td>' . $y . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
    }

    table($result, $class);
