<form action="confirmacion.php" method="POST">
Dirección: <input type="text" name="direccion" value="<?= isset($_POST['direccion'])? $_POST['direccion']:''; ?>"><br>
Nº Targeta: <input type="text" name="nT" value="<?= isset($_POST['nT'])? $_POST['nT']:''; ?>"><br>
<input type="hidden" name="nombre" value="<?= $_POST['nombre']; ?>">
<input type="hidden" name="apellidos" value="<?= $_POST['apellidos']; ?>">
<button type="submit" name="accion" value="siguiente">Siguiente</button>
<button type="submit" name="atras" formaction="datos.php" value="atras">Atrás</button>

</form>