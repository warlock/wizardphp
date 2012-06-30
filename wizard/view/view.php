<?php
// WizardPHP : View loader
function start_wizard() {
	global $wzd_url;
	global $wzd_url_mod;
	global $wzd_model_names;
	global $wizard_model_complete;
	global $wizard_config;
	global $language;
	$wzd_segmentos = $wzd_url;
	if (substr($wzd_url,-1) == "/") {
		$wzd_end_url = TRUE;
		$wzd_segmentos = rtrim($wzd_url, '/');
	} else {
		$wzd_end_url = FALSE;
	}
	$wzd_segmento = split('/',$wzd_segmentos);
	if ($wzd_segmento[0] != "" ) { //CON SEGMENTOS
		$wzd_may_lang_file = "translate/".$wzd_segmento[0].".yml";
		if (file_exists($wzd_may_lang_file)) { //CON IDIOMA!
			$language = $wzd_segmento[0];
			if(isset($wzd_segmento[1])) {
				if($wzd_segmento[1] != "") { // SEGMENTO CONTIGUO NO VACIO
					$wzd_file = 'view/'.$wzd_segmento[1].'.phtml';
					if (file_exists($wzd_file)) { // EXISTE EL ARCHIVO?
						include($wzd_file); // ARCHIVO CON TRADUCCION
					} else { // NO EXISTE ARCHIVO, MIRAR MODELOS
						if (in_array($wzd_segmento[1], $wzd_model_names)) {
							$wzd_model_seg = 1;
							include('scaffold.php'); // MODELO + TRADUCCION
						} else {
							include('view/default.phtml'); //PAGINA POR DEFAULT + TRADUCCION
						}
					}
				} else { // SEGMENTO CONTIGUO VACIO
					include('view/index.phtml'); // SIN SEGUNDO SEGMENTO CON TRADUCCION
				}
			} else { // SEGMENTO CONTIGUO VACIO
				include('view/index.phtml'); // SIN SEGUNDO SEGMENTO CON TRADUCCION
			}
		} else { // SIN IDIOMA
			$wzd_file = 'view/'.$wzd_segmento[0].'.phtml';
			if (file_exists($wzd_file)) {// EL ARCHIVO EXISTE?
				include($wzd_file); // CARGA ARCHIVO
			} else { // EL ARCHIVO NO EXISTE, MIRAR MODELOS
				if (in_array($wzd_segmento[0], $wzd_model_names)) {
					$wzd_model_seg = 0;
					include('scaffold.php'); // MODELO
				} else {
					include('view/default.phtml'); //PAGINA POR DEFAULT
				}
			}
		}
	} else { // SIN SEGMENTOS
		$wzd_file = 'view/index.phtml';
		if (file_exists($wzd_file)) {
			include($wzd_file);
		} else {
			include('view/default.phtml');
		}
	}
}
?>
