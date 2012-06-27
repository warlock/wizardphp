<?php
function theme() {
	if (func_num_args() == 2) {
		include("view/themes/".func_get_arg(0)."/".func_get_arg(1).".phtml");
	} elseif (func_num_args() == 1) {
		include("view/themes/default/".func_get_arg(0).".phtml");
	}
}
?>