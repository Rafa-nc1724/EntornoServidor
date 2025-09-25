<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_9</title>
</head>
<body>
    <h2>Ordena tres números de mayor a menor</h2>
    <?php
    $n_1= 2;
    $n_2= 3;
    $n_3= 11;
    $n_null=0;

    while($n_1<$n_2 || $n_2<$n_3 || $n_1<$n_3){
        if($n_1<$n_2){
            $n_null=$n_2;
            $n_2=$n_1;
            $n_1=$n_null;
        }
        if($n_2<$n_3){
            $n_null=$n_3;
            $n_3=$n_2;
            $n_2=$n_null;
        }
    }
/**
 * null=2
 * n2=10
 * n1=2
 */

    echo "Los números ordenados de mayor a menor son:  $n_1 , $n_2 , $n_3";
    ?>
</body>
</html>