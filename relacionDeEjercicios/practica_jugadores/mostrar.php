<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Jugador</title>
</head>
<body>
    <h1>Mostrar Jugadores</h1>
    <form action="index.php" method="POST">
    <?php
     try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
        $conex->set_charset("utf8mb4");
        $result = $conex->query("select * from datos");
        if($result->num_rows){
            while ($fila = $result->fetch_object()){
                echo "Nombre: ".$fila->nombre."<br>";
                echo "DNI: ".$fila->dni."<br>";
                echo "Dorsal: ".$fila->dorsal."<br>";
                echo "Posicion: ".$fila->posicion."<br>";
                echo "Equipo: ".$fila->equipo."<br>";
                echo "NºGoles: ".$fila->nGoles."<br>";
                echo"=================<br><br>";
            }
        }else{
            echo "No hay datos";
        }
    } catch (mysqli_sql_exception $ex) {
        echo $ex->getMessage();
    }
    ?>
    <input type="submit" name="menu" value="Menú">
    </form>
</body>
</html>