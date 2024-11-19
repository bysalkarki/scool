<?php
function quickSortAlgo($result, string $column)
{
    $arrays = [];

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrays[] = $row;
            }
        } else {
            echo "No data found!";
            exit;
        }

        
        quickSort($arrays, 0, count($arrays) - 1, $column);

        return $arrays;
    } else {
        return null;
    }
}


function quickSort(array &$arr, int $low, int $high, string $column)
{
    if ($low < $high) {
        
        $pivot = $arr[$high][$column];
        $i = $low - 1;

        for ($j = $low; $j < $high; $j++) {
            if (strcmp($arr[$j][$column], $pivot) < 0) {
                $i++;
                
                swap($arr, $i, $j);
            }
        }

        
        swap($arr, $i + 1, $high);

        
        $pi = $i + 1;

        
        quickSort($arr, $low, $pi - 1, $column);
        quickSort($arr, $pi + 1, $high, $column);
    }
}


function swap(array &$arr, int $i, int $j)
{
    $temp = $arr[$i];
    $arr[$i] = $arr[$j];
    $arr[$j] = $temp;
}
