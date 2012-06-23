<?
$filesdb = Spyc::YAMLLoad($wizard_config["filesdb"]);
if ($wzdup_args >= 1) {
	switch ($wzdup_arg1) {
		case "search":
			if ($wzdup_args == 2) {
				foreach ($filesdb as $numberfile => $data) {
					if (strstr($data[name], $wzdup_arg2) == true or strstr($data[comment], $wzdup_arg2) == true) {
						print "<b>".$data[name]."</b> : ".$data[comment]."<br>";
					}
				}
			} else {
				print "Need name for search";
			}
			break;
		case "install":
			if ($wzdup_args == 2) {
				foreach ($filesdb as $numberfile => $data) {
					if ($data[name] == $wzdup_arg2) {
						print "Instalando: <b>".$data[name]."</b> : ".$data[comment]."<br>";
						$local = fopen($wizard_config[cache].$data[name].".zip","w");
						$result = ftp_fget($conn_id, $local,$data[name].".zip", FTP_BINARY);

						if (!$result) {
							print "No he podido instalar el paquete!";
						} else {
							print "Paquete instalado!";
						}
					}
				}
			} else {
				print "Need name for install";
			}
			break;
	}
} else {
	foreach ($filesdb as $numberfile => $data) {
		print "<br>";
		print $data[name]." > ".$data[status];
	}
}
?>