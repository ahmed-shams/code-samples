<?php
//session_start();
//include("../../../include/init.inc.php");
class CaptchaSecurityImages {

	var $font = 'monofont.ttf';

	function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz'; 
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}

	function CaptchaSecurityImages($width='120',$height='40',$characters='6') {
                $this->font = dirname(__FILE__).'/'.$this->font;
		$code = $this->generateCode($characters);
		/* font size will be 75% of the image height */
		$font_size = $height * 0.75;
		$image = @imagecreate($width, $height) or die('Cannot Initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, 255, 255, 255);
		$text_color = imagecolorallocate($image, 0, 0, 0);
		$noise_color = imagecolorallocate($image, 255, 150, 50);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->font, $code);
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code);
		/* output captcha image to browser */
		imagejpeg($image);
		imagedestroy($image);
    	//sessionSetExtraData(array('captcha_code' => $code));
		session_register('captcha_code');
		$_SESSION['captcha_code'] = $code;
	}

}

$width = isset($_GET['width']) ? $_GET['width'] : '90';
$height = isset($_GET['height']) ? $_GET['height'] : '30';
$characters = isset($_GET['characters']) ? $_GET['characters'] : '6';

header('Content-Type: image/jpeg');
$captcha = new CaptchaSecurityImages($width,$height,$characters);

?>