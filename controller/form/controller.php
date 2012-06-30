<?
// WizardPHP : Form Controller

// Identify update post_id
switch ($wizard_num_args) {
	case 2:
		if ($wizard_args[1] == "new_url") {
			$wzd_from_seg = "new_url";
		} else {
			$post_id = $wizard_args[1];
		}
		break;
	case 3:
		$post_id = $wizard_args[1];
		$wzd_from_seg = $wizard_args[2];
		break;
	default:
		global $post_id;
}

if (isset($post_id)) {
	$id_update = $post_id;
} else {
	$id_update = 0;
}

// URL that goes after "submit"
if(isset($wizard_model['_go_to'])) { 
	mkform("_open", $wizard_model["_go_to"]);
} else {
	if ($wzd_from_seg == "edit_url") {
		mkform("_open","../edit");
	} elseif ($wzd_from_seg == "new_url") {
		mkform("_open","edit");
	} else {
		mkform("_open");
	}
}


if ($id_update > 0) {  // Show value in form
	$values = db($wizard_model_name,$id_update);
	$value = $values[0];
	mkform("_hidden","action","update");
	mkform("_hidden","id",$id_update);
} else {
	if (isset($wizard_model["_controller"])) {
		if ($wizard_model["_controller"] != "") { // Identify when post isn't CRUD
			mkform("_hidden","action","controller");
			mkform("_hidden","postcontroller",$wizard_model['_controller']);
		} else { // Post is CRUD
			mkform("_hidden","action","create");
		}
	} else {
		mkform("_hidden","action","create");
	}
}
mkform("_hidden","form_id",$wizard_model_name);

// Check the model and prints the results.
foreach ($wizard_model as $key => $class) {
	switch ($key) {
		case "_go_to":
			break;
		case "_controller":
			break;
		case "_button":
			if (is_array($class)) {
				foreach ($class as $key2 => $class2) {
					mkform("_button",$class2,$wizard_model_name,$class2);
				}
			} else {
				mkform("_button","submit",$wizard_model_name,$class);
			}
			break;
		case "level":
			// Under construction. Displays the "level" when a user has permissions.
			break;
		default:
			if (!isset($value)) {
				mkform($wizard_model_name,$class,$key);
			} else {
				mkform($wizard_model_name,$class,$key,$value,$id_update);
			}
	}
}
mkform();

// Button to delete the row when editing.
if ($id_update>0) {
	if(isset($wizard_model['_go_destroy'])) {
		mkform("_open", $wizard_model["_go_destroy"]);
	} else {
		print "No hi ha _go_destroy";
		if ($wzd_from_seg == "edit_url") {
			mkform("_open","../edit");
		} elseif ($wzd_from_seg == "new_url") {
			mkform("_open","edit");
		} else {
			mkform("_open");
		}
	}
	mkform("_hidden","action","destroy");
	mkform("_hidden","form_id",$wizard_model_name);
	mkform("_hidden","id",$value['id']);
	mkform("_button","submit",$wizard_model_name,"_go_destroy");
	mkform();
	?></th>
	<? 
}
?>
