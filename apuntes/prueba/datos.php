<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
<form action="procesa.php" method="POST">
Nombre:<input type="text" name="nombre"><br><br>
Apellidos:<input type="text" name="apellidos"><br><br>
Email:<input type="text" name="email"><br><br>
Modulos:<br>
<input type="checkbox" name="modulos[]" value="DWES">Desarrollo web Entorno Servidor<br>
<input type="checkbox" name="modulos[]" value="DIW">Diseño de Interfaces Web<br>
<input type="checkbox" name="modulos[]" value="DWEC">Desarrollo web Entorno Cliente<br><br>

<!--<input type="submit" name="enviar" value="Enviar">-->
<button type="submit" name="enviar">Enviar</button>

</form>
<!-- <a href="opcion.php?n=1">opcion 1<br></a>
<a href="opcion.php?n=2">opcion 2<br></a>
<a href="opcion.php?n=3">opcion 3<br></a> -->
<br>
<?php
//print_r($_GET);
?>

    
</body>
</html>