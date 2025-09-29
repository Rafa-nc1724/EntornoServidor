<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_tabla_2</title>
</head>

<body>
    <table border="1">


        <?php
        $matriz = array(
            "Marketing" => array(
                "Nombre" => "Pepe",
                "Apellidos" => "López",
                "Salario" => 1500,
                "Edad" => 35
            ),
            "Contabilidad" => array(
                "Nombre" => "Juan",
                "Apellidos" => "Sanchez",
                "Salario" => 1750,
                "Edad" => 28
            ),
            "Ventas" => array(
                "Nombre" => "María",
                "Apellidos" => "Carpio",
                "Salario" => 1675,
                "Edad" => 33
            ),
            "Informatica" => array(
                "Nombre" => "Pedro",
                "Apellidos" => "Luna",
                "Salario" => 2100,
                "Edad" => 48
            ),
            "Direccion" => array(
                "Nombre" => "Rosa",
                "Apellidos" => "Catalá",
                "Salario" => 5100,
                "Edad" => 53
            )
        );
         foreach ($matriz as $ind => $fila) {
            echo $ind . "<br>";
            foreach ($fila as $indc => $valor) {
                echo $indc . "=" . $valor . "<br>";
            }
        }

        ?>
    </table>
</body>

</html>