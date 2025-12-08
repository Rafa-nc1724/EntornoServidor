<form method="POST">
    DNI: <input type="text" name="dni"><br>
    Clave: <input type="password" name="clave"><br>
    <input type="submit" name="iniciar" value="Inicio">
    <input type="submit" name="entrar" value="Entrar">
</form>
<?php
include_once "../controlador/ControladorCliente.php";

if(isset($_POST['iniciar'])){
    header("Location: index.php");
    exit;
}
if (isset($_POST['entrar'])) {
    $dni = $_POST['dni'];
    $clave = $_POST['clave'];

    $cliente = ControladorCliente::verificarCliente($dni, $clave);

    if ($cliente !== false && $cliente instanceof Cliente) {
        session_start();
        $_SESSION['cliente'] = [
            'dni'        => $cliente->getDni(),
            'nombre'     => $cliente->getNombre(),
            'apellidos'  => $cliente->getApellidos(),
            'direccion'  => $cliente->getDireccion(),
            'localidad'  => $cliente->getLocalidad(),
            'tipo'       => $cliente->getTipo()
        ];
        header("Location: index.php");
        exit;
    } else {
        echo "<p style='color:red'>DNI o clave incorrectos.</p>";
    }
}

?>
