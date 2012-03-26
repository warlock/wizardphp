<?
function user() {
	if (isset($_COOKIE['sToken']) or $_COOKIE['sToken'] !== "") {
		global $wizard_config;
		$numargs = func_num_args();
	 	switch ($numargs) {
	 		case "1":
	 			// The first argument is to ask the current user data
				$arg = func_get_arg(0);
				$select_session = "select userid from sessions where cookie = '".$_COOKIE['sToken']."'";
				$db = &ADONewConnection($wizard_config['class']);
				$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
				$dbs = $db->Execute($select_session);
				if (!$dbs->EOF) {
					$userlog = "select ".$arg." from users where id = '".$dbs->fields[userid]."'";
					$userlogs = $db->Execute($userlog);
					$return = $userlogs->fields[$arg];
					return $return;
				} else {
					return FALSE;
				}
				$db->Close();
				break;
			default:
				// Returns the current user level. If the user is not logged returns FALSE.
				$select_session = "select userid from sessions where cookie = '".$_COOKIE['sToken']."'";
				$db = &ADONewConnection($wizard_config['class']);
				$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
				$dbs = $db->Execute($select_session);
				if (!$dbs->EOF) {
					$userlog = "select level from users where id = '".$dbs->fields[userid]."'";
					$userlogs = $db->Execute($userlog);
					$return = $userlogs->fields[level];
					//print $return;
					return $return;
				} else {
					return FALSE;
				}
				$db->Close();
		}
	}
}
?>
