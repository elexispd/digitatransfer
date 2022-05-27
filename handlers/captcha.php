<?php
$num1 = rand(0, 9);
$num2 = rand(0, 9);
$captcha_result = $num1 + $num2;
$math = "$num1". " + ". "$num1"." =";
session_start();
$_SESSION["rand_code"] = $captcha_result;

// $image = imagecreatetruecolor(120,  30);
// $black = imagecolrallocate($image, 0, 0, 0);
// $color = imagecolrallocate($image, 0, 100, 90);
// $white = imagecolrallocate($image, 0, 26, 26);

// imagefilledrectangle($image,0,0,399,99,$white);
// imagettftext($image, 20, 25,$color, $font, $math);

// header("Content-type: image/png");
// imagepng($image);