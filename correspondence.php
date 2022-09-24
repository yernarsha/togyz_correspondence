<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css"></head>
<body>

<?php
if ($_POST['mode'] === '0') {
    echo "Please select a mode.";
} else {
    require 'connection.php';
    require 'lib.php';

    $table_name = '';
    switch ($_POST['mode']) {
        case '1':
            $table_name = 'gameschess';
            $game_name = 'Chess';
            $game_type = 'chessg';
            break;
        case '2':
            $table_name = 'games';
            $game_name = 'Togyz Kumalak';
            $game_type = 'togyz';
            break;
    }

    if (!empty($table_name)) {
        echo '<h1>' . $game_name . ' Correspondence games</h1>';
        echo '<table class="table"><thead><tr>
<th style="width:10%">N</th><th style="width:70%">White - Black</th><th>Result</th>
</tr></thead><tbody>';

        mysqli_set_charset($connect, "utf8");
        $sql_stmt = "SELECT * FROM $table_name WHERE (_finished=1) AND (_active=1) ORDER BY _finishtime DESC";
        $result = mysqli_query($connect, $sql_stmt);

        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            $i++;
            if ($i % 3 == 0) {
                echo '<tr class="table-primary">';
            } else if ($i % 2 == 0) {
                echo '<tr class="table-success">';
            } else {
                echo '<tr class="table-warning">';
            }
            echo '<td><a href="' . $game_type . '.php?id=' . $row['id'] . '">' . $i .'.</a></td>';
            echo '<td>'. $row['_white'] . ' - ' . $row['_black'] . '</td>';
            echo '<td>'. getResult($row['_result']) .'</td>';

            echo '</tr>';
        }

        echo '</tbody></table>';
    }

}
?>

</body>
</html>

