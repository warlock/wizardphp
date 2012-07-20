<?php
// WizardPHP : User manager
function user() {
	global $wizard_config;
	if (isset($_COOKIE["sToken"])) {
		$sesq = db("SELECT userid FROM sessions WHERE cookie = '".$_COOKIE['sToken']."'");
		if (is_array($sesq)) {
			$userq = db("SELECT * FROM users WHERE id = '".$sesq[0]["userid"]."' AND activ = '1'");
			$user = $userq[0];
			$level = $user["level"];
		} else {
			$level = 0;
		}
	} else {
		$level = 0;
	}
	$numargs = func_num_args();
	if ($numargs >= 1) {
		$arg = func_get_arg(0);
		switch ($arg) {
			case "new":
				if ($level) {
					include("logged.php");
				} else {
					include("new.php");
				}
				break;
			case "login":
				//Login manager per default
				if ($level) {
						include("logged.php");
					} else {
						global $authret;
						switch ($authret) {
							case 1:
								t("users","incorrect");
								break;
							case 2:
								t("users","verify");
								break;
						}
						f("_open","","login");
						f("_hidden","action","login");
						f("_hidden","form_id","users");
						f("users","string","mail");
						f("users","password","password");
						f("_button","submit","users","login");
						f();
				}
				break;
			case "set":
				// Cambiar coses del usuari
				break;
			case "print":
				$arg2 = func_get_arg(1);
				if(isset($arg2) and isset($user)) {
					print $user[$arg2];
				}
			default:
				// Consultes
				if(isset($arg) and isset($user)) {
					return $user[$arg];
				}
		}
	} else {
		// Return actual user level if is logged
		return $level;
	}
}
?>
