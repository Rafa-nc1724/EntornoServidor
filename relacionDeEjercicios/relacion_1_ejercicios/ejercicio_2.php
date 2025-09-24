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

            $n = rand(1, 50) * 2 - 1; 


            echo "<style>
                table {
                border-collapse: collapse;
                }
                td {
                border: 1px solid black;
                width: 30px;
                height: 30px;
                text-align: center;
                }
            </style>";


            for ($i = 0; $i < 10; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 10; $j++) {
                    echo "<td>$n</td>";
                    $n += 2; 
                }
                echo "</tr>";
            }
?>
    </table>

</body>
</html>
