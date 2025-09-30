<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_2</title>
</head>

<body>

    <h2>Ejercicio 2: Array Asociativo</h2>
    <h4>Objetivo: Practicar la creación y manipulación de arrays asociativos.</h4>
    <h4>Descripción:</h4>
    <p>1. Crea un array asociativo llamado $persona con las claves nombre, edad
        y ciudad.
        <br>2. Asigna los valores "Juan", 25, y "Madrid" a estas claves,
        respectivamente.
        <br>3. Muestra el nombre y la ciudad de la persona.
        <br>4. Agrega una nueva clave profesion con el valor "Ingeniero" y muestra
        todos los datos.
    </p>
    <?php
    $persona= array("Nombre"=>"Juan","Edad"=>"25","Ciudad"=>"Madrid");
    echo "=====================================================<br>";
    echo $persona["Nombre"].", ".$persona["Ciudad"]."."."<br>";
    echo "=====================================================<br>";

    $persona["Profesion"]="Ingeniero";

    print_r($persona);

    ?>
</body>

</html>