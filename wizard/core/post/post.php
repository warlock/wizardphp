<?
// wizard: POST SYSTEM CATCHER
$post_send_values = "";
$input_name = "";
$input_value = "";
$postsend = "";
$post_values = "";
$postalt = "";
$post_alter = "";
$post_model = "";
$post_id = "";
$show_id = 0;
if (count($_POST) > 1) {
	foreach ( $_POST as $input_name => $input_value) {
		// Identify what action is to run
		switch ($input_name) {
			case "action":
				switch ($input_value) { 
					case "create" :
						$action = "create"; 
						$postalt = "insert into ";
						break;
					case "read":
						$show_id = 1;
						break;
					case "update":
						$action = "update";
						$postalt = "update ";
						break;
					case "destroy":
						$action = "destroy";
						$postalt = "delete from ";
						break;
					case "login":
						$action = "login";
						break;
					case "logout":
						$select_login = "delete from sessions where cookie = '".$_COOKIE["sToken"]."'";
						$db = &ADONewConnection($wizard_config['class']);
						$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
						$dbs = $db->Execute($select_login);
						$db->Close();
						break;
				}
				break;
			case "form_id":
				if(isset($postalt)) {
					$postsend=$postalt.$input_value;
				}
				$form_id = $input_value;
				break;
			case "id":
				if ($show_id == 1) {
					$post_id = $input_value;
				} else {
					$post_alter = $input_value;
				}
				break;
			case "password":
				if ($form_id == "users" && $input_name == "password") {
					$passcrypt = sha1($input_value);
				}
			case "mail":
				if ($form_id == "users" && $input_name == "mail") {
					$mail_ver = $input_value;
					$mailcrypt = sha1($input_value);
				}
			default:
				if ($postalt == "insert into ") {
					$post_keys = $post_keys.$input_name.",";
					$post_values = $post_values."'".$input_value."',";
				} else {
					$post_values = $post_values.$input_name." = '".$input_value."',";
				}
				break;
		}
	}
	// Executes actions in the database.	
	switch ($action) {
		case "login":
			if (isset($_COOKIE["sToken"])) {
				$select_login = "select * from users where pass_crypt = '".$passcrypt."' and mail_crypt = '".$mailcrypt."'";
				$db = &ADONewConnection($wizard_config['class']);
				$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
				$dbs = $db->Execute($select_login);
				if (!$dbs->EOF) {
					$activ = $dbs->fields[activ];
					if ($activ == '1') {
					$newsess = "insert into sessions (userid, cookie, time) values ('".$dbs->fields[id]."', '".$_COOKIE[sToken]."', '".time()."')";
					$db->Execute($newsess);
					} else {
						print "<b>Please verify your mail!</b><br>";	
					}
				} else {
					print "<b>User or password incorrect!</b><br>";
				}
				$db->Close();
			}
			break;
		case "create":
			if ($form_id == "users") {
				$default_level = $wizard_model_complete[users][level];
				$expiration = time() + 604800;
				$postsend = $postsend." (".$post_keys." pass_crypt, mail_crypt, level, activ, expiration) values (".$post_values." '".$passcrypt."', '".$mailcrypt."', '".$default_level."', '0', '".$expiration."')";
				// Mail verification
				$url_mail = $_SERVER['HTTP_REFERER'];
				$t_url = rtrim($url_mail, "?");
				$message = $wizard_config['message']."\n".$t_url."?verify=".$passcrypt;
				$mailheaders = 'From: '.$wizard_config['from']. "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				mail($mail_ver, $wizard_config['title'], $message, $mailheaders);
			} else {
				$post_keys = rtrim($post_keys,',');
				$post_values = rtrim($post_values,',');
				$postsend = $postsend." (".$post_keys.") values (".$post_values.")";
			}
			$db = &ADONewConnection($wizard_config['class']);
			$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
			$db->Execute($postsend);
			$db->Close();
			break;
		case "update":
            $post_values = rtrim($post_values,',');
    		$postsend = $postsend." set ".$post_values." where id = '".$post_alter."'";
			$db = &ADONewConnection($wizard_config['class']);
			$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
       	    $db->Execute($postsend);
			$db->Close();
			break;
		case "destroy":
            $postsend = $postsend." where id = '".$post_alter."'";
			$db = &ADONewConnection($wizard_config['class']);
			$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
			$db->Execute($postsend);
			$db->Close();
			break;
	}
}
?>
