<?
// WizardPHP : Show Item Controller

// Identify form controller
if ($wizard_num_args == 2) {
	$post_id = $wizard_args[1];
} else {
	global $post_id;
}

// Identify update post_id
if (isset($post_id)) {
	$id_update = $post_id;
	$db = &ADONewConnection($wizard_config['class']);
	$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
	$result = $db->Execute("select * from ".$wizard_model_name." where id = ".$id_update);
	$value = $result->FetchRow(0);
	foreach ($wizard_model as $key => $class) {
		if($key != "_button" and $key != "_go_to") {
		//NO ES
			if (is_array($class)) {
				if ($value[$key] > 0 ) {
					$query_rela = "SELECT ".$class['select']." FROM ".$class['model']." where id = ".$value[$key];
					$rela = $db->Execute($query_rela);
					$rela_2 = $rela->FetchRow(0);
					$ty_mod2 = $class['select'];
					?><b><? t($wizard_model_name,$key); ?>:</b> <?= $rela_2[$ty_mod2]?><br><?
				} else {
					?><b><? t($wizard_model_name,$key); ?>:</b><br><?				
				}
			} else {
				?><b><? t($wizard_model_name,$key); ?>:</b> <?= $value[$key] ?><br><?
			}

		}
	}
		$db->Close();
}
