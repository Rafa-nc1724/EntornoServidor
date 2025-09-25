<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_7</title>
</head>

<body>
    <h2>Calcular la suma de los cuadrados de los 100 primeros números enteros.</h2>

    <?php
    //Usando Do While 
    $num = 1;
    $n_act = 0;
    $cont=0;

    do {

        $n_act = $n_act + pow($num,2);
        $num++;
        $cont++;
    } while ($cont <=99);
    echo $n_act;
    ?>



    <!-- 
    (1*1)+(2*2)+(3*3)
    -->
</body>

</html>