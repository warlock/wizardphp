<?
// WizardPHP : Edit List controller...
$keys = '';
$makecolumns = '';
$destroylock = 0;
$updatelock = 0;
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
				$_go_update = "";
			}
			if ($destroylock == 0) {
				$_go_destroy = "";
			}
		}
	}
}
?><th></th><th></th></TR><?
// Print the content...
$finalcolumns = rtrim($makecolumns,",");
$results = db("SELECT id,".$finalcolumns." FROM ".$wizard_model_name); 
foreach ( $results as $result ) {
	?><tr><?
	foreach ($wizard_model as $type => $value_type) {
		if(substr($type,0,1) != '_') {
			if (is_array($value_type)) {
				//print "<td>".$value_type['model']." : ".$value_type['select']."</td>";
				if ($result[$type] > 0 ) {
					$relat_1 = db("SELECT ".$value_type['select']." FROM ".$value_type['model']." where id = ".$result[$type]);
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
	// Update and Destroy buttons...
	?>
<td><form method="post" action="<? /* print $_go_update; */ print 'edit/'.$result["id"]; ?>"><input type="hidden" name="action" value="read"><input type="hidden" name="id" value="<? print $result["id"]; ?>"><input type="submit" value="<? t($wizard_model_name,"_go_update"); ?>"></form></td>
<td><form method="post" action="<? print $_go_destroy; ?>"><input type="hidden" name="action" value="destroy"><input type="hidden" name="form_id" value="<? print $wizard_model_name; ?>"><input type="hidden" name="id" value="<? print $result["id"]; ?>"><input type="submit" value="<? t($wizard_model_name,"_go_destroy"); ?>"></form></td>
</tr>
	<?
}
?>
</TABLE>
