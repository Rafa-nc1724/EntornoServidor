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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla desde matriz</title>
    <style>
        table { border-collapse: collapse; width: 60%; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #ddd; }
    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Departamento</th>
            <?php 
            // Usamos la primera fila de la matriz para sacar los nombres de columnas
            foreach (array_keys(reset($matriz)) as $columna) {
                echo "<th>$columna</th>";
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($matriz as $departamento => $datos) { ?>
            <tr>
                <td><?php echo $departamento; ?></td>
                <?php foreach ($datos as $valor) { ?>
                    <td><?php echo $valor; ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
