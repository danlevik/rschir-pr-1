<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Быстрая сортировка</title>
</head>
<body>

<?php

function quick_sort($array) {
    if (count($array) < 2) {
        return $array;
    }
    $pivot = $array[0];
    $less = array();
    $equal = array($pivot);
    $greater = array();
    for ($i = 1; $i < count($array); $i++) {
        $elem = $array[$i];
        if ($elem > $pivot) {
            $greater[] = $elem;
        } elseif ($elem < $pivot) {
            $less[] = $elem;
        } else {
            $equal[] = $elem;
        }
    }
    
    $less = quick_sort($less);
    $greater = quick_sort($greater);
    return array_merge($less, $equal, $greater);
}

if (isset($_GET['array'])) {
    $array = explode(",", $_GET["array"]);
    echo "<p>Исходный массив</p>";
    echo "<p>[".implode(", ", $array)."]</p>";
    $sorted_array = quick_sort($array);
    echo "<p>Отсортированный массив</p>";
    echo "<p>[".implode(", ", $sorted_array)."]</p>";
} else {
    echo "<p>Задайте числа, разделённые запятыми в параметре array, чтобы отсортировать их</p>
<p>
    http:localhost:8081/sort.php?array=5,2,3,9,..
</p>";
}
?>
</body>
</html>

