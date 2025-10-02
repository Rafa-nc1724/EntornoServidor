<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_14</title>
</head>

<body>
    <h2>Ejercicio 14: Contar la Frecuencia de Elementos</h2>
    <h3>Objetivo: Implementar un algoritmo para contar cuántas veces aparece cada
        elemento en un array.</h3>
    <h3>Descripción:</h3>
    <p>1. Crea un array con algunos elementos repetidos.
        <br>2. Escribe un algoritmo que cuente la frecuencia de cada elemento.
        <br>3. Muestra el número de veces que aparece cada elemento.
    </p>

    <?php
    $a = array("rojo", "azul", "violeta", "rojo", "negro", "violeta", "amarillo", "azul", "verde", "rojo");

    //usando array_count_values() que la verdad que es mucho mas sencillo jeje
    echo "<br>=================== Usando array_count_values() =================<br>";
    $b = array_count_values($a);
    print_r($b);
    echo "<br>";
    // creando un algoritmo
    echo "<br>=================== Usando algoritmia =================<br>";

    $c=array();
    foreach($a as $valor){
        if(isset($c[$valor])){
            $c[$valor]++;
        } else {
            $c[$valor]=1;
        }
    }
    print_r($c);
    echo "<br><br>";
    foreach($c as $key=>$v){
        echo "El elemento ".$key." se repite ".$v." veces.<br>";
    }
    


    ?>

</body>

</html>