<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio_4 Usando Do while</title>
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
    <h2>Tabla 5x7 de números naturales del 1 al 35 (usando do...while)</h2>
    <table>
        <?php
        $num = 1; 
        $i = 0;  

        do {
            echo "<tr>";

            do {
                echo "<td>$num</td>";
                $num++;
                $j++;
            } while ($j < 7); // columnas
            echo "</tr>";
            $i++;
        } while ($i < 5); // filas
        ?>
    </table>
</body>
</html>