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
			if (isset($trans[$model][$key])) {
				if ($trans[$model][$key] == "") {
					print $key;
				} else {
					print $trans[$model][$key];	
				}
			} else {
				print $key;
			}
			break;
		case "3":
			$model = func_get_arg(0);
			$key = func_get_arg(1);
			$lang = func_get_arg(2);
			if ($lang == "return") {
				global $language;
				$trans = Spyc::YAMLLoad('translate/'.$language.'.yml');
				return $trans[$model][$key]; 
			} else {
				$trans = Spyc::YAMLLoad('translate/'.$lang.'.yml');
				if (isset($trans[$model][$key])) {
					if ($trans[$model][$key] == "") {
						print $key;
					} else {
						print $trans[$model][$key];	
					}
				} else {
					print $key;
				}
			}
			break;
		case "4":
			$model = func_get_arg(0);
			$key = func_get_arg(1);
			$lang = func_get_arg(2);
			$return = func_get_arg(3);
			$trans = Spyc::YAMLLoad('translate/'.$lang.'.yml');
			return $trans[$model][$key]; 
			break;
	}
}
?>
