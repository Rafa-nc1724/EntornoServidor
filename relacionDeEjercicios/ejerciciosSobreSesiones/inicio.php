<?php
session_name("user");
session_start();

if (!isset($_COOKIE['user'])) {
    header("Location: index.php");
} else {
    ?>

<button><a href="cerrarSesion.php">Salir</a></button>
    <p>Bienvenido <?= $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?></p>
    <p><a href="mostrar.php">Ver mis datos</a></p>
    <p><a href="modificar.php">Modificar mis datos</a></p>

    <?php
}
