<?
function users_form() {
	global $wizard_config;
	$go_to = "?";
	$num_args = func_num_args();
	if ($num_args == "1")  {
		$class = func_get_arg(0);
		if ($class == "new") {
			if (isset($_GET[verify])) {
				//
				$select_login = "select id, mail from users where pass_crypt = '".$_GET[verify]."' and activ = '0'";
				$db = &ADONewConnection($wizard_config['class']);
				$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
				$dbs = $db->Execute($select_login);
				if (!$dbs->EOF) {
					$query_verify = "update users set activ = '1', expiration = '0'  where id = '".$dbs->fields[id]."'";
					print "<b>User</b> ".$dbs->fields[mail]." <b>verified!</b><br>";
					$db->Execute($query_verify);
				} else {
					print "<b>User does not exist!</b><br>";
				}
				$db->Close();
				//
			} else {		
				form('users');
			}
		}
	} else { 
		//Login manager
		if (isset($_COOKIE["sToken"])) {
			$select_session = "select userid from sessions where cookie = '".$_COOKIE['sToken']."'";
			$db = &ADONewConnection($wizard_config['class']);
			$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
			$dbs = $db->Execute($select_session);
				if (!$dbs->EOF) {
					$userlog = "select mail from users where id = '".$dbs->fields[userid]."'";
					$userlogs = $db->Execute($userlog);
					?>
					<form action="<? print $go_to; ?>" id="logoutform" method="post">
					<input type="hidden" name="action" value="logout" />
					<input type="hidden" name="form_id" value="users">
					</form>
					<?
					print "Logged with: ".$userlogs->fields[mail];
					?> | <a href="#" onclick="logoutform.submit()">Logout</a><br><?
				} else {
					// Have cookie but no logged
					?>
					<form method="post" action="<? print $go_to; ?>"> 
					<input type="hidden" name="action" value="login">
					<input type="hidden" name="form_id" value="users">
					<? trans("users","mail"); ?> <input type="text" name="mail" />   
					<? trans("users","password"); ?> <input type="text" name="password" /> 
					<input type="submit" name="<? trans("users","login"); ?>" /> 
					</form> 
					<?
				}
			$db->Close();
		 } else {
			?>
			<form method="post" action="<? print $go_to; ?>"> 
			<input type="hidden" name="action" value="login">
			<input type="hidden" name="form_id" value="users">
			<? trans("users","mail"); ?><input type="text" name="mail" />   
			<? trans("users","password"); ?><input type="text" name="password" /> 
			<input type="submit" name="<? trans("users","login"); ?>" /> 
			</form> 
			<?
		}
	}
}
?>
