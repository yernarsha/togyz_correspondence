<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Togyz Game</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php

require 'connection.php';
require 'lib.php';
require 'tog.php';

$id = intval($_GET['id']);

mysqli_set_charset($connect, "utf8");
$sql_stmt = "SELECT * FROM games WHERE `id` = " . $id;
$result = mysqli_query($connect, $sql_stmt);

while ($row = mysqli_fetch_array($result)) {
    echo $row['_white'] . ' - ' . $row['_black'] . ' ' . getResult($row['_result']) . '<br><br>';
    $seq = $row['_seq'];

    $arr = str_split($seq);
    $tBoard = new TogyzBoard();
    foreach ($arr as $item) {
        $move = intval($item);
        $tBoard->makeMove($move);
    }

    echo str_replace("\n", "<br>", $tBoard->printNotation()) . '<br><br>';
    $pos = str_replace(" ", "&nbsp;", $tBoard->printPosition());
    echo str_replace("\n", "<br>", $pos);
    break;
}
?>

</body>
</html>
