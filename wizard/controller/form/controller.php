<?
// WizardPHP : Form Controller

if(isset($wizard_model[_go_to])) { // URL that goes after "submit"
	?><form method="post" action="<? print $wizard_model[_go_to]; ?>"><?
} else {
	$url = $_SERVER['SERVER_NAME']; 
	$page = $_SERVER['PHP_SELF']; 
	?><form method="post" action="<? print "http://".$url.$page; ?>"><?
}

$id_update = $wizard_args[1]; // Load the "id" of the row you want to modify.
if ($id_update > 0) {
	$db = &ADONewConnection($wizard_config['class']);
	$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
	$result = $db->Execute("select * from ".$wizard_model_name." where id = ".$id_update);
	$value = $result->FetchRow(0);
	$db->Close();
	?><input type="hidden" name="action" value="update"><?
	?><input type="hidden" name="id" value="<? print $id_update; ?>"><?
} else {
	?><input type="hidden" name="action" value="create"><?
}
?><input type="hidden" name="form_id" value="<? print $wizard_model_name; ?>"><?
// Check the model and prints the results.
	foreach ($wizard_model as $key => $class) {
		switch ($key) {
			case "_go_to":
				break;
			case "_button":
					if (is_array($class)) {
						foreach ($class as $key2 => $class2) {
								?><input type="<? print $class2; ?>" value="<? trans($wizard_model_name,$class2); ?>"><? 
						}
					} else {
						?><input type="<? print $class; ?>" value="<? trans($wizard_model_name,$class); ?>"><?
					}
				break;
			case "level":
				// Under construction. Displays the "level" when a user has permissions.
				break;
			default:
				switch ($class) {
					case "string":
						trans($wizard_model_name,$key); ?> <input type="text" name="<? print $key; ?>" value="<? if ($id_update > 0) { print $value[$key]; } ?>"><br><?
						break;
					case "password":
						trans($wizard_model_name,$key); ?> <input type="password" name="<? print $key; ?>"><br><?
						break;
					case "checkbox":
						// Under construction
						break;
					case "text":
						trans($wizard_model_name,$key); ?> <textarea name="<? print $key; ?>" rows="3" cols="20"><? if ($id_update > 0) { print $value[$key]; } ?></textarea><br><?
						break;
					case "wysiwyg":
						trans($wizard_model_name,$key);
						?><br><?
						$CKEditor = new CKEditor();
						$CKEditor->basePath = 'wizard/core/tools/ckeditor/';
						$CKEditor->editor($key, $value[$key]);
						break;
					case "radio":
						// Under construction
						break;
					case "_captcha":
						// Under construcction
						/* trans($wizard_model_name,$key); ?> <img src="<? print captcha(); ?>" name="<? print $key; ?>"><br><? */
						break;
					case "date":
						trans($wizard_model_name,$key); ?> <select name="day-<? print $key; ?>">
						<? for($x=1;$x<=31;$x++) { print "<option>".$x; } ?>
						</select>
						<select name="month-<? print $key; ?>">
						<? for($x=1;$x<=12;$x++) { print "<option>".$x; } ?>
						</select>
						<input type="text" name="year-<? print $key; ?>" maxlength="4" size="4">
						<br><?
						break;
					default:
						// It ensures that there is some direction after removing the row.
						if ($key == "_go_destroy") {
                        	$_go_destroy = $class;
                            $destroylock = 1;
                        } else {
                        	if ($destroylock == 0) {
                            	$_go_destroy = "?";
                            }
                		}
				}
		}
	}
?></form><?
// Button to delete the row when editing.
if ($id_update>0) {
	?><form method="post" action="<? print $_go_destroy; ?>"><input type="hidden" name="action" value="destroy"><input type="hidden" name="form_id" value="<? print $wizard_model_name; ?>"><input type="hidden" name="id" value="<? if ($id_update > 0) { print $value['id']; } ?>"><input type="submit" value="<? trans($wizard_model_name,"_go_destroy"); ?>"></form></th>
<? } ?>
