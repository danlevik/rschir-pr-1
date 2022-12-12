<h1>Корзина</h1>
<ol>
    <?php

    foreach ($data as $row){
        echo "<li>{$row['naming']} {$row['price']} {$row['amount']}</li>";
    }
    ?>
</ol>
<a href="../../index.php">На главную</a>
<br>
<a href="../../admin/AdminView.php">Админ-панель</a>