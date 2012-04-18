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
	$values = db($wizard_model_name, $post_id);
	$value = $values[0];
	foreach ($wizard_model as $key => $class) {
		if(substr($key,0,1) != '_') {
		//NO ES
			if (is_array($class)) {
				if ($value[$key] > 0 ) {
					$rela_1 = db($class['model'], $value[$key]);
					$rela_2 = $rela_1[0];
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
}