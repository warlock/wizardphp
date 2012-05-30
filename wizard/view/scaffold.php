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
						edit_list($wzd_segmento[$wzd_model_seg],1);
					} else {
						edit_list($wzd_segmento[$wzd_model_seg]);
					}
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
						show_list($wzd_segmento[$wzd_model_seg],1);
					} else {
						show_list($wzd_segmento[$wzd_model_seg],2);
					}
				}
				theme("bottom");
			} else {
				include('view/default.phtml');
			}
			break;
		case 'search':
			if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_show'] or $wizard_config['mode'] == "development") {//Tiene level para ver
					print "Modelo: ".$wzd_model_seg;
			} else {
				include("view/default.phtml");
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
				include('view/default.phtml');
			}
	}
} else {
	if(user('level') >= $wizard_model_complete[$wzd_segmento[$wzd_model_seg]]['_show'] or $wizard_config['mode'] == "development") {
		theme("top");
		if ($wzd_end_url) {
			show_list($wzd_segmento[$wzd_model_seg],2);
		} else {
			show_list($wzd_segmento[$wzd_model_seg],3);
		}
		theme("bottom");
	} else {
		include('view/default.phtml');
	}
}
?>