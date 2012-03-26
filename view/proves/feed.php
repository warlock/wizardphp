<? include('wizard/wizard.php'); ?>
<html>
	<head>
		<title>GESTIO DE FEEDS</title>
	</head>
	<body>
<?	if ($post_id>0) { print "MODIFICA EL FEED: ".$post_id."<br>"; } else { print "CREA UN NOU FEED:<br>"; } ?>
<? form('feeds'); ?><br>
<a href="index.php">Tornar a la llista de feeds</a>
	</body>
</html>