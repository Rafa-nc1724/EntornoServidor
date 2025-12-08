<?php
session_start();

include_once "../controlador/ControladorJuego.php";

// Obtener el código del juego desde GET o POST
$codigo = null;
if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
} elseif (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
}

// Si no hay código, volver al índice
if ($codigo === null) {
    header("Location: index.php");
    exit;
}


if (isset($_POST['volver'])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST['borrar'])) {
    ControladorJuego::borrarJuego($codigo);
    header("Location: index.php?msg=borrado");
    exit;
}

// Obtener datos del juego para mostrar información antes de borrar
$juego = ControladorJuego::getJuegoPorCodigo($codigo);


if (isset($_SESSION['cliente'])) {
    $cli = $_SESSION['cliente'];
    $nombreCompleto = $cli['nombre'] . " " . $cli['apellidos'];
    $tipo = ($cli['tipo'] === 'admin') ? '(administrador)' : '(cliente)';
    $saludo = "Hola $nombreCompleto $tipo";
} else {
    $saludo = "Hola invitado";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar juego</title>
</head>
<body>

<p><?php echo $saludo; ?></p>

<h2>Confirmar borrado del juego</h2>

<?php if ($juego): ?>
    <div>
        <p><strong>Código:</strong> <?php echo $juego->Codigo; ?></p>
        <p><strong>Nombre:</strong> <?php echo $juego->Nombre_juego; ?></p>
        <p><strong>Consola:</strong> <?php echo $juego->Nombre_consola; ?></p>
        <p><strong>Año:</strong> <?php echo $juego->Anno; ?></p>
        <p><strong>Precio:</strong> <?php echo $juego->Precio; ?> €</p>
        <p><strong>Descripción:</strong> <?php echo $juego->descripcion; ?></p>
        <p>
            <strong>Imagen:</strong><br>
            <img src="../<?php echo $juego->Imagen; ?>" alt="Imagen del juego" width="200">
        </p>
    </div>
    <p style="color:red; font-weight:bold;">¿Seguro que deseas borrar este juego?</p>
<?php else: ?>
    <p style="color:red">Juego no encontrado.</p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($codigo); ?>">
    <input type="submit" name="volver" value="Volver al inicio">
    <?php if ($juego): ?>
        <input type="submit" name="borrar" value="Borrar">
    <?php endif; ?>
</form>

</body>
</html>