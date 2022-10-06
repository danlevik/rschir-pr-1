<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Строймагазин</title>
</head>
<body>
<h1>Корзина</h1>
<ol>
    <?php
    $mysqli = new mysqli("db", "root", "example", "appDB");
    $table = $mysqli->query("SELECT * FROM basket");
    foreach ($table as $row){
        echo "<li>{$row['naming']} {$row['price']} {$row['amount']}</li>";
    }
    ?>
</ol>
<a href="index.html">На главную</a>
</body>
</html>