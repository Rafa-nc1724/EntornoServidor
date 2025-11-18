<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <form method="POST">
        DNI:<input type="text" name="dni" value="<?= ($_POST['dni'] ?? '') ?>">
        <?php
        if (isset($_POST['register'])) {
            if (empty($_POST['dni']) || !preg_match('/^[0-9]{8}[A-Z]$/', trim($_POST['dni']))) {
                echo "<span style='color:red'> El DNI no puede estar vacío y debe tener 8 números y una letra mayúscula </span>";
            }
        }
        ?><br>
        Nombre: <input type="text" name="name"><br>
        Apellidos: <input type="text" name="surname"><br>
        E-mail: <input type="text" name="email"><br>
        Contraseña: <input type="text" name="pass"><br>
        <input type="submit" name="login" value="Login">
        <input type="submit" name="register" value="Registrarse">
    </form>
</body>

</html>
<?php

try {
    $conex = new mysqli("localhost", "dwes", "abc123.", "usuarios");
    $conex->set_charset("utf8mb4");

    if (isset($_POST['register'])) {
        $dniValido = !empty($_POST['dni']) && preg_match('/^[0-9]{8}[A-Z]$/', trim($_POST['dni']));
        if ($dniValido) {

            //variables
            $dni = $_POST['dni'];
            $nombre = $_POST['name'];
            $apellidos = $_POST['surname'];
            $email = $_POST['email'];
            $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

            $result = $conex->prepare("INSERT INTO Datos (dni, Nombre, Apellidos, email, pass) VALUES (?,?,?,?,?)");
            $result->execute([$dni, $nombre, $apellidos, $email, $pass]);
            if ($result->affected_rows) {
                $msg = "Usuario registrado correctamente";
                header("Location: login.php?mensaje=$msg");
                exit;
            }
        }
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
if (isset($_POST['login'])) {
    header("Location: login.php");
    exit;
}
?>