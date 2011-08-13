<?
// Configuration and models loader.
$wizard_config = Spyc::YAMLLoad('wizard/config.yml');
$wizard_model_complete = Spyc::YAMLLoad('wizard/model.yml');
$language = $wizard_config['language'];
// Send cookie.
if(!isset($_COOKIE["sToken"]) or $_COOKIE[sToken] == "") {
	$tokengen = mkpasswd().time();
	$tokenvalue = sha1($tokengen);
	$tokentime = time() + (7 * 86400);
	setcookie("sToken",$tokenvalue,$tokentime);
}
?>
