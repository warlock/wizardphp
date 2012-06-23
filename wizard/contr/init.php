<?
// Controller defaults
global $wizard_model_complete;
global $wizard_config;
global $language;
global $wzd_url_mod;
$wizard_args = func_get_args();
$wizard_num_args = func_num_args();
$wizard_model_name = $wizard_args[0];
if (isset($wizard_model_complete[$wizard_model_name])) {
	$wizard_model = $wizard_model_complete[$wizard_model_name];
}
?>
