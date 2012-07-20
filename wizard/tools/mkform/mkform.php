<?php
function f() {
	global $wizard_model_complete;
	global $wizard_config;
	global $language;
	$mkform_num_args = func_num_args();
	if ($mkform_num_args > 0) {
		switch ($mkform_num_args) {
			case 1:
				$wizard_model_name = func_get_arg(0);
				$id_update = 0;
				break;
			case 2:
				$wizard_model_name = func_get_arg(0);
				$class = func_get_arg(1);
				$id_update = 0;
				break;
			case 3:
				$wizard_model_name = func_get_arg(0);
				$class = func_get_arg(1);
				$key = func_get_arg(2);
				$id_update = 0;
				break;
			case 4:
				$wizard_model_name = func_get_arg(0);
				$class = func_get_arg(1);
				$key = func_get_arg(2);
				$value = func_get_arg(3);
				$id_update = 0;
				break;
			case 5:
				$wizard_model_name = func_get_arg(0);
				$class = func_get_arg(1);
				$key = func_get_arg(2);
				$value = func_get_arg(3);
				$id_update = func_get_arg(4);
		}
		if ($wizard_model_name == "_open") {
			if(isset($class)) {
				if (isset($key)) {
					?>
					<form method="post" action="<?php print $class; ?>" id="<?php print $key; ?>">
					<?php
				} else {
					?>
					<form method="post" action="<?php print $class; ?>">
					<?php	
				}		
			} else {
				?>
				<form method="post" action="">
				<?php
			}
		} elseif ($wizard_model_name == "_hidden") {
			?>
			<input type="hidden" name="<?php print $class; ?>" value="<?php print $key; ?>">
			<?php
		} elseif ($wizard_model_name == "_button") {
			if ($class == "reset") {
				?>
				<input type="reset" value="<?php t($key,$value); ?>">
				<?php
			} else {
				?>
				<input type="submit" value="<?php t($key,$value); ?>">
				<?php
			}
		} else {
			include('class.php');
		}
	} else {
		?>
		</form>
		<?php
	}
}
?>