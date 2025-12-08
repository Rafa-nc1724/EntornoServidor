<?php
session_start();
include_once "../controlador/ControladorJuego.php";
include_once "../modelo/Juego.php";

// Saludo
if (isset($_SESSION['cliente'])) {
    $cli = $_SESSION['cliente'];
    $nombreCompleto = $cli['nombre'] . " " . $cli['apellidos'];
    $tipo = ($cli['tipo'] === 'admin') ? '(administrador)' : '(cliente)';
    $saludo = "Hola $nombreCompleto $tipo";
} else {
    $saludo = "Hola invitado";
}

$mensaje = "";


if (isset($_POST['volver'])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST['añadir'])) {

    $nombre = trim($_POST['nombre']);
    $consola = trim($_POST['consola']);
    $anno = trim($_POST['anno']);
    $precio = trim($_POST['precio']);
    $descripcion = trim($_POST['descripcion']);
    $imagenFinal = "";

    // Validación básica
    if ($nombre === "" || $consola === "" || $anno === "" || $precio === "" || empty($_FILES['foto']['tmp_name'])) {
        $mensaje = "<p style='color:red'>Todos los campos son obligatorios.</p>";
    } else {


        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {

            $nombreFoto = time() . "-" . $_FILES['foto']['name'];
            $imagenBD = "imagenes/" . $nombreFoto;
            $rutaFisica = "../" . $imagenBD;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFisica)) {
                $imagenFinal = $imagenBD;
            } else {
                $mensaje = "<p style='color:red'>Error al subir la imagen.</p>";
            }
        }

        // Si imagen subida correctamente
        if ($imagenFinal !== "") {

            $codigo = strtoupper(substr($consola, 0, 3)) . "-" . strtoupper(substr($nombre, 0, 3));

            $juegoNuevo = new Juego(
                $nombre,
                $consola,
                $anno,
                $precio,
                $imagenFinal,
                $descripcion
            );

            $ok = ControladorJuego::insertarJuego($juegoNuevo);

            if ($ok) {
                $mensaje = "<p style='color:green'>Juego añadido correctamente.</p>";
            } else {
                $mensaje = "<p style='color:red'>No se pudo añadir el juego.</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Juego</title>
</head>
<body>

<p><?php echo $saludo; ?></p>

<h2>Añadir nuevo juego</h2>

<?php echo $mensaje; ?>

<form action="" method="POST" enctype="multipart/form-data">

    Nombre: <input type="text" name="nombre"><br><br>

    Consola: <input type="text" name="consola"><br><br>

    Año: <input type="number" name="anno"><br><br>

    Precio: <input type="number" step="0.01" name="precio"><br><br>

    Carátula: <input type="file" name="foto"><br><br>

    Descripción:<br>
    <textarea name="descripcion" rows="4" cols="40"></textarea><br><br>

    <input type="submit" name="volver" value="Volver">
    <input type="submit" name="añadir" value="Añadir">

</form>

</body>
</html>