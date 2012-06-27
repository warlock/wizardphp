<?php
function captcha() {
// This function is under construction!
	$characters = "0123456789abcdefghijklmnopqrstuvwxyz";
	$length = 5;
	for ($p = 0; $p < $length; $p++) {
		$codigo .= $characters[mt_rand(0, strlen($characters))];
	}
	//newcookie("captcha", $codigo, time() + 3600); 
	newcookie("captcha", $codigo); 
	$string = strtoupper($codigo);
	$captcha = imagecreatefrompng("captcha_background.png");
	$line = imagecolorallocate($captcha,288,288,288);
	$destring = str_split($string);
	for ($num=0;$num<=5;$num++) {
		$color = rand('0','138');
		$color2 = rand('0','138');
		$color3 = rand('0','138');
		$randomcolor = imagecolorallocate($captcha, $color, $color2, $color3);
		switch ($num) {
			case "1":
				$pos=34;
				break;
			case "2":
				$pos=64;
				break;
			case "3":
				$pos=94;
				break;
			case "4":
				$pos=124;
				break;
			default:
				$pos=4;
		}
		$randfont = rand('1','5');
		$fuente = "/home/broadcast/public_html/wizard/core/tools/captcha/fonts/".$randfont.".ttf"; 
	        if($destring[$num] != ''){
			imagettftext($captcha, 26, 0, $pos, 40, $randomcolor, $fuente, $destring[$num]);
		}
	}
	for ($lines=1;$lines<=6;$lines++) {
		$maxapm = 150;
		$min = 0;
		$randamp = rand($min,$maxapm);
		$randamp1 = rand($min,$maxapm);
		imageline($captcha,$randamp,0,$randamp1,60,$line);
	}

	$outfile="/home/broadcast/public_html/wizard/core/tools/captcha/captcha.png";
	//header('Content-type: image/png');
	imagepng($captcha,$outfile,0,PNG_NO_FILTER);
        imagedestroy($captcha);
	return "wizard/core/tools/captcha/captcha.png";
}
?>
