<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logueo verificado</title>
</head>
<body>

    <?php
    if(isset($_COOKIE['nombre'])){
        echo "Hola ".$_COOKIE['nombre']." has logueado correctamente";
    }
    ?>
</body>
</html>