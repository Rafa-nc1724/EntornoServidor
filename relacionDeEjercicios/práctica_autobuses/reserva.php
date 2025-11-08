<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reserva</title>
    <style>
        .block {
            display: block;
        }
    </style>
</head>

<body>
    <form method="POST">
        Fecha: <input class="block" type="date" name="fecha">
        Origen: <select class="block" name="origen">
            <?php
            try {

                $db = 'mysql:host=localhost;dbname=autobuses;charset=utf8mb4';
                $opc = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_CASE => PDO::CASE_LOWER);
                $conex = new PDO($db, 'dwes', 'abc123.', $opc);

                $result = $conex->query("SELECT origen AS lugar
                                            FROM viajes
                                            UNION
                                            SELECT destino AS lugar
                                            FROM viajes
                                            ORDER BY lugar;");
                $result->execute();
                while ($fila = $result->fetchObject()) {
                    echo "<option>$fila->lugar</option>";
                }

            ?>
        </select>
        Destino: <select class="block" name="destino">
            <?php
                $result = $conex->query("SELECT origen AS lugar
                                            FROM viajes
                                            UNION
                                            SELECT destino AS lugar
                                            FROM viajes
                                            ORDER BY lugar;");
                $result->execute();
                while ($fila = $result->fetchObject()) {
                    echo "<option>$fila->lugar</option>";
                }
            ?>
        </select>
        <input type="submit" name="consultar" value="Consultar">
        <input type="submit" name="menu" value="Menú">
    </form>


</body>

</html>
<?php

                if (isset($_POST['consultar'])) {
                    $fecha = $_POST['fecha'];
                    $origen = $_POST['origen'];
                    $destino = $_POST['destino'];
                    if ($origen == $destino) {
                        echo "<h2 style='color: red'>El origen y el destino no pueden ser iguales</h2>";
                    } else {
                        $result = $conex->prepare("SELECT * FROM viajes v 
                                                WHERE v.Fecha=? 
                                                AND v.Origen=? 
                                                AND v.Destino=?");
                        $result->bindParam(1, $fecha);
                        $result->bindParam(2, $origen);
                        $result->bindParam(3, $destino);
                        $result->execute();
                        if ($result->rowCount() > 0) {
                            while ($fila = $result->fetchObject()) {
                                echo "Fecha: $fila->fecha<br>";
                                echo "Origen: $fila->origen<br>";
                                echo "Destino: $fila->destino<br>";
                                echo "Plazas disponibles: $fila->plazas_libres<br>";
                                echo "<form method='POST'>";
                                echo "Nº Plazas a reservar: <input class='block' type='text' name='nPlazas'>";
                                echo "<input type='submit' name='reservar' value='Reservar'>";
                                echo "<input type='hidden' name='fecha' value='$fila->fecha'>";
                                echo "<input type='hidden' name='origen' value='$fila->origen'>";
                                echo "<input type='hidden' name='destino' value='$fila->destino'>";
                                echo "</form>";
                            }
                        } else {
                            echo "<h2 style='color: red'>No hay ningún viaje desde $origen hasta $destino el $fecha.</h2>";
                        }
                    }
                }
                if (isset($_POST['reservar'])) {
                    $fecha = $_POST['fecha'];
                    $origen = $_POST['origen'];
                    $destino = $_POST['destino'];
                    $nPlazas = $_POST['nPlazas'];
                    $result = $conex->prepare("SELECT * FROM viajes v 
                                                WHERE v.Fecha=? 
                                                AND v.Origen=? 
                                                AND v.Destino=?");
                    $result->bindParam(1, $fecha);
                    $result->bindParam(2, $origen);
                    $result->bindParam(3, $destino);
                    $result->execute();
                    if ($result->rowCount() > 0) {
                        while ($fila = $result->fetchObject()) {

                            if ($fila->plazas_libres >= $nPlazas) {
                                $result = $conex->prepare("UPDATE viajes 
                                                        SET Plazas_libres=? 
                                                        WHERE Matricula =? AND Fecha=?");
                                $plazas_restantes = $fila->plazas_libres - $nPlazas;
                                $result->bindParam(1, $plazas_restantes);
                                $result->bindParam(2, $fila->matricula);
                                $result->bindParam(3, $fila->fecha);
                                $result->execute();
                                if ($result->rowCount() > 0) {
                                    echo "<h2 style='color: green'>Ha reservado $nPlazas plazas para ir desde $origen hasta $destino el $fecha.</h2>";
                                }
                            } else {
                                echo "<h2 style='color: red'>Nº de plazas a reservar mayor que las plazas disponibles</h2>";
                            }
                        }
                    }
                }
                if (isset($_POST['menu'])) {
                    header("Location: menu.php");
                    exit;
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
?>