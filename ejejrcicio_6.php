<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_6</title>
</head>

<body>
    <h2>Sumar los números enteros de 1 a 100 utilizando:</h2>
    <p>a) estructura (repetir)</p>
    <?php
    //Usando Do While 
    $num = 0;
    $n_act = 0;
    do{
        $num+=1;
        $n_act = $n_act + $num;
    } while($num<=99);
    echo $n_act;
    ?>

    <p>b) estructura (mientras)</p>
    <?php
    //Usando While
    $num = 0;
    $n_act = 0;

    while($num<=99){
        $num+=1;
        $n_act = $n_act + $num;
    }
    echo $n_act;
    ?>

    <p>c) estructura (para)</p>
    <?php
    //Usando for
    $num = 0;
    $n_act = 0;

    for ($i = 1; $i <= 100; $i++) {
        $num += 1;
        $n_act = $n_act + $num;
    }
    echo $n_act;
    ?>



</body>

</html>