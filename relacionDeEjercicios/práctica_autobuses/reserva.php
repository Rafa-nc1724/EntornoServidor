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

                $result = $conex->query("SELECT DISTINCT v.origen  FROM viajes v; ");
                $result->execute();
                while ($fila = $result->fetchObject()) {
                    echo "<option>$fila->origen</option>";
                }

            ?>
        </select>
        Destino: <select class="block" name="destino">
            <?php
                $result = $conex->query("SELECT DISTINCT v.destino  FROM viajes v; ");
                $result->execute();
                while ($fila = $result->fetchObject()) {
                    echo "<option>$fila->destino</option>";
                }
            ?>
        </select>
        <input type="submit" name="consultar" value="Consultar">
        <input type="submit" name="menu" value="Menú">
    </form>


</body>

</html>
<?php
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
?>