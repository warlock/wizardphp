<?
// WizardPHP : Show List controller...
$keys = '';
$makecolumns = '';
$destroylock = 0;
$updatelock = 0;
if ($wizard_num_args == 2) {
	$from_seg = $wizard_args[1]; // If 2nd arg is 1, show view
}

?>
<TABLE BORDER="1"> 
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
?></TR><?
// Print the content...
$finalcolumns = rtrim($makecolumns,",");
$results = db("SELECT id,".$finalcolumns." FROM ".$wizard_model_name);
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
	if ($from_seg == 1) {
		?><th><a href="show/<? print $result['id']; ?>"><? t($wizard_model_name,'view'); ?></a></th><?
	} elseif ($from_seg = 2) {
		?><th><a href="<? print $wizard_model_name; ?>/show/<? print $result['id']; ?>"><? t($wizard_model_name,'view'); ?></a></th></tr><?
	}
}
?>
</TABLE>
