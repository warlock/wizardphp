<?
// WizardPHP: TRANSLATION SYSTEM
function t() {
$numargs = func_num_args();
	switch ($numargs) {
		case "2":
			$model = func_get_arg(0);
			$key = func_get_arg(1);
			global $language;
			$trans = Spyc::YAMLLoad('translate/'.$language.'.yml');
			if ($trans[$model][$key] == "") {
				print $key;
			} else {
				print $trans[$model][$key];	
			}
			break;
		case "3":
			$model = func_get_arg(0);
			$key = func_get_arg(1);
			$lang = func_get_arg(2);
			$trans = Spyc::YAMLLoad('translate/'.$lang.'.yml');
			if ($trans[$model][$key] == "") {
				print $key;
			} else {
				print $trans[$model][$key];	
			}
			break;
	}
}
?>
