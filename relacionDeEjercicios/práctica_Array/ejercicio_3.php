<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_3</title>
</head>

<body>
    <h2>Ejercicio 3: Ordenación de Arrays</h3>
        <h3>Objetivo: Practicar la ordenación de arrays.</h3>
        <h3>Descripción:</h3>
        <p>
            1. Crea un array numérico llamado $numeros con los valores 3, 1, 4, 1, 5, 9.
            <br>2. Ordena el array en orden ascendente y muestra el resultado.
            <br>3. Ordena el array en orden descendente y muestra el resultado.
        </p>
        <?php
        //----------------------- 1)
        echo "<br>===================MOSTRAMOS ARRAY====================<br>";
        $numeros = array(3, 1, 4, 1, 5, 9);
        //----------------------- 2)
        print_r($numeros);
        echo "<br>";

        echo "<br>===================ORDENAMOS DE MANERA ASCENDENTE====================<br>";
        asort($numeros);
        print_r($numeros);
        echo "<br>";

        //----------------------- 3)
        echo "<br>====================ORDENAMOS DE MANERA DESCENDENTE===================<br>";
        print_r($numeros);
        echo "<br>";

        arsort($numeros);
        print_r($numeros);






        ?>
</body>

</html>