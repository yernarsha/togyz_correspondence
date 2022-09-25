<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chess Game</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php

require 'connection.php';
require 'lib.php';
require 'vendor/autoload.php';

use \PChess\Chess\Chess;
use \PChess\Chess\Output\UnicodeOutput;
use \PChess\Chess\Output\AsciiOutput;

$id = intval($_GET['id']);

mysqli_set_charset($connect, "utf8");
$sql_stmt = "SELECT * FROM gameschess WHERE `id` = " . $id;
$result = mysqli_query($connect, $sql_stmt);

while ($row = mysqli_fetch_array($result)) {
    $chess = new Chess();

    echo $row['_white'] . ' - ' . $row['_black'] . ' ' . getResult($row['_result']) . '<br><br>';
    $seq = $row['_seq'];

    $pgn = '';
    $i = 0;

    $arr = explode(' ', $seq);
    foreach ($arr as $item) {
        $from = substr($item,0,2);
        $to = substr($item,2,2);
        $chess->move(['from' => $from, 'to' => $to]);

        $i++;
        if ($i % 2 == 0) {
            $pgn .= ' ' . $item;
        } else {
            if (!empty($item)) {
                $pgn .= ' ' . ((int)($i / 2) + 1) . '. ' . $item;
            }
        }
    }

    echo trim($pgn) . '<br><br>';

    $uni = (new UnicodeOutput())->render($chess);
    $ascii = (new AsciiOutput())->render($chess);
    $uni = normalize($uni);
    $ascii = normalize($ascii);

    echo $uni . '<br>';
    echo $ascii . '<br>';
    break;
}
?>

</body>
</html>
