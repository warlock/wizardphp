<?
function wizard_error($msg) {
	global $wizard_debug;
	if ($wizard_debug == 1 ) {
		print "<b>WizardPHP ERROR:</b> ".$msg;
	}

}
?>