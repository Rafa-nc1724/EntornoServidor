<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_4</title>
</head>
<body>
<h2>Ejercicio 4: Contar Elementos de un Array</h2>
<h3>Objetivo: Practicar el uso de la función count().</h3>
<h3>Descripción:</h3>
<p>1. Crea un array llamado $animales con los valores "gato", "perro", "elefante", "jirafa".
<br>2. Muestra el número de elementos en el array.
<br>3. Añade dos animales más al array.
<br>4. Muestra el número actualizado de elementos.</p>
    <?php
    echo "<br>A)========================CREAMOS EL ARRAY====================<br>";
    $animales = array("gato", "perro","elefante","jirafa");
    print_r($animales);
    echo "<br>";

    echo "<br>B)========================MOSTRAMOS EL NÚMERO DE ELEMENTOS DEL ARRAY====================<br>";
    echo count($animales);
    echo "<br>";

    echo "<br>C)========================AÑADIMOS DOS ANIMALES MÁS AL ARRAY====================<br>";
    $animales []="leon";
    $animales[]="tigre";
    print_r($animales);
    echo "<br>";
    echo count($animales); 
    ?>
</body>
</html>