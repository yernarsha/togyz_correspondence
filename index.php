<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Correspondence games</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<br>
<p class="center-img">
    <img src="img/header.jpg" width="367" height="220">
</p>

<div class="container">
    <br><h1>Correspondence games</h1><br><br>
    <form method="post" action="correspondence.php">
        <select name="mode" class="combo">
            <option value="0">Select a game</option>
            <option value="1">Chess</option>
            <option value="2">Togyz Kumalak</option>
        </select>

        <button type="submit" class="btn btn-primary" name="select">Send</button>
    </form>
</div>

</body>
</html>
