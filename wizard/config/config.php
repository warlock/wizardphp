<?
// Configuration and models loader.
$wizard_config = Spyc::YAMLLoad('config.yml');

$language = $wizard_config['language'];
$wizard_debug = $wizard_config['debug'];
// Send cookie.
if(!isset($_COOKIE["sToken"]) or $_COOKIE[sToken] == "") {
	$tokengen = mkpasswd().time();
	$tokenvalue = sha1($tokengen);
	$tokentime = time() + (7 * 86400);
	setcookie("sToken",$tokenvalue,$tokentime);
}

?>
