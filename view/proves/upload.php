<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<? include "funciones.php"; ?>
<? include('wizard/wizard.php'); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Editar TXT</title>
</head>
<body>
<a href="index.php">TORNAR A LA LLISTA DE FEEDS(Ante la duda, haz click aqui)</a>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<fieldset>
  <label>Contenido <strong>Model.yml</strong>:<br>
  <textarea name="newdata" rows="50" cols="100"><?php echo $data; ?></textarea></label><br>
  <label><input type="submit" name="submit" value="Guardar"></label>
</fieldset>
</form>
</body>
</html>