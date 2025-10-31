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
        Nombre:<input type="text" name="nombre"><?php ?><br>
        DNI:<input type="text" name="dni"><br>
        Dorsal:<select name="dorsal">
            <option selected disabled>Selecciona un dorsal</option>
            <?php
            for ($i = 1; $i < 11; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
            <h3 style="color: green;"></h3>
        </select><br>
        Posición:<br><select multiple="" name="posicion[]">
            <option value="portero">Portero</option>
            <option value="defensa">Defensa</option>
            <option value="centrocampista">Centrocampista</option>
            <option value="delantero">Delantero</option>
        </select><br>
        Equipo:<input type="text" name="equipo"><br>
        NºGoles:<input type="text" name="nGoles"><br>
        <input type="submit" name="insertar" value="Insertar">
        <input type="submit" name="menu" value="Menú">
    </form>
    
    <?php
    if(isset($_POST['insertar'])){
        
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
            $result=$stmt->get_result();
        
            if($stmt->affected_rows){
                echo "<h3 style='color: green'>Jugador Insertado en la Base de datos correctamente</h3>";
            } else{
                echo "<h3 style='color: red'>Fallo al insertar en la Base de Datos</h3>";
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    if(isset($_POST['menu'])){
        header('Location: index.php');
        exit;
    }

    ?>

</body>

</html>
<?php

?>