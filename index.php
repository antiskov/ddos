<?php
if (isset($_POST['targets'])) {

    $targets = $_POST['targets'];

    $targets = str_replace('"', '', $targets);
    $targets = str_replace("'", '', $targets);
    $s = '"';

    $command = "php action.php " . $s . $targets . $s;

    exec($command);
}

require_once 'helpers.php';
$memavaible = (integer)getSystemMemInfo()['MemAvailable'];

echo 'free memory - ' . (integer)($memavaible / 1000) . 'mb';
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
</body>
</html>
