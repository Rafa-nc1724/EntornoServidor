<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_9</title>
</head>
<body>
    <h2>Ejercicio 9: Encontrar el Valor Máximo y Mínimo</h2>
    <h3>Objetivo: Implementar un algoritmo para encontrar el valor máximo y mínimo<br>
de un array sin usar las funciones integradas de PHP.</h3>
    <h3>Descripción:</h3>
    <p>1. Crea un array numérico con al menos 5 elementos.
<br>2. Escribe un algoritmo que recorra el array y determine el valor máximo y mínimo sin usar max() ni min().
<br>3. Muestra el valor máximo y mínimo.</p>
    <?php

    $numeros=array(5,23,78,66,13,90);
    $numero_minimo=$numeros[0];
    $numero_maximo=$numeros[0];
    
    foreach($numeros as $clave=>$valor){
        if ($valor>$numero_maximo) {
           $numero_maximo=$valor;
        }
        if($valor<$numero_minimo){
            $numero_minimo=$valor;
        }
    }

    echo "Número máximo ---> ".$numero_maximo."<br>";
    echo "Número mínimo ---> ".$numero_minimo."<br>";
    ?>

</body>
</html>