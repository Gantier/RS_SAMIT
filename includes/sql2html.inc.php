<?php

    function table($result, $class, $caption)
    {
        $result->fetch_array(MYSQLI_ASSOC);
        echo '<div class="container ' . $class . '"><table class="' . $class . '"><caption>' . $caption . '</caption>';
        tableHead($result);
        tableBody($result);
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

    table($result, $class, $caption);
