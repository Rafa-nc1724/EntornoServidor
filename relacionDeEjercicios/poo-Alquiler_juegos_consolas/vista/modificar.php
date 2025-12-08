<?php
session_start();
include_once "../controlador/ControladorJuego.php";
include_once "../modelo/Juego.php";

// Obtener código del juego
$codigoOriginal = $_GET['codigo'] ?? $_POST['codigo'] ?? null;

if ($codigoOriginal === null) {
    header("Location: index.php");
    exit;
}


if (isset($_POST['volver'])) {
    header("Location: index.php");
    exit;
}

// Obtener datos del juego
$juego = ControladorJuego::getJuegoPorCodigo($codigoOriginal);

if (!$juego) {
    echo "<p style='color:red'>Juego no encontrado.</p>";
    exit;
}


if (isset($_POST['modificar'])) {

    $nombre = trim($_POST['nombre']);
    $consola = trim($_POST['consola']);
    $anno = trim($_POST['anno']);
    $precio = trim($_POST['precio']);
    $imagenFinal = $juego->Imagen; // Por defecto mantenemos la misma imagen siempre y cuando no se le añada una nueva

    // Validaciones básicas
    if ($nombre === "" || $consola === "" || $anno === "" || $precio === "") {
        echo "<p style='color:red'>Todos los campos son obligatorios.</p>";
    } else {

        // Subida de nueva imagen si existe una
        if (!empty($_FILES['foto']['tmp_name'])) {

            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {

                $nombreFoto = time() . "-" . $_FILES['foto']['name'];
                $imagenBD = "imagenes/" . $nombreFoto;
                $rutaFísica = "../" . $imagenBD;

                move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFísica);

                $imagenFinal = $imagenBD;
            }
        }

        $descripcion = trim($_POST['descripcion']);

        // Generamos el neuvo código
        $codigoNuevo = strtoupper(substr($consola, 0, 3)) . "-" . strtoupper(substr($nombre, 0, 3));

        // creamos el nuevo objeto modificado
        $juegoMod = new Juego(
            $nombre,
            $consola,
            $anno,
            $precio,
            $imagenFinal,
            $descripcion
        );

        ControladorJuego::modificarJuego($juegoMod, $codigoOriginal);

        header("Location: index.php?msg=modificado");
        exit;
    }
}


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
    <title>Modificar juego</title>
</head>
<body>

<p><?php echo $saludo; ?></p>

<h2>Modificar juego</h2>

<form action="" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="codigo" value="<?php echo $codigoOriginal; ?>">

    Nombre: <input type="text" name="nombre" value="<?php echo $juego->Nombre_juego; ?>"><br><br>
    Consola: <input type="text" name="consola" value="<?php echo $juego->Nombre_consola; ?>"><br><br>
    Año: <input type="number" name="anno" value="<?php echo $juego->Anno; ?>"><br><br>
    Precio: <input type="number" step="0.01" name="precio" value="<?php echo $juego->Precio; ?>"><br><br>
    Descripción:<br>
    <textarea name="descripcion" rows="4" cols="40"><?php echo $juego->descripcion; ?></textarea><br><br>

    <p>Carátula actual:</p>
    <img src="../imagenes/<?php echo basename($juego->Imagen); ?>" width="120"><br><br>

    Nueva imagen (opcional):
    <input type="file" name="foto"><br><br>

    <input type="submit" name="volver" value="Volver">
    <input type="submit" name="modificar" value="Modificar">

</form>

</body>
</html>
