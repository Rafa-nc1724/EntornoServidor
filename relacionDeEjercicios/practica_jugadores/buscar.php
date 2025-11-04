<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form>
        <h1>Buscar Jugador</h1>
        Buscar por:<select name="buscar">
            <option value="equipo">Equipo</option>
            <option value="equipo">Posicion</option>
            <option value="equipo">DNI</option>
        </select><br>
        Valor a buscar:<input type="text" name="valor">
        <input type="submit" name="buscar" value="Buscar">
    </form>
    <input type="submit" name="menu" value="Menú">
</body>

</html>

<?php

try {
    if(isset($_POST['buscar'])){
        if(!empty($_POST['valor'])){
            echo "hola";
        }
    } else{

    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>