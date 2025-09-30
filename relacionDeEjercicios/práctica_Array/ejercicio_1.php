<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_1</title>
</head>

<body>
    <h3>Creación y Acceso a Elementos</h3>
    <h4>Objetivo: Practicar la creación y acceso a elementos de un array.</h4>
    <h4>Descripción:</h4>
    <p>
        1. Crea un array llamado $colores que contenga los colores "rojo",
        "verde", "azul", "amarillo".
        <br>2. Muestra el primer y el tercer elemento del array.
        <br>3. Agrega un nuevo color "naranja" al array.
        <br>4. Muestra todos los elementos del array usando un bucle for.</p>
    <?php
    $colores = array("rojo", "verde", "azul", "amarillo");
    echo $colores[1]."<br>";
    echo $colores[3]."<br>";

    echo "====================="."<br>";

    $colores []= "naranja"."<br>";

    echo "====================="."<br>";

    for($i = 0; $i<(count($colores));$i++){
        echo $colores[$i]." ";
    }
    
    
    ?>
</body>

</html>