<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_2</title>
</head>
<body>
    <table>
        <?php
            $n_rand = rand(0,100);
            if($n_rand % 2 == 0) $n_rand ++;
            echo $n_rand;
        ?>
    </table>

</body>
</html>
