<?php

// modify input array
function modify_array(array $input)
{
    $output = [];
    foreach ($input as $key => $list) {
        foreach ($list as $i => $v) {
            $output[$i][$key] = $v;
        }
    }
    return $output;
}