<?
switch ($class) {
	case "string":
		t($wizard_model_name,$key); ?> <input type="text" name="<? print $key; ?>" value="<? if ($id_update > 0) { print $value[$key]; } ?>"><br>
		<?
		break;
	case "password":
		t($wizard_model_name,$key); ?> <input type="password" name="<? print $key; ?>"><br>
		<?
		break;
	case "checkbox":
		break;
	case "text":
		t($wizard_model_name,$key); ?> <textarea name="<? print $key; ?>" rows="3" cols="20"><? if ($id_update > 0) { print $value[$key]; } ?></textarea><br>
		<?	
		break;
	case "wysiwyg":
		t($wizard_model_name,$key);
		?><br><?
		$CKEditor = new CKEditor();
		$CKEditor->basePath = 'wizard/core/tools/ckeditor/';
		$CKEditor->editor($key, $value[$key]);
		break;
	case "radio":
		break;
	case "_captcha":
		break;
	case "date":
		t($wizard_model_name,$key); ?> <select name="day-<? print $key; ?>">
		<? for($x=1;$x<=31;$x++) { print "<option>".$x; } ?>
		</select>
		<select name="month-<? print $key; ?>">
		<? for($x=1;$x<=12;$x++) { print "<option>".$x; } ?>
		</select>
		<input type="text" name="year-<? print $key; ?>" maxlength="4" size="4">
		<br>
		<?
		break;
	default:
		if (is_array($class)) { 
			foreach ($class as $key2 => $class2) {
				switch ($key2) {
					case "select":
						$results = db($class["model"]);
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
						?></SELECT><br>
						<?
						break;
					case "count":
					break;
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
?>