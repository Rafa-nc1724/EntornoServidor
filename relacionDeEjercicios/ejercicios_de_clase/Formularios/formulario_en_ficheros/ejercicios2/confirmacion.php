
    <?php
    echo "<h2>Datos:</h2>";
    echo "Nombre: " . $_POST['nombre'] . "<br>";
    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
    echo "Dirección: " . $_POST['direccion'] . "<br>";
    echo "Nº Tarjeta: " . $_POST['nT'] . "<br>";
    ?>

    <form action="datos.php" method="POST">
        <input type="hidden" name="nombre" value="<?= $_POST['nombre']; ?>">
        <input type="hidden" name="apellidos" value="<?= $_POST['apellidos']; ?>">
        <input type="hidden" name="direccion" value="<?= $_POST['direccion']; ?>">
        <input type="hidden" name="nT" value="<?= $_POST['nT']; ?>">
        <button type="submit">Cancelar</button>
    </form>
    <form action="datos.php"></form>
    <button type="submit" name="inicio">Confirmar</button>