<?php

if (!isset($_POST['siguiente1'])) {
?>
    <form action="" method="POST">
        Nombre: <input type="text" name="nombre" value=""><br>
        Apellidos: <input type="text" name="apellidos" value=""><br>
        <button type="submit" name="siguiente1">Siguiente</button>
    </form>
<?php
} else if (!isset($_POST['siguiente2'])) {
?>
    <form action="" method="POST">
        Nºmatricula: <input type="text" name="nM" value=""><br>
        Curso: <input type="text" name="curso" value=""><br>
        Precio: <input type="text" name="precio" value=""><br>
        <input type="hidden" name="nombre" value="<?= $_POST['nombre'] ?>">
        <input type="hidden" name="apellidos" value="<?= $_POST['apellidos'] ?>">
        <input type="hidden" name="siguiente1" value="<?= $_POST['siguiente1'] ?>">
        <button type="submit" name="siguiente2">Siguiente</button>
    </form>
    <?php
    } else { ?>
        <form action="" method="POST">
            <?php
            echo "<h2>Datos:</h2>";
            echo "Nombre: " . $_POST['nombre'] . "<br>";
            echo "Apellidos: " . $_POST['apellidos'] . "<br>";
            echo "Número de Matrícula: " . $_POST['nM'] . "<br>";
            echo "Curso: " . $_POST['curso'] . "<br>";
            echo "Precio: " . $_POST['precio'] . "<br>";
            ?>
            <button type="submit" name="inicio">Inicio</button>
        </form>
<?php
    
}



?>