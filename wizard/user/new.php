<?php
	if (isset($_GET["verify"])) {
		$newquery = db("SELECT id,mail FROM users WHERE pass_crypt = '".$_GET[verify]."' AND activ = '0'");
		if (is_array($newquery)) {
			db("UPDATE users SET activ = '1', expiration = '0'  WHERE id = '".$newquery[0]["id"]."'");
			print "<b>".t("users","verified").":</b> ".$newquery[0]["mail"]."<br>";
		} else {
			print "<b>".t("users","user_noexist")."</b><br>";
		}
	} else {
		global $form_id, $action;
		if ($form_id == "users" and $action == "create") { 
			t("users","verify");
		} else {
			form("users");
		}
	}
?>