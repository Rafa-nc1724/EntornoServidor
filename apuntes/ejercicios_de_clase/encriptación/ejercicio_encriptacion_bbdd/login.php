<?php
if (isset($_GET['mensaje'])) {
    echo "<h3 class='mensaje exito'>" . $_GET['mensaje'] . "</h3>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .mensaje {
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
        }

        .exito {
            color: green;
        }
    </style>
</head>

<body>
    <form method="POST">
        Email: <input type="text" name="email" value='<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>'>
        Contraseña: <input type="password" name="pass" value='<?= isset($_COOKIE['pass']) ? $_COOKIE['pass'] : ''; ?>'><br>
        <input type="checkbox" name="record" <?= isset($_COOKIE['email']) ? "checked" : "" ?>>Recuerdame<br>
        <input type="submit" name="go" value="Acceder">
        <input type="submit" name="reg" value="Registrarase">
    </form>
</body>

</html>
<?php
try {
    $conex = new mysqli("localhost", "dwes", "abc123.", "usuarios");
    $conex->set_charset("utf8mb4");

    if (isset($_POST['go'])) {
        //variables
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        if (isset($_POST['record'])) {
            setcookie("email", $email);
            setcookie("pass", $pass);
            setcookie("ultimaVez", date("d-m-Y H:i:s"), time() + 3600);
        } else {
            setcookie("email", "", time() - 3600);
            setcookie("pass", "", time() - 3600);
        }
        /*
        primera query para ver si el email existe en la base de datos, 
        si es así compararemos las contraseñas.
        */
        $result = $conex->prepare("SELECT * FROM Datos WHERE email=?");
        $result->execute([$email]);

        if ($stmt = $result->get_result()) {
            while ($fila = $stmt->fetch_object()) {
                $pass2 = $fila->pass;
                if (password_verify($pass, $pass2)) {
                    session_start();
                    $_SESSION['usuario'] = $email;
                    header("Location: index.php");
                    exit;
                }
            }
        }
    }
    if (isset($_POST['reg'])) {
        header("Location: registro.php");
        exit;
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>