<?
if(!isset($_COOKIE["sTlang"]) or $_COOKIE["sTlang"] == "") {
	if (isset($wzd_lang)) {
		$tokengen = mkpasswd().time();
		$tokentime = time() + (7 * 86400);
		setcookie("sTlang", $wzd_lang, $tokentime);
		$language = $wzd_lang;
	} else {
		$language = $wizard_config['language'];
	}
} else {
	if (isset($wzd_lang)) {
		$tokengen = mkpasswd().time();
		$tokentime = time() + (7 * 86400);
		setcookie("sTlang", $wzd_lang, $tokentime);
		$language = $wzd_lang;
	} else {
		$language = $_COOKIE["sTlang"];
	}
}
?>