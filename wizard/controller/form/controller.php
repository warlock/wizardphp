<?
// WizardPHP : Form Controller

if(isset($wizard_model['_go_to'])) { // URL that goes after "submit"
	?><form method="post" action="<? print $wizard_model['_go_to']; ?>"><?
} else {
	?><form method="post" action="?"><?
}
if (func_num_args() > 1) {
	$id_update = $wizard_args['1']; // Load the "id" of the row you want to modify.
} else {
	$id_update = 0;
}
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
						if (is_array($class)) { 
							foreach ($class as $key2 => $class2) {
								switch ($key2) {
									case "select":
										$keys = $class2;
										$query = "select id,".$keys." from ".$class[model];
										$db = &ADONewConnection($wizard_config['class']);
										$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
										$result = $db->Execute($query);
										trans($wizard_model_name,$key);  ?>
										<SELECT NAME="<? print $key; ?>" SIZE="1">
											<?
											while (!$result->EOF) {
											?> 
											<OPTION VALUE="<?  print $result->fields[id]; ?>" <? 
											 if ($id_update > 0) {
												if ($result->fields[id] == $value[$key]) {
													print "SELECTED";
												} 
											 }
											 ?> > <?  print $result->fields[$keys]; ?></OPTION>
											<?
											$result->MoveNext();
											}
											$db->Close();
											?>
										</SELECT><br>
										<?
										break;
									case "count":
										$table = $class2;
										$query = "select count(*) from ".$table;
										print $query."<br>";
										break;
								}
								
							}
						} else {
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
	}
?></form><?
// Button to delete the row when editing.
if ($id_update>0) {
	?><form method="post" action="<? print $_go_destroy; ?>"><input type="hidden" name="action" value="destroy"><input type="hidden" name="form_id" value="<? print $wizard_model_name; ?>"><input type="hidden" name="id" value="<? if ($id_update > 0) { print $value['id']; } ?>"><input type="submit" value="<? trans($wizard_model_name,"_go_destroy"); ?>"></form></th>
<? } ?>
