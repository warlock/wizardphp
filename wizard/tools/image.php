<?php
function image($theme,$image) {
	$image_url = "http://" . $_SERVER["SERVER_NAME"]."/view/themes/".$theme."/".$image;
	print $image_url;
}
?>