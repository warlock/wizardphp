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
	f("_open", $wizard_model["_go_to"]);
} else {
	if (isset($wzd_from_seg)) {
		if ($wzd_from_seg == "edit_url") {
			f("_open","../edit");
		} elseif ($wzd_from_seg == "new_url") {
			f("_open","edit");
		} else {
			f("_open");
		}
	} else {
		f("_open");
	}
}


if ($id_update > 0) {  // Show value in form
	$values = db($wizard_model_name,$id_update);
	$value = $values[0];
	f("_hidden","action","update");
	f("_hidden","id",$id_update);
} else {
	if (isset($wizard_model["_controller"])) {
		if ($wizard_model["_controller"] != "") { // Identify when post isn't CRUD
			f("_hidden","action","controller");
			f("_hidden","postcontroller",$wizard_model['_controller']);
		} else { // Post is CRUD
			f("_hidden","action","create");
		}
	} else {
		f("_hidden","action","create");
	}
}
f("_hidden","form_id",$wizard_model_name);

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
					f("_button",$class2,$wizard_model_name,$class2);
				}
			} else {
				f("_button","submit",$wizard_model_name,$class);
			}
			break;
		case "level":
			// Under construction. Displays the "level" when a user has permissions.
			break;
		default:
			if (!isset($value)) {
				f($wizard_model_name,$class,$key);
			} else {
				f($wizard_model_name,$class,$key,$value,$id_update);
			}
	}
}
f();

// Button to delete the row when editing.
if ($id_update>0) {
	if(isset($wizard_model['_go_destroy'])) {
		f("_open", $wizard_model["_go_destroy"]);
	} else {
		print "No hi ha _go_destroy";
		if ($wzd_from_seg == "edit_url") {
			f("_open","../edit");
		} elseif ($wzd_from_seg == "new_url") {
			f("_open","edit");
		} else {
			f("_open");
		}
	}
	f("_hidden","action","destroy");
	f("_hidden","form_id",$wizard_model_name);
	f("_hidden","id",$value['id']);
	f("_button","submit",$wizard_model_name,"_go_destroy");
	f();
	?></th>
	<? 
}
?>
