<?
// Controller defaults
global $wizard_model_complete;
global $wizard_config;
global $language;
$wizard_args = func_get_args();
$wizard_num_args = func_num_args();
$wizard_model_name = $wizard_args[0];
$wizard_model = $wizard_model_complete[$wizard_model_name];
?>
