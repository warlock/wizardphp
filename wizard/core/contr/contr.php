<?
// WizardPHP : Controler loader
$wizard_control_dir = opendir("wizard/controler");
while ($wizard_control_file = readdir($wizard_control_dir)) {
	$wizard_control_file_r="wizard/controler/".$wizard_control_file;
	if (is_dir($wizard_control_file_r) and $wizard_control_file !== "." and $wizard_control_file !== "..") { // Recuerda quitar el temp.
		$file_wizard_controler = $wizard_control_file_r."/controler.php";
		if (file_exists($file_wizard_controler)) {
			eval("
			function $wizard_control_file(){
				include('wizard/core/contr/init.php');
				include('wizard/controler/'.$wizard_control_file.'/controler.php');
			}
			");
		} else {
			print "<b>WizardPHP ERROR:</b> \"".$wizard_control_file_r."\" no contains \"controler.php\" file.<br>" ;
		}
	}
   }
closedir($wizard_control_dir); 
?>
