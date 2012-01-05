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
					print "<b>".trans('users','verified').":</b> ".$dbs->fields[mail]."<br>";
					$db->Execute($query_verify);
				} else {
					print "<b>".trans('users','user_noexist')."</b><br>";
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
					print trans('users','logged_with')." ".$userlogs->fields[mail];
					?> <b><a href="#" onclick="logoutform.submit()"><? trans('users','logout'); ?></a></b><br><?
				} else {
					// Have cookie but no logged
					?>
					<form method="post" action="<? print $go_to; ?>"> 
					<input type="hidden" name="action" value="login">
					<input type="hidden" name="form_id" value="users">
					<? trans("users","mail"); ?> <input type="text" name="mail" />   <br>
					<? trans("users","password"); ?> <input type="password" name="password" /> <br>
					<input type="submit" value="<? trans("users","login"); ?>" /> 
					</form> 
					<?
				}
			$db->Close();
		 } else {
			?>
			<form method="post" action="<? print $go_to; ?>"> 
			<input type="hidden" name="action" value="login">
			<input type="hidden" name="form_id" value="users">
			<? trans("users","mail"); ?><input type="text" name="mail" /> <br>  
			<? trans("users","password"); ?><input type="password" name="password" /> <br>
			<input type="submit" value="<? trans("users","login"); ?>" /> 
			</form> 
			<?
		}
	}
}
?>
