<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_8</title>
</head>

<body>
    <h2>Ejercicio 8: Buscar en un Array</h2>
    <h3>Objetivo: Practicar la búsqueda de valores en un array.</h3>
    <h3>Descripción:</h3>
    <p>1. Crea un array numérico llamado $edades con los valores 20, 30, 40, 25,35.
        <br>2. Usa la función array_search() para encontrar la posición de la edad 25 en el array.
        <br>3. Si el valor existe, muestra la posición, de lo contrario muestra un mensaje indicando que no se encontró.
    </p>
    <?php
    // 1. Crea un array numérico llamado $edades con los valores 20, 30, 40, 25,35.
    $edades = array(20, 30, 40, 25, 35);

    // 2. Usa la función array_search() para encontrar la posición de la edad 25 en el array.
    // 3. Si el valor existe, muestra la posición, de lo contrario muestra un mensaje indicando que no se encontró.
    echo "<br>================ USANDO array_search() ================<br>";
    if ($clave = array_search(25, $edades)) {
        echo "La clave de la edad 25 es " . $clave;
    } else {
        echo "La clave no se encontró";
    }




    
    ?>

</body>

</html>