<?php
function wzdup () {
	global $wizard_config;
/*
	$conn_id = ftp_connect($wizard_config[ftp_serv]);
	$login_result = ftp_login($conn_id, $wizard_config[ftp_user], $wizard_config[ftp_pass]);

	if ((!$conn_id) || (!$login_result)) {
		print "FTP connection has failed!<br>";
		exit;
	} else {
		// FTP CONNECTED
		if(fopen($wizard_config[filesdb],"w")) {
		// get the file
		$local = fopen($wizard_config[filesdb],"w");
		$result = ftp_fget($conn_id, $local,"config/filesdb.yml", FTP_BINARY);

		// check upload status
		if (!$result) {
			print "Can't download File DB!";
		} else {
*/
			print "Updated File DB<br>";
			// INSTALL CONTROLLER
			$wzdup_args = func_num_args();
			$wzdup_arg1 = func_get_arg(0);
			$wzdup_arg2 = func_get_arg(1);
			include("pkget.php");
/*
		}
	} else {
		print "Please change filesdb.yml permisions";
	}
	// close the FTP stream
	ftp_close($conn_id);
	}
*/
}
?>