<?php
session_start();
include_once "../controlador/ControladorJuego.php";

if (!isset($_GET['codigo'])) {
    header("Location: index.php");
    exit;
}

$codigo = $_GET['codigo'];
$juego = ControladorJuego::getJuegoPorCodigo($codigo);

// Si juego no existe
if (!$juego) {
    echo "Juego no encontrado";
    exit;
}

// Procesar botón volver
if (isset($_POST['volver'])) {
    header("Location: index.php");
    exit;
}

// Procesar alquiler
$mensaje = "";
if (isset($_POST['alquilar'])) {

    // Si no hay sesión → ir a login
    if (!isset($_SESSION['cliente'])) {
        header("Location: login.php");
        exit;
    }

    $dni = $_SESSION['cliente']['dni'];
    $ok = ControladorJuego::alquilarJuego($codigo, $dni);

    if ($ok) {
        header("Location: index.php?msg=alquilado");
        exit;
    } else {
        header("Location: index.php?msg=error_alquiler");
        exit;
    }
}

// COMPROBAR DISPONIBILIDAD
$estado = ControladorJuego::comprobarDisponibilidad($codigo);

$disponible = ($estado === "disponible");
$fechaPrevista = "";

if (!$disponible) {
    // estado contiene fecha_alquiler
    $fechaA = new DateTime($estado);
    $fechaA->modify("+7 days");
    $fechaPrevista = $fechaA->format("Y-m-d");
}

// SALUDO
if (isset($_SESSION['cliente'])) {
    $cli = $_SESSION['cliente'];
    $saludo = "Hola " . $cli['nombre'] . " " . $cli['apellidos'] .
        " (" . $cli['tipo'] . ")";
} else {
    $saludo = "Hola invitado";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del juego</title>
</head>
<body>

<p><?= $saludo ?></p>

<h2>Detalle del juego</h2>

<?= $mensaje ?>

<p><strong>Código:</strong> <?= $juego->Codigo ?></p>
<p><strong>Nombre:</strong> <?= $juego->Nombre_juego ?></p>
<p><strong>Consola:</strong> <?= $juego->Nombre_consola ?></p>
<p><strong>Año:</strong> <?= $juego->Anno ?></p>
<p><strong>Precio:</strong> <?= $juego->Precio ?> €</p>
<p><strong>Descripción:</strong> <?= $juego->descripcion ?></p>

<p><strong>Estado:</strong>
    <?php if ($disponible): ?>
        Disponible para alquilar
    <?php else: ?>
        Alquilado — disponible el día <?= $fechaPrevista ?>
    <?php endif; ?>
</p>

<p><img src="../<?= $juego->Imagen ?>" width="200"></p>

<form method="POST">
    <input type="hidden" name="codigo" value="<?= $codigo ?>">

    <input type="submit" name="volver" value="Volver al inicio">

    <input type="submit"
           name="alquilar"
           value="Alquilar"
        <?= $disponible ? "" : "disabled" ?>>
</form>

</body>
</html>