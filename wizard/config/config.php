<?php
// Configuration and models loader.
$wizard_config = Spyc::YAMLLoad('config/config.yml');
$language = $wizard_config['language'];
$wizard_debug = $wizard_config['debug'];
if ($wizard_debug == 1 ) {
	error_reporting(E_ALL);
}
// Send cookie.
if(!isset($_COOKIE["sToken"]) or $_COOKIE["sToken"] == "") {
	$tokengen = mkpasswd().time();
	$tokenvalue = sha1($tokengen);
	$tokentime = time() + (7 * 86400);
	setcookie("sToken",$tokenvalue,$tokentime);
}
$wzd_url_mod = 0; // URL Modification
?>
