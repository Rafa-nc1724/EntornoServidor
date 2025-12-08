<?php
if (isset($_COOKIE['intentos']) && $_COOKIE['intentos'] <= 0) {
    header("Location: intentos.php");
}
$nombre = false;
$apellido = false;
$direccion = false;
$localidad = false;
$usuario = false;
$clave = false;

if (isset($_POST['registrar'])) {
    if ($_POST['nombre'] != "") {
        $nombre = true;
    }

    if ($_POST['ape'] != "") {
        $apellido = true;
    }

    if ($_POST['dir'] != "") {
        $direccion = true;
    }

    if ($_POST['loc'] != "") {
        $localidad = true;
    }

    if ($_POST['usu'] != "") {
        $usuario = true;
    }

    if ($_POST['pass'] != "" && $_POST['passR'] != "" && $_POST['pass'] == $_POST['passR']) {
        $clave = true;
    }
}

if (isset($_POST['registrar']) && $nombre && $apellido && $direccion && $localidad && $usuario && $clave) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "gestionsesiones");
        try {
            $stmt = $conex->prepare("insert into usuario values(?,?,?,?,?,?,?,?,?,?)");
            $passCifrada = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $stmt->bind_param("ssssssssss",
                    $_POST['nombre'], $_POST['ape'], $_POST['dir'], $_POST['loc'], $_POST['usu'], $passCifrada, $_POST['cl'], $_POST['cf'], $_POST['tl'], $_POST['sl']);
            $stmt->execute();
            if ($stmt->affected_rows) {
                session_name("user");
                session_start();
                $_SESSION['nombre'] = $_POST['nombre'];
                $_SESSION['apellido'] = $_POST['ape'];
                $_SESSION['dir'] = $_POST['dir'];
                $_SESSION['loc'] = $_POST['loc'];
                $_SESSION['user'] = $_POST['user'];
                $_SESSION['cl'] = $_POST['cl'];
                $_SESSION['cf'] = $_POST['cf'];
                $_SESSION['tl'] = $_POST['tl'];
                $_SESSION['sl'] = $_POST['sl'];
                header("Location: inicio.php");
            }
        } catch (Exception $ex) {
            echo "Ese usuario ya existe";
        }
    } catch (mysqli_sql_exception $ex) {
        echo $ex->getMessage();
    }
}
?>

<form action="" method="post">
    Nombre: <input type="text" name="nombre"><br>
    Apellido: <input type="text" name="ape"><br>
    Direccion: <input type="text" name="dir"><br>
    Localidad: <input type="text" name="loc"><br>
    Usario: <input type="text" name="usu"><br>
    Clave: <input type="text" name="pass"><br>
    Repetir clave: <input type="text" name="passR"><br>

    Color de letra
    <select name="cl">
        <option value="red">Rojo</option>
        <option value="green">Verde</option>
        <option value="blue">Blue</option>
    </select><br>

    Color de fondo
    <select name="cf">
        <option value="red">Rojo</option>
        <option value="black">Negro</option>
        <option value="whithe">Blanco</option>
    </select><br>

    Tipo de letra
    <select name="tl">
        <option value="Inter">Inter</option>
        <option value="Montserrat">Montserrat</option>
        <option value="Roboto">Roboto</option>
    </select><br>

    Tamaño de letra
    <select name="sl">
        <option value="30px">pequeña</option>
        <option value="40px">mediana</option>
        <option value="50px">grande</option>
    </select><br>
    <br>


    <input type="submit" name="registrar" value="Registrarse">

</form>
<a href="index.php"><button>Cancelar</button></a>