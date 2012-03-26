<?
// WizardPHP : Controller loader
$wizard_control_dir = opendir("controller");
while ($wizard_control_file = readdir($wizard_control_dir)) {
	$wizard_control_file_r="controller/".$wizard_control_file;
	if (is_dir($wizard_control_file_r) and $wizard_control_file !== "." and $wizard_control_file !== "..") { // Recuerda quitar el temp.
		$file_wizard_controller = $wizard_control_file_r."/controller.php";
		if (file_exists($file_wizard_controller)) {
			eval("function $wizard_control_file () {
				include(\"wizard/contr/init.php\");
				include(\"controller/$wizard_control_file/controller.php\");
			};");
		} else {
			wizard_error("Controller <b>".$wizard_control_file_."</b> no contains \"controller.php\" file.<br>");
		}
	}
   }
closedir($wizard_control_dir); 
?>