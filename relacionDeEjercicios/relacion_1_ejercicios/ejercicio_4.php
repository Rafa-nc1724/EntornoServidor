<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_4</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
            width: 40px;
            height: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Tabla 5x7 de números naturales del 1 al 35</h2>
    <table>
        <?php
        $num = 1; // Es el número por el que empieza

        // filas
        for ($i = 0; $i < 5; $i++) {
            echo "<tr>";
            // columnas
            for ($j = 0; $j < 7; $j++) {
                echo "<td>$num</td>";
                $num++; // siguiente número
            }
            echo "</tr>";
        }
        ?>
    </table>
    
</body>
</html>