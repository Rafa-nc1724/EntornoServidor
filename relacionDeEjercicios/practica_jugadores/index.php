<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica Jugadores</title>
    <style>
        .centrar {
            text-align: center;
        }

        .mensaje {
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
        }

        .exito {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="centrar">
        <a href="introducir.php">1.Introducir Jugador</a><br>
        <a href="mostrar.php">2.Mostrar Jugador</a><br>
        <a href="buscar.php">3.Buscar Jugador</a><br>
        <a href="modificar.php">4.Modificar Jugador</a><br>
        <a href="borrar.php">5.Borrar Jugador</a><br>
    </div>
    <?php
    if (isset($_GET['mensaje'])) {
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'exito';
        $clase = ($tipo === 'error') ? 'error' : 'exito';
        echo "<h3 class='mensaje $clase'>" . $_GET['mensaje'] . "</h3>";
    }
    
    ?>

</body>

</html>