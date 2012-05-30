<?
// WizardPHP : Show List controller...
$keys = '';
$makecolumns = '';
$destroylock = 0;
$updatelock = 0;
if ($wizard_num_args >= 2) {
	$columnas = $wizard_args[1];
	$busqueda = $wizard_args[2];
}
?>
<TABLE> 
<TR> <?
// List of models with their corresponding translations.
foreach ($wizard_model as $type => $value_type) {
	if(substr($type,0,1) != '_') {
		?><TH><? t($wizard_model_name,$type); ?></TH><?
					$makecolumns = $type.",".$makecolumns;
	} else {
		if($type == "_go_update") {
			$_go_update = $value_type;
			$updatelock = 1;
		}	elseif ($type == "_go_destroy") {
			$_go_destroy = $value_type;
			$destroylock = 1;
		} else {
			if ($updatelock == 0) {
				$_go_update = "?";
			}
			if ($destroylock == 0) {
				$_go_destroy = "?";
			}
		}
	}
}
if ($wzd_url_mod != 0) { // URL Scaffold Modification
?><th></th><?
}
?></TR><?
// Print the content...
$finalcolumns = rtrim($makecolumns,",");
if (isset($busqueda)) {
	$col_ex = explode(" ",$columnas);
	$col_num = count($col_ex);
	if ($col_num != 1) {
		for ($i = 0; $i <= $col_num-1; $i++) {
			if ($i == 0) {
    			$col_query = $col_ex[$i]." LIKE '%".$busqueda."%' OR ";
    		} elseif ($i == $col_num-1) {
	    		$col_query = $col_query.$col_ex[$i]." LIKE '%".$busqueda."%'";
	    	} else {
	    		$col_query = $col_query.$col_ex[$i]." LIKE '%".$busqueda."%' OR ";
	    	}
	    }
	} else {
		$col_query = $col_ex[0]." LIKE '%".$busqueda."%'";
	}
	$db_query = "SELECT id,".$finalcolumns." FROM ".$wizard_model_name." WHERE ".$col_query;
} else {
	$db_query = "SELECT id,".$finalcolumns." FROM ".$wizard_model_name;
}
$results = db($db_query);
foreach ($results as $result) {
	?><tr><?
	foreach ($wizard_model as $type => $value_type) {
		// proves
		if(substr($type,0,1) != '_') {
			if (is_array($value_type)) {
				if ($result[$type] > 0 ) {
					$relat_1 = db($value_type['model'], $result[$type]);
					$relat_2 = $relat_1[0];
					$ty_mod2 = $value_type['select'];
					print "<td>".$relat_2[$ty_mod2]."</td>";
				} else {
					print "<td></td>";
				}
			} else {
				print "<td>".$result[$type]."</td>";
			}
		}
	}
	if ($wzd_url_mod == '1') { // URL Scaffold Modification
		?><td><a href="<? print $result['id']; ?>"><? t($wizard_model_name,'view'); ?></a></td><?
	} elseif ($wzd_url_mod == '2') {
		?><td><a href="show/<? print $result['id']; ?>"><? t($wizard_model_name,'view'); ?></a></td><?
	} elseif ($wzd_url_mod == '3') {
		?><td><a href="<? print $wizard_model_name; ?>/show/<? print $result['id']; ?>"><? t($wizard_model_name,'view'); ?></a></td><?
	} 
	?></tr><?
}
?>
</TABLE>
