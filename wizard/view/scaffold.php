<?
	$wzd_model_next = $wzd_model_seg+1;
	$wzd_model_tres = $wzd_model_seg+2;
	if(isset($wzd_segmento[$wzd_model_next]) and $wzd_segmento[$wzd_model_next] != "") {
		switch ($wzd_segmento[$wzd_model_next]) {
			case 'edit':
				if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_edit'] or $wizard_config['mode'] == "development") {
					include('view/theme/top.phtml');
					if(isset($wzd_segmento[$wzd_model_tres]) and $wzd_segmento[$wzd_model_tres] != "") {
						?><a href="../edit"><? t($wzd_segmento[$wzd_model_seg],'edit_list'); ?></a><br><?
						$wzd_from_seg = "edit_url";
						form($wzd_segmento[$wzd_model_seg],$wzd_segmento[$wzd_model_tres]);
					} else {
						if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_create'] or $wizard_config['mode'] == "development") {
						?><a href="new"><? t($wzd_segmento[$wzd_model_seg],'create_new'); ?></a><br><?
						}
						edit_list($wzd_segmento[$wzd_model_seg]);
					}
					include('view/theme/bottom.phtml');
				} else {
					include('view/default.phtml');
				}
				break;
				
			case 'show':
				if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_show'] or $wizard_config['mode'] == "development") {
					include('view/theme/top.phtml');
					if(isset($wzd_segmento[$wzd_model_tres]) and $wzd_segmento[$wzd_model_tres] != "") {
						?><a href="../show"><? t($wzd_segmento[$wzd_model_seg],'show_list'); ?></a><br><?
						show_item($wzd_segmento[$wzd_model_seg],$wzd_segmento[$wzd_model_tres]);
					} else {
						show_list($wzd_segmento[$wzd_model_seg],'1');
					}
					include('view/theme/bottom.phtml');
				} else {
					include('view/default.phtml');
				}
				break;
				
			case 'new':
				if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_create'] or $wizard_config['mode'] == "development") {
					include('view/theme/top.phtml');
					?><a href="edit"><? t($wzd_segmento[$wzd_model_seg],'edit_list'); ?></a><br><?
					$wzd_from_seg = "new_url";
					form($wzd_segmento[$wzd_model_seg]);
					include('view/theme/bottom.phtml');
				} else {
					include('view/default.phtml');
				}
				break;
			default:
				if ($wizard_config['mode'] == "development") {
					include('view/theme/top.phtml');
					print $wzd_segmento[$wzd_model_seg].">".$wzd_segmento[$wzd_model_next];
					include('view/theme/bottom.phtml');
				} else {
					include('view/default.phtml');
				}
		}
	} else {
		if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_show'] or $wizard_config['mode'] == "development") {
			include('view/theme/top.phtml');
				show_list($wzd_segmento[$wzd_model_seg],'2');
			include('view/theme/bottom.phtml');
		} else {
			include('view/default.phtml');
		}
	}
?>