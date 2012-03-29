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
			if (is_array($value_type)) {
				foreach ($value_type as $key2 => $class2) {
					switch ($key2) {
						case "select":
							$keys_select = $class2;
							$actv = 1;
							break;
						case "model":
							if ($actv == 1) {
								$keys_model = $class2;
								$actv = 2;
							}
					}
					if ($actv == 2) {
					$query_select = "select ".$keys_select." from ".$keys_model." where id = ".$result->fields[$type];
					$result_select = $db->Execute($query_select);
					?><TH><? print $result_select->fields[$keys_select]; ?></TH><?
					}
				}
			} else {
        		?><TH><?  print $result->fields[$type]; ?></TH><?
        	}
		}
	}
	// Update and Destroy buttons...
	?>
<th><form method="post" action="<? /* print $_go_update; */ print 'edit/'.$result->fields["id"]; ?>"><input type="hidden" name="action" value="read"><input type="hidden" name="id" value="<? print $result->fields["id"]; ?>"><input type="submit" value="<? t($wizard_model_name,"_go_update"); ?>"></form></th>
<th><form method="post" action="<? print $_go_destroy; ?>"><input type="hidden" name="action" value="destroy"><input type="hidden" name="form_id" value="<? print $wizard_model_name; ?>"><input type="hidden" name="id" value="<?print $result->fields["id"]; ?>"><input type="submit" value="<? t($wizard_model_name,"_go_destroy"); ?>"></form></th>
</tr>
	<?
	$result->MoveNext();
}
$db->Close();
?>
</TABLE>
