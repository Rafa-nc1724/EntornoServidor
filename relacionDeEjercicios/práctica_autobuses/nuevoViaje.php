<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Viaje</title>
</head>

<body>
    <form action="" method="POST">
        Fecha: <input type="date" name="fecha"><br>
        Matrícula: <select name="matricula">
            <?php
            try {
                $db = 'mysql:host=localhost;dbname=autobuses;charset=utf8mb4';
                $opc = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_CASE => PDO::CASE_LOWER);
                $conex = new PDO($db, 'dwes', 'abc123.', $opc);

                $result = $conex->prepare("SELECT * FROM viajes");
                $result->execute();
                while ($fila = $result->fetchObject()) {
                    echo "<option name='$fila->matricula'>$fila->matricula</option>";
                }

            ?>
        </select><br>
        Origen:<input type="text" name="origen"><br>
        Destino:<input type="text" name="destino"><br>
        <input type="submit" name="add" value="Añadir">
        <input type="submit" name="menu" value="Menú">
    </form>

</body>

</html>
<?php
                if (isset($_POST['add'])) {
                    $fecha = $_POST['fecha'];
                    $matricula = $_POST['matricula'];
                    $origen = $_POST['origen'];
                    $destino = $_POST['destino'];

                    // Verificar si el autobús ya tiene viaje ese día
                    $result = $conex->prepare("SELECT * FROM viajes WHERE fecha=? AND matricula=?");
                    $result->execute([$fecha, $matricula]);

                    if ($result->rowCount() > 0) {
                        echo "<h2 style='color:red'>Este autobús está de viaje ese día</h2>";
                    } else {
                        // Obtener número de plazas del autobús
                        $query = $conex->prepare("SELECT num_plazas FROM autos WHERE matricula=?");
                        $query->execute([$matricula]);
                        $num = $query->fetchObject();

                        if ($num) {
                            $num_plazas = $num->num_plazas;

                            // Insertar nuevo viaje
                            $insert = $conex->prepare("INSERT INTO viajes(fecha,matricula,origen,destino,plazas_libres)
                                           VALUES (?,?,?,?,?)");
                            $insert->execute([$fecha, $matricula, $origen, $destino, $num_plazas]);

                            echo "<h2 style='color:green'>Viaje creado con éxito</h2>";
                        } else {
                            echo "<h2 style='color:red'>Error: la matrícula no existe en la tabla autos</h2>";
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
