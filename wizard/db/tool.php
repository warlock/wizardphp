<?
/*
WizardPHP : Select DB Tool

table
table id
table key value
delete table id
delete table key value
many table1 table2 id
update table key value key value key value...
insert table keys(explode) value value value

*/
function db() {
	include("wizard/contr/init.php");
	if ($wizard_num_args > 0) { 
		$db = &ADONewConnection($wizard_config['class']);
		$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
		switch ($wizard_num_args) {
			case "1": // table
				$table = $wizard_args[0];
				$query = "SELECT * FROM ".$table;
				$result = $db->Execute($query);
				while ($array = $result->FetchRow()) {
					$return[] = $array;
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
				$query = "Esto es un insert, update o select complejo";		
		}
		//RESOLUCIONES
		if(isset($return)) {
			return $return;
		} else {
			print $query;
		}
		$db->Close();
	} else {
		return FALSE;
	}
}
?>