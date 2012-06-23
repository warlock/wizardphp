<?
function mkform() {
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
				?>
				<form method="post" action="<? print $class; ?>">
				<?			
			} else {
				?>
				<form method="post" action="">
				<?
			}
		} elseif ($wizard_model_name == "_hidden") {
			?>
			<input type="hidden" name="<? print $class; ?>" value="<? print $key; ?>">
			<?
		} elseif ($wizard_model_name == "_button") {
			?>
			<input type="<? print $key; ?>" value="<? t($class,$key); ?>">
			<?
		} else {
			include('class.php');
		}
	} else {
		?>
		</form>
		<?
	}
}
?>