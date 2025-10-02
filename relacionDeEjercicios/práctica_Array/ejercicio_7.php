<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_7</title>
</head>
<body>
    <h2>Ejercicio 7: Eliminar Elementos de un Array</h2>
    <h3>Objetivo: Practicar la eliminación de elementos de un array.</h3>
    <h3>Descripción:</h3>
    <p>1. Crea un array llamado $paises con los valores "España", "Francia",
"Italia", "Alemania", "Portugal".
<br>2. Usa la función unset() para eliminar "Italia" del array.
<br>3. Muestra el array después de eliminar el elemento.
<br>4. Usa la función array_pop() para eliminar el último elemento del array y
muestra el array actualizado.</p>

<?php
//1. Crea un array llamado $paises con los valores "España", "Francia","Italia", "Alemania", "Portugal".
echo "=============CREAMOS ARRAY===============";
$paises=array("España", "Francia", "Italia", "Alemania", "Portugal");
echo"<br>";
print_r($paises);

//2. Usa la función unset() para eliminar "Italia" del array.
echo "<br>=============USAMOS (unset())===============<br>";
    foreach($paises as $clave=>$valor){
        if($valor=="Italia"){
            unset($paises[$clave]);
        }
    }
// 3. Muestra el array después de eliminar el elemento.
    print_r($paises);

// Usa la función array_pop() para eliminar el último elemento del array y muestra el array actualizado.
echo "<br>=============USAMOS (array_pop())===============<br>";
array_pop($paises);
print_r($paises);
?>

</body>
</html>