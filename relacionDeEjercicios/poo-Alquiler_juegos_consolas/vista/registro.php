<?php
include_once "../controlador/ControladorCliente.php";

$mensaje = "";


if (isset($_POST['inicio'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['registrar'])) {

    $dni        = $_POST['dni'] ?? "";
    $nombre     = $_POST['nombre'] ?? "";
    $apellido   = $_POST['apellido'] ?? "";
    $direccion  = $_POST['direccion'] ?? "";
    $localidad  = $_POST['localidad'] ?? "";
    $clave      = $_POST['clave'] ?? "";

    $error = 0;

    // dni
    if (!preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
        $mensaje .= "<p style='color:red'>DNI incorrecto</p>";
        $error++;
    }

    // Nombre
    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30}$/', $nombre)) {
        $mensaje .= "<p style='color:red'>Nombre incorrecto</p>";
        $error++;
    }

    // Apellido
    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,50}$/', $apellido)) {
        $mensaje .= "<p style='color:red'>Apellido incorrecto</p>";
        $error++;
    }

    // dirección
    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]{1,50}$/', $direccion)) {
        $mensaje .= "<p style='color:red'>Dirección incorrecta</p>";
        $error++;
    }

    //localidad
    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/', $localidad)) {
        $mensaje .= "<p style='color:red'>Localidad incorrecta</p>";
        $error++;
    }


    if ($error === 0) {

        $ok = ControladorCliente::insertaCliente($dni, $nombre, $apellido, $direccion, $localidad, $clave);

        if ($ok) {

            header("Location: index.php");
            exit;
        } else {
            $mensaje .= "<p style='color:red'>No se pudo registrar el usuario.</p>";
        }
    }
}
?>

<form action="" method="POST">
    DNI: <input type="text" name="dni"><br>
    Nombre: <input type="text" name="nombre"><br>
    Apellido: <input type="text" name="apellido"><br>
    Dirección: <input type="text" name="direccion"><br>
    Localidad: <input type="text" name="localidad"><br>
    Clave: <input type="password" name="clave"><br>

    <input type="submit" name="inicio" value="Inicio">
    <input type="submit" name="registrar" value="Registrar">
</form>

<div>
    <?= $mensaje ?>
</div>