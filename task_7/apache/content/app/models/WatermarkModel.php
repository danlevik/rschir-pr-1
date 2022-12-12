<?php
class WatermarkModel extends Model {

    function addWatermark($image){
        $im = imagecreatefrompng($image);
        // Сначала создаём наше изображение штампа вручную с помощью GD
$stamp = imagecreatetruecolor(100, 70);
imagefilledrectangle($stamp, 0, 0, 99, 69, 0xF28482);
imagefilledrectangle($stamp, 9, 9, 90, 60, 0xFFFFFF);
imagestring($stamp, 5, 20, 20, 'Le"ru"ru merle"le', 0xF28482);
imagestring($stamp, 3, 20, 40, '(c) 2022', 0xF28482);

// Установка полей для штампа и получение высоты/ширины штампа
$marge_right = 100;
$marge_bottom = 100;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Слияние штампа с фотографией. Прозрачность 50%
imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);

// Сохранение фотографии в файл и освобождение памяти
imagepng($im, $image);
}

}