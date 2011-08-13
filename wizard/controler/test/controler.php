<?
// WizardPHP : Test controler...
?>Printing structure: <b><?
print $wizard_model_name."</b><br>"; 
foreach ($wizard_model as $name => $value) {
	if(is_array($value)) {
		?><b><? print $name; ?></b> : <? foreach ($value as $sub => $value2) { print "[".$value2."]"; } ?><br><?
	} else {
		?><b><? print $name; ?></b> : <? print $value; ?><br><?
	}
}
?>
