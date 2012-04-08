<?
if ($wizard_config['mode'] == "development") {
	$wzd_model_next = $wzd_model_seg+1;
	$wzd_model_tres = $wzd_model_seg+2;
	if(isset($wzd_segmento[$wzd_model_next]) and $wzd_segmento[$wzd_model_next] != "") {
		switch ($wzd_segmento[$wzd_model_next]) {
			case 'edit':
				if(isset($wzd_segmento[$wzd_model_tres]) and $wzd_segmento[$wzd_model_tres] != "") {
					?><a href="../edit"><? t($wzd_segmento[$wzd_model_seg],'edit_list'); ?></a><br><?
					$wzd_from_seg = "edit_url";
					form($wzd_segmento[$wzd_model_seg],$wzd_segmento[$wzd_model_tres]);
				} else {
					?><a href="new"><? t($wzd_segmento[$wzd_model_seg],'create_new'); ?></a><br><?
					edit_list($wzd_segmento[$wzd_model_seg]);
				}
				break;
				
			case 'show':
				if(isset($wzd_segmento[$wzd_model_tres]) and $wzd_segmento[$wzd_model_tres] != "") {
					?><a href="../show"><? t($wzd_segmento[$wzd_model_seg],'show_list'); ?></a><br><?
					show_item($wzd_segmento[$wzd_model_seg],$wzd_segmento[$wzd_model_tres]);
				} else {
					show_list($wzd_segmento[$wzd_model_seg],'1');
				}
				break;
				
			case 'new':
				?><a href="edit"><? t($wzd_segmento[$wzd_model_seg],'edit_list'); ?></a><br><?
				$wzd_from_seg = "new_url";
				form($wzd_segmento[$wzd_model_seg]);
				break;
			default:
				print $wzd_segmento[$wzd_model_seg].">".$wzd_segmento[$wzd_model_next];
		}
	} else {
		show_list($wzd_segmento[$wzd_model_seg],'2');
	}
} else {
	include('view/default.phtml');
}
?>