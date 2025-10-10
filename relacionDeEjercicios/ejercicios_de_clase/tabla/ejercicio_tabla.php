<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla</title>
</head>

<body>

    <table border="1">
        <tr>
            <th>Indice</th>
            <th>Columna</th>
        </tr>
        <?php
        foreach ($matriz_ciclos as $ind => $fila) {
            echo $ind . "<br>";
            foreach ($fila as $indc => $valor) {
                echo $indc . "=" . $valor . "<br>";
            }
        }
        
        ?>
    </table>
</body>

</html>