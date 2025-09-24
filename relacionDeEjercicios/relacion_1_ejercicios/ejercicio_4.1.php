<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEjercicio_4 Usando while</title>
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
    <h2>Tabla 5x7 de números naturales del 1 al 35 (usando while)</h2>
    <table>
        <?php
        $num = 1; // Número inicial
        $i = 0;   // Contador de filas

        while ($i < 5) { // 5 filas
            echo "<tr>";
            $j = 0; // Contador de columnas
            while ($j < 7) { // 7 columnas
                echo "<td>$num</td>";
                $num++; // siguiente número natural
                $j++;
            }
            echo "</tr>";
            $i++;
        }
        ?>
    </table>
</body>
</html>