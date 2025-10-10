<?php 

?>

<form action="confirma.php" method="POST">
    Nºmatricula: <input type="text" name="nM" value=""><br>
    Curso: <input type="text" name="curso" value=""><br>
    Precio: <input type="text" name="precio" value=""><br>
    <input type="hidden" name="nombre" value="<?= $_POST['nombre']?>">
    <input type="hidden" name="apellidos" value="<?= $_POST['apellidos']?>">
    <button type="submit" name="enviar">Siguiente</button>
</form>