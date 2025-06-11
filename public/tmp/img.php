<?php
// Create image instances
 $img_sign = new imagick('2.jpg');
//    $img->setImageFormat($ext);
    $img_sign->scaleImage(300, 45);
   // $img->cropImage($width, $height, 0, 0);
    $img_sign->writeImage('2.jpg');

$dest = imagecreatefromjpeg('1.jpg');
$src = imagecreatefromjpeg('2.jpg');

// Copy and merge
imagecopymerge($dest, $src, 270, 120,0, 0, 300, 45, 75);
$img=new imagick();

// Output
//header('Content-Type: image/gif');

imagepng($dest,'final.png');
?>