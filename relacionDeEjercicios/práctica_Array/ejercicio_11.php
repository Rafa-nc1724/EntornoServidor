<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_11</title>
</head>

<body>
    <h2>Ejercicio 11: Calcular el Promedio de un Array</h2>
    <h3>Objetivo: Practicar el uso de arrays, bucles y operadores aritméticos.</h3>
    <h3>Descripción:</h3>
    <p>1. Crea un array de números con al menos 5 elementos.
        <br>2. Escribe un algoritmo que calcule el promedio de los números en el array.
        <br>3. Muestra el promedio.
    </p>
    <?php
    $num=array(12,4325,78,212,4);

    function promedioArray(Array $array){
        $num=0;
        $cont=0;
        
        foreach($array as $key=>$valor){
            $num+=$valor;
            $cont++;
        }
        $prom=$num/$cont;
        echo "El promedio del Array dado es: ".$prom;
    }
    
    promedioArray($num);
    ?>
</body>

</html>