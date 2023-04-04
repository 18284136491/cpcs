<?php 
/**
by:pooy
date:18:06 2013年4月3日
http://www.pooy.net
**/
session_start();
//Settings: You can customize the captcha here
$image_width = 60;
$image_height = 30;
$characters_on_image = 4;
$font = 'ttf/simhei.ttf';

//The characters that can be used in the CAPTCHA code.
//avoid confusing characters (l 1 and i for example)
$possible_letters = '0123456789';
$random_dots = 0;
$random_lines = 3;
$captcha_text_color="0x000000";
$captcha_noice_color = "0x666666";

$code = '';

$i = 0;
while ($i < $characters_on_image) { 
$code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
$i++;
}


$font_size = $image_height * 0.75;
$image = @imagecreate($image_width, $image_height);


/* 设置背景，文本和噪音颜色 */
$background_color = imagecolorallocate($image, 231, 227, 224);

$arr_text_color = hexrgb($captcha_text_color);
$text_color = imagecolorallocate($image, 4,0,12);

$arr_noice_color = hexrgb($captcha_noice_color);
$image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], 
		$arr_noice_color['green'], $arr_noice_color['blue']);


/* 产生的点，随机的背景 */
for( $i=0; $i<$random_dots; $i++ ) {
imagefilledellipse($image, mt_rand(0,$image_width),
 mt_rand(0,$image_height), 2, 3, $image_noise_color);
}


/* 生成线图像的背景中的随机 */
for( $i=0; $i<$random_lines; $i++ ) {
imageline($image, mt_rand(0,$image_width), mt_rand(0,$image_height),
 mt_rand(0,$image_width), mt_rand(0,$image_height), $image_noise_color);
}


/* 创建一个文本框，并添加6个字母的代码 */
$textbox = imagettfbbox($font_size, 0, $font, $code); 
$x = ($image_width - $textbox[4])/2;
$y = ($image_height - $textbox[5])/2;
imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code);


/* 在页面的html页面显示验证码图片 */
header('Content-Type: image/jpeg');// defining the image type to be shown in browser widow
imagejpeg($image);//showing the image
imagedestroy($image);//destroying the image instance
$_SESSION['randcode'] = $code;

function hexrgb ($hexstr)
{
  $int = hexdec($hexstr);

  return array("red" => 0xFF & ($int >> 0x10),
               "green" => 0xFF & ($int >> 0x8),
               "blue" => 0xFF & $int);
}
?>