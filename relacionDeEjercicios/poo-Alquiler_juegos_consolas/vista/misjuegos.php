<?php
session_start();
include_once "../modelo/Conexion.php";
include_once "../controlador/ControladorAlquiler.php";

if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit;
}

$cli = $_SESSION['cliente'];
$mensaje = "";

// Saludo
$nombreCompleto = $cli['nombre'] . " " . $cli['apellidos'];
$tipo = ($cli['tipo'] === 'admin') ? '(administrador)' : '(cliente)';
$saludo = "Hola $nombreCompleto $tipo";

// Procesar devolución con el controlador (MVC)
if (isset($_POST['devolver']) && isset($_POST['id_alquiler'])) {

    $resultado = ControladorAlquiler::devolver((int)$_POST['id_alquiler'], $cli['dni']);

    if ($resultado !== false) {
        header(
                "Location: misjuegos.php?msg=devuelto" .
                "&precio={$resultado['precioSemana']}" .
                "&recargo={$resultado['recargo']}" .
                "&dias={$resultado['dias']}" .
                "&total={$resultado['total']}"
        );
        exit;
    } else {
        $mensaje = "Error al procesar la devolución.";
    }
}

// Mostrar mensaje al volver tras devolución
if (isset($_GET['msg']) && $_GET['msg'] === 'devuelto') {
    $precio = htmlspecialchars($_GET['precio']);
    $recargo = htmlspecialchars($_GET['recargo']);
    $dias = htmlspecialchars($_GET['dias']);
    $total = htmlspecialchars($_GET['total']);

    $mensaje = "Juego devuelto correctamente - Coste alquiler (1 semana): {$precio} €, 
                Retraso: {$dias} días ({$recargo} €), Total: {$total} €.";
}

// Obtener lista de alquileres mediante el controlador
$resLista = ControladorAlquiler::getAlquileresCliente($cli['dni']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis juegos</title>
</head>
<body>

<p><?php echo $saludo; ?></p>

<p><a href="index.php">Salir</a></p>

<?php
if ($mensaje !== "") {
    echo "<p style='color:blue'>{$mensaje}</p>";
}
?>

<h2>Mis Juegos (historial de alquileres)</h2>

<?php if ($resLista->num_rows === 0): ?>
    <p>No tienes juegos alquilados ni historial disponible.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Carátula</th>
            <th>Nombre</th>
            <th>Consola</th>
            <th>Año</th>
            <th>Fecha de alquiler</th>
            <th>Fecha prevista devolución</th>
            <th>Fecha devolución</th>
            <th>Acción</th>
            <th>Precio (1 semana)</th>
            <th>Dinero abonado</th>
        </tr>

        <?php while ($fila = $resLista->fetch_assoc()): ?>

            <?php
            // Fecha de alquiler
            $fechaAlqStr = $fila['Fecha_alquiler'] ?? null;
            $fechaAlq = $fechaAlqStr ? new DateTime($fechaAlqStr) : null;

            // Fecha prevista → +7 días
            $fechaPrev = $fechaAlq ? clone $fechaAlq : new DateTime();
            $fechaPrev->modify("+7 days");
            $fechaPrevStr = $fechaPrev->format("Y-m-d");

            // Fecha devolución (puede ser null)
            $fechaDevolStr = $fila['Fecha_devol'] ?? null;
            $dineroAbonadoStr = "-";

            if (!empty($fechaDevolStr)) {
                $fechaDev = new DateTime($fechaDevolStr);
                $fechaDevolStr = $fechaDev->format("Y-m-d");

                // Retraso
                $diasRetraso = $fechaDev > $fechaPrev ? $fechaDev->diff($fechaPrev)->days : 0;

                // Cálculo total
                $precioSemana = (float)$fila['Precio'];
                $recargo = $diasRetraso * 1.0;
                $total = $precioSemana + $recargo;

                $dineroAbonadoStr = number_format($total, 2, ".", "") . " €";
            } else {
                $fechaDevolStr = "-";
            }
            ?>

            <tr>
                <td><img src="../<?php echo htmlspecialchars($fila['Imagen']); ?>" width="80"></td>
                <td><?php echo htmlspecialchars($fila['Nombre_juego']); ?></td>
                <td><?php echo htmlspecialchars($fila['Nombre_consola']); ?></td>
                <td><?php echo htmlspecialchars($fila['Anno']); ?></td>
                <td><?php echo htmlspecialchars($fechaAlq ? $fechaAlq->format("Y-m-d") : "-"); ?></td>
                <td><?php echo htmlspecialchars($fechaPrevStr); ?></td>
                <td><?php echo htmlspecialchars($fechaDevolStr); ?></td>

                <td>
                    <?php if ($fechaDevolStr === "-"): ?>
                        <form method="post">
                            <input type="hidden" name="id_alquiler" value="<?php echo (int)$fila['id']; ?>">
                            <input type="submit" name="devolver" value="Devolver">
                        </form>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

                <td><?php echo number_format((float)$fila['Precio'], 2, ".", ""); ?> €</td>
                <td><?php echo $dineroAbonadoStr; ?></td>
            </tr>

        <?php endwhile; ?>

    </table>
<?php endif; ?>

</body>
</html>