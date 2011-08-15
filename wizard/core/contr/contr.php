<?
// WizardPHP : Controller loader
$wizard_control_dir = opendir("wizard/controller");
while ($wizard_control_file = readdir($wizard_control_dir)) {
	$wizard_control_file_r="wizard/controller/".$wizard_control_file;
	if (is_dir($wizard_control_file_r) and $wizard_control_file !== "." and $wizard_control_file !== "..") { // Recuerda quitar el temp.
		$file_wizard_controller = $wizard_control_file_r."/controller.php";
		if (file_exists($file_wizard_controller)) {
			eval("
			function $wizard_control_file(){
				include('wizard/core/contr/init.php');
				include('wizard/controller/'.$wizard_control_file.'/controller.php');
			}
			");
		} else {
			print "<b>WizardPHP ERROR:</b> \"".$wizard_control_file_r."\" no contains \"controller.php\" file.<br>" ;
		}
	}
   }
closedir($wizard_control_dir); 
?>
