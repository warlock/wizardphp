<?
// WizardPHP : Model loader
$wizard_model_dir = opendir("model");
$wzd_f_m = 0;
while ($wizard_model_file = readdir($wizard_model_dir)) {
	$wizard_model_file_r="model/".$wizard_model_file;
	if ($wizard_model_file !== "." and $wizard_model_file !== "..") {
		if (file_exists($wizard_model_file_r)) {
			if ($wzd_f_m == 1) {
				$wizard_model_incomplete = Spyc::YAMLLoad($wizard_model_file_r);
				$wizard_model_complete = array_merge($wizard_model_complete,$wizard_model_incomplete);
			} else {
				$wizard_model_complete = Spyc::YAMLLoad($wizard_model_file_r);
				$wzd_f_m = 1;
			}
		}
	}
}
closedir($wizard_model_dir);
foreach ($wizard_model_complete as $wzd_name_model => $wzd_value_in_model) {
	$wzd_model_names[] = $wzd_name_model;
}
?>
