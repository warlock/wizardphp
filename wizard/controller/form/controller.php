<?
// WizardPHP : Form Controller
$goto = $wizard_model[_go_to]; // URL that goes after "submit"
if(isset($goto)) {
	?><form method="post" action="<? print $goto; ?>"><?
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
	$valor = $result->FetchRow(0);
	$db->Close();
	?><input type="hidden" name="action" value="update"><?
	?><input type="hidden" name="id" value="<? print $id_update; ?>"><?
} else {
	?><input type="hidden" name="action" value="create"><?
}
?><input type="hidden" name="form_id" value="<? print $wizard_model_name; ?>"><?
// Check the model and prints the results.
	foreach ($wizard_model as $sub => $val) {
		switch ($sub) {
			case "_go_to":
				break;
			case "_button":
					if (is_array($val)) {
						foreach ($val as $sub2 => $val2) {
								?><input type="<? print $val2; ?>" value="<? trans($wizard_model_name,$val2); ?>"><? 
						}
					} else {
						?><input type="<? print $val; ?>" value="<? trans($wizard_model_name,$val); ?>"><?
					}
				break;
			case "level":
				// Under construction. Displays the "level" when a user has permissions.
				break;
			default:
				switch ($val) {
					case "string":
						trans($wizard_model_name,$sub); ?> <input type="text" name="<? print $sub; ?>" value="<? print $valor[$sub]; ?>"><br><?
						break;
					case "password":
						trans($wizard_model_name,$sub); ?> <input type="password" name="<? print $sub; ?>"><? print $valor[$sub] ?><br><?
						break;
					case "checkbox":
						trans($wizard_model_name,$sub); ?> <input type="checkbox" name="<? print $sub; ?>"><? print $sub; ?><br><?
						break;
					case "text":
						trans($wizard_model_name,$sub); ?> <textarea name="<? print $sub; ?>" rows="3" cols="20"><? print $valor[$sub] ?></textarea><br><?
						break;
					case "wysiwyg":
						trans($wizard_model_name,$sub);
						?><br><?
						$CKEditor = new CKEditor();
						$CKEditor->basePath = 'wizard/core/tools/ckeditor/';
						$CKEditor->editor($sub, $valor[$sub]);
						break;
					case "radio":
						// Under construction
						trans($wizard_model_name,$sub); ?> <input type="radio" name="formradio" value="<? print $sub; ?>"><? print $sub; ?><br><? 
						break;
					case "_captcha":
						// Under construcction
						/* trans($wizard_model_name,$sub); ?> <img src="<? print captcha(); ?>" name="<? print $sub; ?>"><br><? */
						break;
					case "date":
						trans($wizard_model_name,$sub); ?> <select name="day-<? print $sub; ?>">
						<? for($x=1;$x<=31;$x++) { print "<option>".$x; } ?>
						</select>
						<select name="month-<? print $sub; ?>">
						<? for($x=1;$x<=12;$x++) { print "<option>".$x; } ?>
						</select>
						<input type="text" name="year-<? print $sub; ?>" maxlength="4" size="4">
						<br><?
						break;
					default:
						// It ensures that there is some direction after removing the row.
						if ($sub == "_go_destroy") {
                        	$_go_destroy = $val;
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
	?><form method="post" action="<? print $_go_destroy; ?>"><input type="hidden" name="action" value="destroy"><input type="hidden" name="form_id" value="<? print $wizard_model_name; ?>"><input type="hidden" name="id" value="<?print $valor["id"]; ?>"><input type="submit" value="<? trans($wizard_model_name,"_go_destroy"); ?>"></form></th>
<? } ?>
