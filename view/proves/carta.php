<? include('wizard/wizard.php'); ?>
<html>
	<head>
		<title>CARTA</title>
	</head>
	<body>
<? if ($post_id>0) { ?>
EDITANT CARTA: <? print $post_id; ?>
<? } else { ?>
CREANT UNA NOVA CARTA
<? }
form('cartes');
 ?>
	</body>
</html>