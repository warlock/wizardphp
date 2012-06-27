<?php
function wzdup () {
	if(defined('STDIN') ) {
		$end = "\n";
	} else {
		$end = "<br>";
	}
	include("zip.php");
	global $wizard_config;
	$wzdup_args = func_num_args();
	switch ($wzdup_args) {
		case "1":
			$wzdup_arg1 = func_get_arg(0);
		case "2":
			$wzdup_arg2 = func_get_arg(1);
	}
	if (isset($wzdup_arg1)) {
		if ($wzdup_arg1 == "make") {
			mkzip($wzdup_arg2);
		} else {
/*
			$conn_id = ftp_connect($wizard_config[ftp_serv]);
			$login_result = ftp_login($conn_id, $wizard_config[ftp_user], $wizard_config[ftp_pass]);

			if ((!$conn_id) || (!$login_result)) {
				print "FTP connection has failed!".$end;
				exit;
			} else {
				// FTP CONNECTED
				if(fopen($wizard_config[filesdb],"w")) {
					// get the file
					$local = fopen($wizard_config[filesdb],"w");
					$result = ftp_fget($conn_id, $local,"config/filesdb.yml", FTP_BINARY);
					// check upload status
					if (!$result) {
						print "Can't download File DB!".$end;
					} else {
*/
					print "Updated File DB".$end;
					// INSTALL CONTROLLER
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
	} else {
		print "Wizard Update System : Hi!";
	}
}
?>