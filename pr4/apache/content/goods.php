<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Строймагазин</title>
</head>
<body>
<h1>Список товаров</h1>
<br>
<a href="admin/admin.php">ПАНЕЛЬ АДМИНИСТРАТОРА >>></a>
<br>
<ol>
    <?php
    $mysqli = new mysqli("db", "root", "example", "appDB");
    $table = $mysqli->query("SELECT * FROM material");
    foreach ($table as $row){
        echo "<li>{$row['naming']} {$row['price']}</li>";
    }
    ?>
</ol>
<a href="index.html">На главную</a>

</body>
</html>