<?php
$a = rand(1,99);
$b = rand(1,99);
$text = $a.' + '.$b;
$c = $a+$b;
$this->session->set_userdata('sess_captcha_code',$c);
$width = 95; //CAPTCHA image width
$height = 36; //CAPTCHA image height

$image_p = imagecreate($width, $height);
$black = imagecolorallocate($image_p, 255, 255, 255);
$white = imagecolorallocate($image_p, 0, 133, 186);
$font_size = 18; 
imagestring($image_p, $font_size, 5, 3, $text, $white);
imagejpeg($image_p, null, 80);
?>