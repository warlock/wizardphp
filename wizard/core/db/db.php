<?
// DEVELOPMENT MODE: AUTOCREATE TABLES
if ($wizard_config['mode'] == "development") {
	$db = &ADONewConnection($wizard_config['class']);
	$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
	// TABLE ALTER
	foreach ($wizard_model_complete as $table_name => $table_array ) {
		$query = "SELECT COUNT(*) AS count FROM information_schema.tables WHERE table_schema = '".$wizard_config['database']."' AND table_name = '".$table_name."'";
		$resultat = $db->Execute($query);
		$tabla_exists = $resultat->fields["count"];
		if ($tabla_exists == "1") {
			// TABLE EXISTS = ALTER TABLE
			foreach ($wizard_model_complete[$table_name] as $key => $value) {
				if(substr($key,0,1) != '_') {
					switch ($value) {
						case "string":
							$query_data = "ALTER TABLE ".$table_name." ADD ".$key." VARCHAR(255)";
							break;
						case "password":
							$query_data = "ALTER TABLE ".$table_name." ADD ".$key." VARCHAR(255)";
							break;
						case "text":
							$query_data = "ALTER TABLE ".$table_name." ADD ".$key." TEXT";
							break;
						case "wysiwyg":
							$query_data = "ALTER TABLE ".$table_name." ADD ".$key." TEXT";
							break;
						default:
							$query_data = "ALTER TABLE ".$table_name." ADD ".$key." VARCHAR(255)";
					}
					if ($table_name == "users") {
						if ($key == "password") {
							$query_data = "ALTER TABLE ".$table_name." ADD pass_crypt VARCHAR(255)";
						} elseif ($key == "mail") {
							$query_data = "ALTER TABLE ".$table_name." ADD mail_crypt VARCHAR(255)";
						}
					}
					$db->Execute($query_data);
				}
			}
			// TABLE EXISTS END
		} else { 
			// TABLE NO EXISTS
			$query_data ="";
			$query = "CREATE TABLE IF NOT EXISTS ".$table_name." ( id INT, ";
			foreach ($wizard_model_complete[$table_name] as $key => $value) {
				if(substr($key,0,1) != '_') {
					switch ($value) {
						case "string":
							$query_data = $query_data.$key." VARCHAR(255), ";
							break;
						case "password":
							$query_data = $query_data.$key." VARCHAR(255), ";
							break;
						case "text":
							$query_data = $query_data.$key." TEXT, ";
							break;
						case "wysiwyg":
							$query_data = $query_data.$key." TEXT, ";
							break;
						default:
							$query_data = $query_data.$key." VARCHAR(255), ";
					}
				}
			}
			$query_data = rtrim($query_data,', ');
			$query = $query.$query_data." );";
			// FOR EXECUTE CREATE TABLES
			$db->Execute($query);				
		} // TABLE NO EXISTS END
	}
	//END MODEL
	$db->Close();
}
?>
