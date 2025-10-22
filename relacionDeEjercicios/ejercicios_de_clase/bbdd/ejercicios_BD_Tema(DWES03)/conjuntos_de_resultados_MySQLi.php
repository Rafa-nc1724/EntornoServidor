<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conjuntos de resultados en MySQLi</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <section id="encabezado">
        <h1>Ejercicio: Conjuntos de resultadis en MYSQLi</h1>
        <label for="">Producto:</label>
        <select name="producto" id="producto">
            <?php
                try {
                    $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
                    $conex->set_charset("utf8mb4");
                    $result = $conex->query("select p.cod, p.nombre_corto from producto p;");
                    while ($datos = $result->fetch_object()) {
                        echo "<option value='$datos->cod'>$datos->nombre_corto</option>";
                    }
                } catch (Exception $ex) {
                    echo $ex;
                }
            ?>
        </select>
        <button type="submit" name="mostrar">Mostrar stock</button>
    </section>
    <section id="contenido">
        <h2>Stock del producto en las tiendas:</h2>
        <p>
            <?php

            ?>
        </p>
    </section>
    <section id="pie">
        Esto es el pie de página loquete
    </section>
</body>

</html>