<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Леруру Мерлеле</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous"> -->
</head>
<body>
<h1>Список товаров</h1>
<ol>
    <?php
    $mysqli = new mysqli("db", "root", "example", "appDB");
    $result = $mysqli->query("SELECT * FROM basket");
    foreach ($result as $row){
        echo "<li>{$row['surname']} {$row['name']}</li>";
    }
    ?>
</ol>
<a href="../../index.php">На главную</a>
<br>
<a href="../../admin/AdminView.php">Админам сюда</a>
</body>
</html>