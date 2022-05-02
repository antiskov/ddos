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

function getMemoryLimit()
{
    $memory_limit = file_get_contents('memory_limit');

    if (!$memory_limit){
        file_put_contents('memory_limit', '100');
    }

    if (isset($_POST['memory_limit'])){
        file_put_contents('memory_limit', $_POST['memory_limit']);
    }

    return file_get_contents('memory_limit');
}

function markAttack()
{
    if (isset($_POST['stop'])){
        file_put_contents('rule', 'stop');
        while ((integer)(exec('docker ps -q | wc -l')) > 0){
            exec('docker rm --force $(docker ps -a -q)');
        }

    } else {
        file_put_contents('rule', 'start');
    }
}

function startAttack()
{
    $targets = $_POST['targets'];

    $targets = str_replace('"', '', $targets);
    $targets = str_replace("'", '', $targets);
    $s = '"';

    $command = "php action.php " . $s . $targets . $s;

    exec($command);
}

function setInfo()
{
    $memavaible = (integer)getSystemMemInfo()['MemAvailable'];

    echo 'free memory - ' . (integer)($memavaible / 1000) . 'mb';

    $count_of_attacks = exec('docker ps -q | wc -l');
    echo '<br>';
    echo 'count of attacks that are running- ' . $count_of_attacks;
}