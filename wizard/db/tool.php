<?php
/*
WizardPHP : Select DB Tool

table
table id
table key value
delete table id
delete table key value

*/
function db() {
	include("wizard/contr/init.php");
	if ($wizard_num_args > 0) { 
		$db = &ADONewConnection($wizard_config['class']);
		$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
		switch ($wizard_num_args) {
			case "1": // table
				global $wzd_model_names;
				if (in_array($wizard_args[0], $wzd_model_names)) { // Arg is a model
					$table = $wizard_args[0];
					$query = "SELECT * FROM ".$table;
					$result = $db->Execute($query);
					while ($array = $result->FetchRow()) {
						$return[] = $array;
					}
				} else { // Normal SQL Query
					$query = $wizard_args[0];
					$q_exp = explode(" ",$query);
					$first = strtolower($q_exp[0]);
					if ($first == "select") { // SQL QUERY WITH SELECT
						$result = $db->Execute($query);
						while ($array = $result->FetchRow()) {
							$return[] = $array;
						}
					} else { // RANDOM SQL QUERY
						$db->Execute($query);
						$return = TRUE;
					}
				}

				break;
			case "2": //table id
				$table = $wizard_args[0];
				$id = $wizard_args[1];
				$query = "SELECT * FROM ".$table." WHERE id = '".$id."' LIMIT 1";
				$result = $db->Execute($query);
				while ($array = $result->FetchRow()) {
					$return[] = $array;
				}
				break;
			case "3":
				if ($wizard_args[0] != 'delete') { //  table key value
					$table = $wizard_args[0];
					$key = $wizard_args[1];
					$value = $wizard_args[2];
					$query = "SELECT * FROM ".$table." WHERE ".$key." = '".$value."'";
					$result = $db->Execute($query);
					while ($array = $result->FetchRow()) {
						$return[] = $array;
					}
				} else { //delete table id
					$table = $wizard_args[1];
					$id = $wizard_args[2];
					$query = "DELETE FROM ".$table." WHERE id = '".$id."'";
					$db->Execute($query);
					$return = TRUE;
				}
				break;
			case "4":
				if ($wizard_args[0] == 'many') { //  many table1 table2 id
					$table = $wizard_args[1];
					$column = $wizard_args[2];
					$value = $wizard_args[3];
					$query = "SELECT * FROM ".$table." where ".$column." = '".$value."'";
					$result = $db->Execute($query);
					while ($array = $result->FetchRow()) {
						$return[] = $array;
					}
				} elseif ($wizard_args[0] == 'delete') { //delete table key value
					$table = $wizard_args[1];
					$key = $wizard_args[2];
					$value = $wizard_args[3];
					$query = "DELETE FROM ".$table." WHERE ".$key." = '".$value."'";
					$db->Execute($query);
					$return = TRUE;
				}
				break;
			default:
				wizard_error('BAD Parameters');	
		}
		//RESULTS
		if(isset($return)) {
			return $return;
		} else {
				wizard_error('FALSE -> '. $query);
				return FALSE;
		}
		$db->Close();
	} else {
		return FALSE;
	}
}
?>