<form action="pedido.php" method="POST">
Nombre: <input type="text" name="nombre" value="<?= isset($_POST['nombre'])? $_POST['nombre'] : ''; ?>"><br>
Apellidos: <input type="text" name="apellidos" value="<?= isset($_POST['apellidos'])? $_POST['apellidos'] : ''; ?>"><br>
<input type="hidden" name="nT" value="<?= isset($_POST['nT'])? $_POST['nT']:''; ?>">
<input type="hidden" name="direccion" value="<?= isset($_POST['direccion'])? $_POST['direccion']:''; ?>">

<button type="submit" name="siguiente" >Siguiente</button>

</form>