<?php
$document = "wizard/model.yml";
if(isset($_POST["submit"])){
if(@$fp = fopen($document, "w")){
 $datos = stripslashes($_POST["newdata"]);
  fwrite($fp, stripslashes($datos));
  fclose($fp);
  print "<b>LOS CAMBIOS HAN SIDO GUARDADOS!</b><br>";
} else {
  exit ("<h1>Error</h1>\n<p>No se puede escribir el archivo, asegurate que los permisos son correctos(CHMOD 777).</p>");
}
}

if($fp = fopen($document, "r")){
  $data = fread($fp, filesize($document));
  fclose($fp);
} else {
  $data = "";
  exit ("<h1>Error</h1>\n<p>No se puede escribir el archivo, asegurate que los permisos son correctos(CHMOD 777).</p>");
}
?>