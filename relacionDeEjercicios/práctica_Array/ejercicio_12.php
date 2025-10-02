<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio_12</title>
</head>

<body>
    <h2>Ejercicio 12: Suma de Todos los Elementos</h2>
    <h3>Objetivo: Implementar un algoritmo para calcular la suma de todos los
        elementos de un array.</h3>
    <h3>Descripción:</h3>
    <p>1. Crea un array numérico con al menos 5 elementos.
        <br>2. Escribe un algoritmo que recorra el array y sume todos los elementos.
        <br>3. Muestra el resultado de la suma.
    </p>
    <?php
    $num=array(12,4325,78,212,4);
    function sumaArray(Array $array){
        $num=0;
        
        foreach($array as $key=>$valor){
            $num+=$valor;
            
        }
        
        echo "La suma del Array dado es: ".$num;
    }
    sumaArray($num);
    ?>
</body>

</html>