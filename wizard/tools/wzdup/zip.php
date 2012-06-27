<?php
// WZD: MKZIP TOOL
function mkzip($v_dir = "no") {
	if(defined('STDIN') ) {
		$end = "\n";
	} else {
		$end = "<br>";
	}
	if ($v_dir != "no") {
		require_once('../pclzip.lib.php');
		$archive = new PclZip($v_dir.'.zip');
		//$v_dir = getcwd(); // or dirname(__FILE__);
		$v_remove = $v_dir;
		// To support windows and the C: root you need to add the
		// following 3 lines, should be ignored on linux
		if (substr($v_dir, 1,1) == ':') {
			$v_remove = substr($v_dir, 2);
		}
		$v_list = $archive->create($v_dir, PCLZIP_OPT_REMOVE_PATH, $v_remove);
		if ($v_list == 0) {
			die("Wizard Error: ".$archive->errorInfo(true).$end);
		}
	} else {
		print "Wizard Error: Please insert zip name.".$end;
	}
}

//WZD: UNZIP TOOL
function unzip($v_dir = "no") {
	if(defined('STDIN') ) {
		$end = "/n";
	} else {
		$end = "<br>";
	}
	if ($v_dir != "no") {
		require_once('pclzip.lib.php');
		$archive = new PclZip($v_dir.'.zip');
		if ($archive->extract(PCLZIP_OPT_PATH, $v_dir) == 0) {
			die("Wizard Error: ".$archive->errorInfo(true).$end);
		}
	} else {
		print "Wizard Error: Please insert zip name.".$end;
	}
}

?>