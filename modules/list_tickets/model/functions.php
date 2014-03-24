<?php

function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false) {
    $position = array();
    $newRow = array();
    foreach ($toOrderArray as $key => $row) {
        $position[$key] = $row[$field];
        $newRow[$key] = $row;
    }
    if ($inverse) {
        arsort($position);
    } else {
        asort($position);
    }
    $returnArray = array();
    foreach ($position as $key => $pos) {
        $returnArray[] = $newRow[$key];
    }
    return $returnArray;
}
?>