<?php
// Inicialización de variables
$nombre = $_POST['nombre'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$nT = $_POST['nT'] ?? '';

// Etapa actual (por defecto)
$etapa = 'datos';

// Control de flujo del formulario
if (isset($_POST['siguiente']) && $_POST['siguiente'] === 'datos') {
    $etapa = 'pedido';
} elseif (isset($_POST['siguiente']) && $_POST['siguiente'] === 'pedido') {
    $etapa = 'confirmacion';
} elseif (isset($_POST['atras']) && $_POST['atras'] === 'pedido') {
    $etapa = 'datos';
} elseif (isset($_POST['cancelar'])) {
    // Volver a la primera etapa, manteniendo los datos escritos
    $etapa = 'datos';
} elseif (isset($_POST['confirmar'])) {
    // Volver a la primera etapa, pero con todos los campos vacíos
    $etapa = 'datos';
    $nombre = $apellidos = $direccion = $nT = '';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Unificado</title>
</head>
<body>

<?php if ($etapa === 'datos'): ?>
    <h2>Datos personales</h2>
    <form method="POST">
        Nombre: <input type="text" name="nombre" value="<?= $nombre; ?>"><br>
        Apellidos: <input type="text" name="apellidos" value="<?= $apellidos; ?>"><br>
        <input type="hidden" name="direccion" value="<?= $direccion; ?>">
        <input type="hidden" name="nT" value="<?= $nT; ?>">
        <button type="submit" name="siguiente" value="datos">Siguiente</button>
    </form>

<?php elseif ($etapa === 'pedido'): ?>
    <h2>Datos de pedido</h2>
    <form method="POST">
        Dirección: <input type="text" name="direccion" value="<?= $direccion; ?>"><br>
        Nº Tarjeta: <input type="text" name="nT" value="<?= $nT; ?>"><br>
        <input type="hidden" name="nombre" value="<?= $nombre; ?>">
        <input type="hidden" name="apellidos" value="<?= $apellidos; ?>">
        <button type="submit" name="siguiente" value="pedido">Siguiente</button>
        <button type="submit" name="atras" value="pedido">Atrás</button>
    </form>

<?php elseif ($etapa === 'confirmacion'): ?>
    <h2>Confirmación de datos</h2>
    <p><strong>Nombre:</strong> <?= $nombre; ?></p>
    <p><strong>Apellidos:</strong> <?= $apellidos; ?></p>
    <p><strong>Dirección:</strong> <?= $direccion; ?></p>
    <p><strong>Nº Tarjeta:</strong> <?= $nT; ?></p>

    <form method="POST">
        <input type="hidden" name="nombre" value="<?= $nombre; ?>">
        <input type="hidden" name="apellidos" value="<?= $apellidos; ?>">
        <input type="hidden" name="direccion" value="<?= $direccion; ?>">
        <input type="hidden" name="nT" value="<?= $nT; ?>">
        <button type="submit" name="cancelar">Cancelar</button>
        <button type="submit" name="confirmar">Confirmar</button>
    </form>
<?php endif; ?>

</body>
</html>