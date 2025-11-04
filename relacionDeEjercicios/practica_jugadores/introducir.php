<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar_Jugador</title>
</head>

<body>
    <h1>Insertar Jugador</h1>
    <form action="" method="POST">
        Nombre:<input type="text" name="nombre"><?php if ((isset($_POST['insertar']) && empty($_POST['nombre'])) || (isset($_POST['insertar']) && !preg_match('/^[a-zA-Z]$/', $_POST['nombre']))) echo "<span style='color:red'>El nombre no puede estar vacío y solo pueden ser letras</span>"; ?><br>
        DNI:<input type="text" name="dni"><?php if((isset($_POST['insertar']) && empty($_POST['dni'])) || (isset($_POST['insertar']) && (!preg_match('/^[0-9]{8}[A-Z]$/',$_POST['dni']))) ) echo "<span style='color:red'>El dni no puede estar vacío y tiene que ser de 8 números y una letra mayúscula</span>"; ?><br>
        Dorsal:<select name="dorsal">
            <option selected disabled>Selecciona un dorsal</option>
            <?php
            for ($i = 1; $i < 11; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select><br>
        Posición:<br><select multiple="" name="posicion[]">
            <option value="portero">Portero</option>
            <option value="defensa">Defensa</option>
            <option value="centrocampista">Centrocampista</option>
            <option value="delantero">Delantero</option>
        </select><br>
        Equipo:<input type="text" name="equipo"><?php if(isset($_POST['insertar']) && empty($_POST['equipo'])) echo"<span style='color:red'>El Equipo no puede estar vacío</span>"; ?><br>
        NºGoles:<input type="text" name="nGoles"><?php if(isset($_POST['insertar']) && !preg_match('/^[0-9]{0,999}$/',$_POST['nGoles'])) echo"<span style=color:red>Los Goles solo pueden ser números</span>"; ?><br>
        <input type="submit" name="insertar" value="Insertar">
        <input type="submit" name="menu" value="Menú">
    </form>

    <?php
    if (isset($_POST['insertar'])) {
    }
    if (isset($_POST['insertar'])) {
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
            $conex->set_charset("utf8mb4");
            $stmt = $conex->prepare("INSERT INTO datos (nombre, dni, dorsal, posicion, equipo, nGoles) VALUES (?,?,?,?,?,?)");

            $nombre = $_POST['nombre'];
            $dni = $_POST['dni'];
            $dorsal = $_POST['dorsal'];
            $posicion = implode(',', $_POST['posicion']);
            $equipo = $_POST['equipo'];
            $nGoles = $_POST['nGoles'];

            $stmt->execute([$nombre, $dni, $dorsal, $posicion, $equipo, $nGoles]);
            $result = $stmt->get_result();

            if ($stmt->affected_rows > 0) {
                //Se ha metido el jugador
                header("Location: index.php?mensaje=Jugador inscrito correctamente&tipo=exito");
                exit;
            } else {
                //Fallo sin cambios
                header("Location: index.php?mensaje=No se pudo insertar el jugador&tipo=error");
                exit;
            }
        } catch (mysqli_sql_exception $ex) {
            //Error que me manda el sql capturado
            $error = urlencode("Error al insertar: " . $ex->getMessage());
            header("Location: index.php?mensaje=$error&tipo=error");
            exit;
        }
    }
    if (isset($_POST['menu'])) {

        header('Location: index.php');
        exit;
    }

    ?>

</body>

</html>
<?php

?>