<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar</title>
</head>

<body>
    <h1><u>Modificar Jugador</u></h1>
    <form action="" method="POST">
        Buscar jugador(DNI):<input type="text" name="dni"><br>
        <input type="submit" name="menu" value="Menú">
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <?php

    ?>
    <!-- Esta parte aparece solo cuando el buscar jugador por dni existe-->
    <form action="" method="POST">
        Nombre:<input type="text" name="nombre"><br>
        DNI:<input type="text" name="dni"><br>
        Dorsal:<input type="number" name="dorsal"><br>
        Posicion:<br><select multiple="" name="posicion[]">
            <option value="portero">Portero</option>
            <option value="defensa">Defensa</option>
            <option value="centrocampista">Centrocampista</option>
            <option value="delantero">Delantero</option>
        </select><br>
        Equipo:<input type="text" name="equipo"><br>
        NºGoles:<input type="text" name="nGoles"><br>
        <input type="submit" name="cancelar" value="Cancelar">
        <input type="submit" name="modificar" value="Modificar">
    </form>
</body>

</html>