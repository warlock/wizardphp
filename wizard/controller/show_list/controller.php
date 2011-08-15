<?
// WizardPHP : Show List controler...
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
		?><TH><? trans($wizard_model_name,$type); ?></TH><?
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
$db = &ADONewConnection($wizard_config['class']);
$db->PConnect($wizard_config['host'],$wizard_config['user'],$wizard_config['password'],$wizard_config['database']);
$result = $db->Execute("SELECT id,".$finalcolumns." FROM ".$wizard_model_name);
while (!$result->EOF) {
	?><tr><?
	foreach ( $wizard_model as $type => $value_type) {
		if(substr($type,0,1) != '_') {
        	?><TH><?  print $result->fields[$type]; ?></TH><?
		}
	}
	// Update and Destroy buttons...
	?>
<th><form method="post" action="<? print $_go_update; ?>"><input type="hidden" name="update_form" value="<? print $wizard_model_name; ?>"><input type="hidden" name="id" value="<? print $result->fields["id"]; ?>"><input type="submit" value="<? trans($wizard_model_name,"_go_update"); ?>"></form></th>
<th><form method="post" action="<? print $_go_destroy; ?>"><input type="hidden" name="action" value="destroy"><input type="hidden" name="form_id" value="<? print $wizard_model_name; ?>"><input type="hidden" name="id" value="<?print $result->fields["id"]; ?>"><input type="submit" value="<? trans($wizard_model_name,"_go_destroy"); ?>"></form></th>
</tr>
	<?
	$result->MoveNext();
}
$db->Close();
?>
</TABLE>
