<?
// WizardPHP : Form Controller

if(isset($wizard_model['_go_to'])) { // URL that goes after "submit"
	?><form method="post" action="<? print $wizard_model['_go_to']; ?>"><?
} else {
	global $wzd_from_seg;
	if ($wzd_from_seg == "edit_url") {
		?><form method="post" action="../edit"><?
	} elseif ($wzd_from_seg == "new_url") {
		?><form method="post" action="edit"><?
	} else {
		?><form method="post" action=""><?
	}
}

// Identify update post_id
if ($wizard_num_args == 2) {
	$post_id = $wizard_args[1];
	} else {
	global $post_id;
}
if (isset($post_id)) {
	$id_update = $post_id;
} else {
	$id_update = 0;
} 

if ($id_update > 0) {  // Show value in form
	$values = db($wizard_model_name,$id_update);
	$value = $values[0];
	?><input type="hidden" name="action" value="update"><?
	?><input type="hidden" name="id" value="<? print $id_update; ?>"><?
} else {
	if ($wizard_model['_controller'] != "") { // Identify when post isn't CRUD
		?><input type="hidden" name="action" value="controller"><?
		?><input type="hidden" name="postcontroller" value="<? print $wizard_model['_controller']; ?>"><?
	} else { // Post is CRUD
		?><input type="hidden" name="action" value="create"><?
	}
}
?><input type="hidden" name="form_id" value="<? print $wizard_model_name; ?>"><?
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
								?><input type="<? print $class2; ?>" value="<? t($wizard_model_name,$class2); ?>"><? 
						}
					} else {
						?><input type="<? print $class; ?>" value="<? t($wizard_model_name,$class); ?>"><?
					}
				break;
			case "level":
				// Under construction. Displays the "level" when a user has permissions.
				break;
			default:
				switch ($class) {
					case "string":
						t($wizard_model_name,$key); ?> <input type="text" name="<? print $key; ?>" value="<? if ($id_update > 0) { print $value[$key]; } ?>"><br><?
						break;
					case "password":
						t($wizard_model_name,$key); ?> <input type="password" name="<? print $key; ?>"><br><?
						break;
					case "checkbox":
						// Under construction
						break;
					case "text":
						t($wizard_model_name,$key); ?> <textarea name="<? print $key; ?>" rows="3" cols="20"><? if ($id_update > 0) { print $value[$key]; } ?></textarea><br><?
						break;
					case "wysiwyg":
						t($wizard_model_name,$key);
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
						/* t($wizard_model_name,$key); ?> <img src="<? print captcha(); ?>" name="<? print $key; ?>"><br><? */
						break;
					case "date":
						t($wizard_model_name,$key); ?> <select name="day-<? print $key; ?>">
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
										$results = db($class[model]);
										t($wizard_model_name,$key);
										?> <SELECT NAME="<? print $key; ?>" SIZE="1"><?
											foreach ($results as $result) {
											?><OPTION VALUE="<?  print $result['id']; ?>" <? 
											 if ($id_update > 0) {
												if ($result['id'] == $value[$key]) {
													print "SELECTED";
												}
											 }
											 ?> > <?  print $result[$class2]; ?></OPTION><?
											}
											?>
										</SELECT><br>
										<?
										break;
									case "count":
									/*
										$table = $class2;
										$query = "select count(*) from ".$table;
										print $query."<br>";
										break;
										*/
								}
							}
						} else {
							// It ensures that there is some direction after removing the row.
							if ($key == "_go_destroy") {
                        		$_go_destroy = $class;
                            	$destroylock = 1;
                            }
                		}
				}
		}
	}
?></form><?
// Button to delete the row when editing.

if ($id_update>0) {
	if ($destroylock != 1) {
		//global $wzd_from_seg;
		if ($wzd_from_seg == "edit_url") {
			$_go_destroy = "../edit";
		} else {
			$_go_destroy = "";
		}
	}
	?><form method="post" action="<? print $_go_destroy; ?>"><input type="hidden" name="action" value="destroy"><input type="hidden" name="form_id" value="<? print $wizard_model_name; ?>"><input type="hidden" name="id" value="<? if ($id_update > 0) { print $value['id']; } ?>"><input type="submit" value="<? t($wizard_model_name,"_go_destroy"); ?>"></form></th>
<? } ?>
