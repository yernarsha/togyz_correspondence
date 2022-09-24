<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chess Game</title>
</head>
<body>

<?php

require 'connection.php';
require 'lib.php';

$id = intval($_GET['id']);

mysqli_set_charset($connect, "utf8");
$sql_stmt = "SELECT * FROM gameschess WHERE `id` = " . $id;
$result = mysqli_query($connect, $sql_stmt);

while ($row = mysqli_fetch_array($result)) {
    echo $row['_white'] . ' - ' . $row['_black'] . ' ' . getResult($row['_result']) . '<br><br>';
    $seq = $row['_seq'];

    $pgn = '';
    $i = 0;

    $arr = explode(' ', $seq);
    foreach ($arr as $item) {
        $i++;
        if ($i % 2 == 0) {
            $pgn .= ' ' . $item;
        } else {
            if (!empty($item)) {
                $pgn .= ' ' . ((int)($i / 2) + 1) . '. ' . $item;
            }
        }
    }

    echo trim($pgn);
    break;
}
?>

</body>
</html>
