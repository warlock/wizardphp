<? include('wizard/wizard.php'); ?>
<html>
	<head>
		<title>GESTIO DE FEEDS</title>
	</head>
	<body>
	<a href="feed.php">CREAR UN NOU FEED</a><br>
	LLISTA DE FEEDS:
<? show_list('feeds'); ?>
	<a href="upload.php">MODIFICA LES TABLES</a><br>
<a href="trans.php">TRADUCCIONS AL ANGLES</a><br>
(Aixo es temporal, pues l'edicio de documents directamente sol ser un error de seguretat gravisim. Supuso que no fa falta que digui que vagis encompte)
	</body>
</html>