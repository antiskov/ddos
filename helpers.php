<?php
function getSystemMemInfo()
{
    $data = explode("\n", file_get_contents("/proc/meminfo"));
    $meminfo = array();
    foreach ($data as $line) {
        $line_in_array = explode(":", $line);
        if (count($line_in_array) == 2){
            $meminfo[$line_in_array[0]] = trim($line_in_array[1]);
        }

    }
    return $meminfo;
}