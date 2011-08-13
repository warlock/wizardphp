<?
// This controller is under construction!
print_r($wizard_model_complete);
$rss = $wizard_model_complete;
$rssobert = fopen($rss,'r');
$xml = simplexml_load_file($rss);
print_r($xml);
foreach ( $rss as $tipo => $value_tipo) {
	if ($tipo == $wizard_model_name) {
		?>Printing RSS: <b><?
		print $tipo."</b><br>"; 
		foreach ($value_tipo as $sub => $val) {
			foreach ($val as $sub_2 => $val_2) {
				?><b><? print $sub_2; ?></b> : <? print $val_2; ?><br><?
			}
       		}
	} 
} 
?>
