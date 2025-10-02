<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_6</title>
</head>

<body>
    <h2>Ejercicio 6: Funciones de Arrays</h2>
    <h3>Objetivo: Practicar el uso de funciones integradas para manipular arrays.</h3>
    <h3>Descripción:</h3>
    <p>1. Crea un array llamado $nombres con los valores "Ana", "Luis", "Carlos",
        "Maria".
        <br>2. Usa la función array_reverse() para mostrar los nombres en orden
        inverso.
        <br>3. Usa la función in_array() para comprobar si "Carlos" está en el array.
        <br>4. Usa la función array_push() para agregar "Juan" al final del array y
        muestra el array actualizado.
    </p>

    <?php
    // creo el array 
    $nombre = array("Ana", "Luis", "Carlos", "Maria");

    // usando la function arry_reverse()
    $nombre_inverso = array_reverse($nombre);

    echo "================ ARRAY NORMAL ===================<br>";

    foreach ($nombre as $clave => $valor) {
        echo $valor." ";
    }

    echo "<br>================ ARRAY INVERSO ===================<br>";

    foreach ($nombre_inverso as $clave => $valor) {
        echo $valor." ";
    }

    // usando la funtion in_array();
    echo "<br>================ COMPROBAR CON (in_array) ===================<br>";
    if (in_array("Carlos", $nombre)) {
        echo "Carlos está dentro del array";
    } else {
        echo "Carlos noestá en el array";
    }

    // usando array_push
    echo "<br>================ AGRREGAR AL FINAL CON (aray_push()) ===================<br>";
    array_push($nombre, "Juan");
    foreach ($nombre as $clave => $valor) {
        echo $valor." ";
    }
    ?>

</body>

</html>