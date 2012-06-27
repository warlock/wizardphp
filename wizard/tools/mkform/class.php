<?php
switch ($class) {
	case "string":
		t($wizard_model_name,$key); ?> <input type="text" name="<?php print $key; ?>" value="<?php if ($id_update > 0) { print $value[$key]; } ?>"><br>
		<?php
		break;
	case "password":
		t($wizard_model_name,$key); ?> <input type="password" name="<?php print $key; ?>"><br>
		<?php
		break;
	case "checkbox":
		break;
	case "text":
		t($wizard_model_name,$key); ?> <textarea name="<?php print $key; ?>" rows="3" cols="20"><?php if ($id_update > 0) { print $value[$key]; } ?></textarea><br>
		<?php	
		break;
	case "wysiwyg":
		t($wizard_model_name,$key);
		?><br><?php
		$CKEditor = new CKEditor();
		$CKEditor->basePath = 'wizard/core/tools/ckeditor/';
		$CKEditor->editor($key, $value[$key]);
		break;
	case "radio":
		break;
	case "_captcha":
		break;
	case "date":
		t($wizard_model_name,$key); ?> <select name="day-<?php print $key; ?>">
		<?php for($x=1;$x<=31;$x++) { print "<option>".$x; } ?>
		</select>
		<select name="month-<?php print $key; ?>">
		<?php for($x=1;$x<=12;$x++) { print "<option>".$x; } ?>
		</select>
		<input type="text" name="year-<?php print $key; ?>" maxlength="4" size="4">
		<br>
		<?php
		break;
	default:
		if (is_array($class)) { 
			foreach ($class as $key2 => $class2) {
				switch ($key2) {
					case "select":
						$results = db($class["model"]);
						t($wizard_model_name,$key);
						?> <SELECT NAME="<?php print $key; ?>" SIZE="1"><?php
						foreach ($results as $result) {
							?><OPTION VALUE="<?php  print $result['id']; ?>" <?php 
							if ($id_update > 0) {
								if ($result['id'] == $value[$key]) {
									print "SELECTED";
								}
							}
							?> > <?php  print $result[$class2]; ?></OPTION><?php
						}
						?></SELECT><br>
						<?php
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