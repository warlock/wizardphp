<?
/*
WizardPHP : Many DB Tool

Example:
$many_posts = many('posts','users','4');
foreach ($many_posts as $post) {
	print $post['title']."<br>";
}
*/
function many() {
	include("wizard/contr/init.php");
	if ($wizard_num_args == 3) {
		$table = $wizard_args[0];
		$column = $wizard_args[1];
		$value = $wizard_args[2];
		$query = "SELECT * FROM ".$table." where ".$column." = '".$value."'";
		$db = &ADONewConnection($wizard_config['class']);
		$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
		$result = $db->Execute($query);
		while ($array = $result->FetchRow()) {
			$return[] = $array;
		}
		$db->Close();
	}
	return $return;
}
?>