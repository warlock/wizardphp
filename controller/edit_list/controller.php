<?php
// WizardPHP : Edit List controller...
$keys = '';
$makecolumns = '';
$destroylock = 0;
$updatelock = 0;
if ($wizard_num_args == 2) {
	//$from_seg = $wizard_args[1]; // If 2nd arg is 1, show view
}
?>
<TABLE> 
<TR> <?php
// List of models with their corresponding translations.
foreach ($wizard_model as $type => $value_type) {
	if(substr($type,0,1) != '_') {
		?><TH><?php t($wizard_model_name,$type); ?></TH><?php
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
?><th></th><th></th></TR><?php
// Print the content...
$finalcolumns = rtrim($makecolumns,",");
$results = db("SELECT id,".$finalcolumns." FROM ".$wizard_model_name); 
foreach ( $results as $result ) {
	?><tr><?php
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
	?><td><?php
	if ($wzd_url_mod == '1') { // Edit button from URL
		f("_open",$result["id"]);
	} else { // Edit button for scaffolding !
		f("_open","edit/".$result["id"]);
	}
	f("_hidden","action","read");
	f("_hidden","id",$result["id"]);
	f("_button","submit",$wizard_model_name,"_go_update");
	f();
	?></td><td><?php
	// Destroy button!
	f("_open",$_go_destroy);
	f("_hidden","action","destroy");
	f("_hidden","form_id",$wizard_model_name);
	f("_hidden","id",$result["id"]);
	f("_button","submit",$wizard_model_name,"_go_destroy");
	f();
	?></td></tr><?
}
?>
</TABLE>
