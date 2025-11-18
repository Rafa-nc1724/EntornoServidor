<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>

<body>
    <?php
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "usuarios");
        $conex->set_charset("utf8mb4");

        $email = $_SESSION['usuario'];
        $result = $conex->prepare("SELECT * FROM datos WHERE email=?");
        $result->bind_param("s", $email);
        $result->execute();
        $stmt = $result->get_result();
        if ($stmt->num_rows) {
            while ($fila = $stmt->fetch_object()) {
                if (isset($_COOKIE['ultimaVez'])) {
                    echo "Bienvenida/o $fila->Nombre $fila->Apellidos, tu último acceso fue: {$_COOKIE['ultimaVez']}";
                } else {
                    echo "Es la 1ª vez que entras, bienvenido/a $fila->Nombre $fila->Apellidos.";
                }
            }
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    ?>
    <form method="POST">
        <input type="submit" name="exit" value="Salir">
    </form>
    <?php
    if (isset($_POST['exit'])) {
        session_unset(); //elimina lo que hay en memoria de la sesion
        session_destroy();//elimina lo que hay en la sesión 
        header("Location: login.php");
        exit;
    }
    ?>
</body>

</html>