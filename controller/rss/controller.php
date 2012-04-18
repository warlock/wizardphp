<?
// This controller is under construction!
$rss = $wizard_model_name;
$rssobert = fopen($rss,'r');
$xml = simplexml_load_file($rss);
//print_r($xml);

foreach ( $xml as $tipo => $value_tipo) {
	foreach ( $value_tipo as $value => $result ) {
		?><b><?= $value ?></b><?= $result ?><br><?
	}
} 
?>
