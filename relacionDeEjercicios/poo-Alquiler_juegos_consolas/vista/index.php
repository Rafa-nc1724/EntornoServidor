<?php
session_start();
include_once "../controlador/ControladorJuego.php";
include_once "../controlador/ControladorCliente.php";

if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'alquilado') {
        echo "<p style='color:green'>Juego alquilado correctamente</p>";
    } elseif ($_GET['msg'] === 'error_alquiler') {
        echo "<p style='color:red'>El juego ya está alquilado</p>";
    } elseif ($_GET['msg'] === 'borrado') {
        echo "<p style='color:green'>Juego borrado exitosamente.</p>";
    } elseif ($_GET['msg'] === 'modificado') {
        echo "<p style='color:green'>Juego modificado correctamente.</p>";
    }
}
?>

    <a href="login.php">Login</a>
    <a href="registro.php">Registro</a>
    <br><br>

<?php
//si no se ha iniciado la sesión mostrar solo los juegos
if (!isset($_SESSION['cliente'])) {
    ControladorJuego::muestraJuegos();
    exit;
}

//si si se ha iniciado mostrar el saludo
$cliente = $_SESSION['cliente'];
$nombre = $cliente['nombre'] . " " . $cliente['apellidos'];
$tipo = ($cliente['tipo'] === 'admin') ? '(administrador)' : '(cliente)';

echo "<p>Hola $nombre $tipo</p>";

//botones para cliente o admin
echo "<form method='POST'>";
echo "<input type='submit' name='verTodos' value='Ver todos'>";
echo "<input type='submit' name='alquilados' value='Alquilados'>";
echo "<input type='submit' name='noAlquilados' value='No alquilados'>";
echo "<input type='submit' name='misJuegos' value='Mis juegos'>";

if ($cliente['tipo'] === 'admin') {
    echo "<input type='submit' name='nuevoJuego' value='Nuevo juego'>";
}

echo "</form><br>";


//botones funcionalidades
if (isset($_POST['borrar']) && isset($_POST['codigo'])) {
    header("Location: borrar.php?codigo=" . $_POST['codigo']);
    exit;
}
elseif (isset($_POST['modificar']) && isset($_POST['codigo'])) {
    header("Location: modificar.php?codigo=" . $_POST['codigo']);
    exit;
}
if (isset($_POST['verTodos'])) {
    ControladorJuego::muestraJuegos();
}
elseif (isset($_POST['alquilados'])) {
    ControladorJuego::muestraJuegosAlquilados();
}
elseif (isset($_POST['noAlquilados'])) {
    ControladorJuego::muestraJuegosNoAlquilados();
}
elseif (isset($_POST['misJuegos'])) {
    header("Location: misjuegos.php");
    exit;
}
elseif (isset($_POST['nuevoJuego']) && $cliente['tipo'] === 'admin') {
    header("Location: nuevo.php");
    exit;
}
else {
    //si no pulsan ninguno simepre mostrammos todos los juegos
    ControladorJuego::muestraJuegos();
}
?>