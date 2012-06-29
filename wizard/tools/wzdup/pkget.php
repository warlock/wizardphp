<?php
$filesdb = Spyc::YAMLLoad($wizard_config["filesdb"]);
if ($wzdup_args >= 1) {
	switch ($wzdup_arg1) {
		case "search":
			if ($wzdup_args == 2) {
				foreach ($filesdb as $numberfile => $data) {
					if (strstr($data[name], $wzdup_arg2) == true or strstr($data[comment], $wzdup_arg2) == true) {
						print "<b>".$data[name]."</b> : ".$data[comment].$end;
					}
				}
			} else {
				print "Need name for search".$end;
			}
			break;
		case "install":
			if ($wzdup_args == 2) {
				foreach ($filesdb as $numberfile => $data) {
					if ($data[name] == $wzdup_arg2) {
						print "Instalando: <b>".$data[name]."</b> : ".$data[comment].$end;
						$local = fopen($wizard_config[cache].$data[name].".zip","w");
						$result = ftp_fget($conn_id, $local,$data[name].".zip", FTP_BINARY);

						if (!$result) {
							print "No he podido instalar el paquete!".$end;
						} else {
							unzip($data[name]);
							print "Paquete instalado!".$end;
						}
					}
				}
			} else {
				print "Need name for install".$end;
			}
			break;
	}
} else {
	foreach ($filesdb as $numberfile => $data) {
		print $data[name]." > ".$data[status].$end;
	}
}
?>