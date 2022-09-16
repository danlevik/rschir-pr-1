<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drawer</title>    
</head>
<body>
<p>http:localhost:8081/drawer.php?num=[0..127]</p>
<?php
if (isset($_GET['num'])) {
    /*
    1 - size
    2 - size
    3 - blue
    4 - green
    5 - red
    6 - shape
    7 - shape
    */
    $num = $_GET['num'];
    $size = ($num & 3) + 1;
    $red = ($num >> 4) & 1;
    $green = ($num >> 3) & 1;
    $blue = ($num >> 2) & 1;
    $shape = ($num >> 5) & 3;

    $color = "#".($red == 1 ? "ff" : "00").($green == 1 ? "ff" : "00").($blue == 1 ? "ff" : "00")."";

    $shape_tag = "";

// Задаем форму фигуры
    switch ($shape) {
        case 0:
            // круг
            $r = ($size * 100 / 2);
            $shape_tag = "circle cx=".($r + 100)." cy=".($r + 100)." r=".$r." ";
            break;
        case 1:
            // квадрат
            $shape_tag = "rect x=10 y=10 width=".($size * 100)." height=".($size * 100)." ";
            break;
        case 2:
            // прямоугольник
            $shape_tag = "rect x=10 y=10 width=".($size * 100)." height=".($size * 200)." ";
            break;
        case 3:
            // треугольник
            $side = $size * 100;
            $shape_tag = "polygon points='".($side / 2 + 5).",10"." 10,".($side)." ".($side).",".($side)."' ";
    }
    echo "<svg width='1000' height='1000'>";
    echo "  <".$shape_tag."fill=".$color." style='stroke=".$color."' "."/>";
    echo "</svg>";
} else {
    echo "<p>Задайте число от 0 до 127 в параметре, чтобы нарисовать фигуру</p>";
}

?>
</body>
</html>


