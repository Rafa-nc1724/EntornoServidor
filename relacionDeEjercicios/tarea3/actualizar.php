<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Plantilla para Ejercicios Tema 3</title>
  <link href="plantilla/dwes.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="encabezado">
	<h1>Ejercicio: </h1>
	<form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	</form>
</div>

<div id="contenido">
	<h2>Se han actualizado los datos</h2>
    <form action="listado.php" method="POST">
        <input type="submit" name="continuar" value="Continuar">
    </form>
</div>

<div id="pie">
</div>
</body>
</html>
