<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_8</title>
</head>
<body>
    <h2>Calcule la suma de los 100 primeros números enteros pares</h2>
    <?php
    $num = 0;
    $n_act = 0;

    for ($i = 1; $i <= 100; $i++) {
        $num += 2;
        $n_act = $n_act + $num;
    }
    echo $n_act;
    ?>
</body>
</html>