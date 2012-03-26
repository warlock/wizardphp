<?
// WizardPHP : View loader

$wzd_url = $_SERVER[ "PHP_SELF"];
$wzd_segmentos = explode("index.php/",$wzd_url);
$wzd_segmento = split('/',$wzd_segmentos[1]);

if ($wzd_segmento[0] != "" ) {
	$file = 'view/'.$wzd_segmento[0].'.phtml';
} else {
	$file = 'view/index.phtml';
}
if (isset($file)) {
	if (file_exists($file)) {
		//File exists
		include($file);
	} else {
		// Want models
		foreach ($wizard_model_complete as $name => $value) {
			$names[] = $name;
		}
		if (in_array($wzd_segmento[0], $names)) {
			include('scaffold.php');
		} else {
			//Printing error page
			?><b>WELCOME TO WIZARDPHP</b><br>
			<a href="http://www.wizardphp.com">INFORMATION DOCUMENTATION AND TUTORIALS</a><?
		}
	}
}
?>
