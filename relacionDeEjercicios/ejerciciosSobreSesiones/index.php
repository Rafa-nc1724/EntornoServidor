<?php
if (!isset($_COOKIE['intentos'])) {
    setcookie("intentos", 10000);
}


if (isset($_COOKIE['intentos']) && $_COOKIE['intentos'] <= 0) {
    header("Location: intentos.php");
}

if (isset($_SESSION['user'])) {
    header("Location: inicio.php");
}

if (isset($_POST['login'])) {


    try {

        $conex = new mysqli("localhost", "dwes", "abc123.", "gestionsesiones");
        $stmt = $conex->prepare("select * from usuario where user=?");
        $stmt->bind_param("s", $_POST['user']);
        $stmt->execute();
        $resul = $stmt->get_result();
        if ($resul->num_rows) {
            $user = $resul->fetch_object();
            if (password_verify($_POST['pass'], $user->pass)) {
                session_name("user");
                session_start();
                $_SESSION['nombre'] = $user->nombre;
                $_SESSION['apellido'] = $user->apellidos;
                $_SESSION['dir'] = $user->direccion;
                $_SESSION['loc'] = $user->localidad;
                $_SESSION['user'] = $user->user;
                $_SESSION['cl'] = $user->color_letra;
                $_SESSION['cf'] = $user->color_fondo;
                $_SESSION['tl'] = $user->tipo_letra;
                $_SESSION['sl'] = $user->tam_letra;
                header("Location: inicio.php");
            } else {
                echo "COntraseña mal";
                setcookie("intentos", $_COOKIE['intentos'] - 1);
            }
        } else {
            echo "Usuario mal";
            setcookie("intentos", $_COOKIE['intentos'] - 1);
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>

<form action="" method="post">
    Usuario: <input type="text" name="user"><br>
    Contraseña: <input type="text" name="pass"><br>


    <input type="submit" name="login" value="Login">
</form>
<a href="registrar.php"><button>Registrarse</button></a>





