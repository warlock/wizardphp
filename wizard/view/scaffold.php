<?
$wzd_seg_act = array(
    "1" => $wzd_model_seg+1,
    "2" => $wzd_model_seg+2,
    "3" => $wzd_model_seg+3
);
if(isset($wzd_segmento[$wzd_seg_act[1]]) and $wzd_segmento[$wzd_seg_act[1]] != "") {
	switch ($wzd_segmento[$wzd_seg_act[1]]) {
		case 'edit':
			if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_edit'] or $wizard_config['mode'] == "development") {
				theme("top");
				if(isset($wzd_segmento[$wzd_seg_act[2]]) and $wzd_segmento[$wzd_seg_act[2]] != "") {
					?><a href="../edit"><? t($wzd_segmento[$wzd_model_seg],'edit_list'); ?></a><br><?
					$wzd_from_seg = "edit_url";
					form($wzd_segmento[$wzd_model_seg],$wzd_segmento[$wzd_seg_act[2]]);
				} else {
					if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_create'] or $wizard_config['mode'] == "development") {
						?><a href="new"><? t($wzd_segmento[$wzd_model_seg],'create_new'); ?></a><br><?
					}
					if ($wzd_end_url) {
						$wzd_url_mod = 1;
					}
					edit_list($wzd_segmento[$wzd_model_seg]);

				}
				theme("bottom");
			} else {
				include('view/default.phtml');
			}
			break;
		case 'show':
			if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_show'] or $wizard_config['mode'] == "development") {
				theme("top");
				if(isset($wzd_segmento[$wzd_seg_act[2]]) and $wzd_segmento[$wzd_seg_act[2]] != "") {
					?><a href="../show"><? t($wzd_segmento[$wzd_model_seg],'show_list'); ?></a><br><?
					show_item($wzd_segmento[$wzd_model_seg],$wzd_segmento[$wzd_seg_act[2]]);
				} else {
					if ($wzd_end_url) {
						$wzd_url_mod = 1;
					} else {
						$wzd_url_mod = 2;
					}
						show_list($wzd_segmento[$wzd_model_seg]);
				}
				theme("bottom");
			} else {
				include("view/default.phtml");
			}
			break;
		case 'search':
			if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_show'] or $wizard_config['mode'] == "development") { 
				$wzd_col_seg = explode(" ",$wzd_segmento[$wzd_seg_act[2]]);
				foreach ($wizard_model_complete[$wzd_segmento[$wzd_model_seg]] as $wzd_col_mkr => $wzd_ky_mkr ) {
					if(substr($wzd_col_mkr,0,1) != '_') {
						$wzd_col_model[] = $wzd_col_mkr;
					}
				}
				$wzd_need = count($wzd_col_seg);
				$wzd_reslt = array_intersect($wzd_col_seg, $wzd_col_model);
				$wzd_have = count($wzd_reslt);
				$wzd_col_seg2 = explode(" ",$wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_search']);
				$wzd_reslt2 = array_intersect($wzd_col_seg, $wzd_col_seg2);
				$wzd_have2 = count($wzd_reslt2);
				if ($wzd_need == $wzd_have) {
					if($wzd_need == $wzd_have2 or $wizard_config['mode'] == "development") {
						theme("top");
						show_list($wzd_segmento[$wzd_model_seg],$wzd_segmento[$wzd_seg_act[2]],$wzd_segmento[$wzd_seg_act[3]]);
						theme("bottom");
					} else {
						include("view/default.phtml");
					}
				} else {
					include("view/default.phtml");
				}
			}
			break;
		case 'new':
			if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_create'] or $wizard_config['mode'] == "development") {
				theme("top");
				?><a href="edit"><? t($wzd_segmento[$wzd_model_seg],'edit_list'); ?></a><br><?
				$wzd_from_seg = "new_url";
				form($wzd_segmento[$wzd_model_seg]);
				theme("bottom");
			} else {
				include('view/default.phtml');
			}
			break;
		default:
			if ($wizard_config['mode'] == "development") {
				theme("top");
				print $wzd_segmento[$wzd_model_seg].">".$wzd_segmento[$wzd_seg_act[1]];
				theme("bottom");
			} else {
				include("view/default.phtml");
			}
	}
} else {
	if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_show'] or $wizard_config['mode'] == "development") {
		theme("top");
		if ($wzd_end_url) {
			$wzd_url_mod = 2;
		} else {
			$wzd_url_mod = 3;
		}
		show_list($wzd_segmento[$wzd_model_seg]);
		theme("bottom");
	} else {
		include('view/default.phtml');
	}
}
?>