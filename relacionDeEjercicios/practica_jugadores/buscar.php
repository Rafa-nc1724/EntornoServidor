<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <h1>Buscar Jugador</h1>
        Buscar por:<select name="campo">
            <option value="equipo">Equipo</option>
            <option value="posicion">Posicion</option>
            <option value="dni">DNI</option>
        </select><br>
        Valor a buscar:<input type="text" name="valor">
        <input style="display: block" type="submit" name="buscar" value="Buscar">
        <input style="display: block" type="submit" name="menu" value="Menú">
    </form>
    
</body>

</html>

<?php

try {
    if (isset($_POST['buscar'])) {
        if (!empty($_POST['valor'])) {
            $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
            $conex->set_charset("utf8mb4");
            //echo "<h1>hola</h1>";

            $buscar = $_POST['campo'];
            $valor = $_POST['valor'];
            $columnas_permitidas = ['equipo', 'posicion', 'dni'];
            if (in_array($buscar, $columnas_permitidas)) {
                if ($buscar === 'posicion') {
                    $sql = "SELECT * FROM datos WHERE FIND_IN_SET(?, posicion)";
                } else {
                    $sql = "SELECT * FROM datos WHERE $buscar=?";
                }
                $stmt = $conex->prepare($sql);
                $stmt->bind_param("s", $valor);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($fila = $result->fetch_object()) {
                        echo "Nombre: " . $fila->nombre . "<br>";
                        echo "DNI: " . $fila->dni . "<br>";
                        echo "Dorsal: " . $fila->dorsal . "<br>";
                        echo "Posicion: " . $fila->posicion . "<br>";
                        echo "Equipo: " . $fila->equipo . "<br>";
                        echo "NºGoles: " . $fila->nGoles . "<br>";
                        echo "=================<br><br>";
                    }
                } else {
                    echo "<h2 style='color:red'>No se encuentra ningún Jugador con $buscar $valor</h2>";
                }
            }
        }
    }
    if (isset($_POST['menu'])) {

        header('Location: index.php');
        exit;
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>