<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio_13</title>
</head>
<body>
    <h2>Ejercicio 13: Eliminar Elementos Duplicados</h2>
    <h3>Objetivo: Implementar un algoritmo para eliminar elementos duplicados de un
array sin usar array_unique().</h3>
    <h3>Descripción:</h3>
    <p>1. Crea un array con algunos elementos duplicados.
<br>2. Escribe un algoritmo que elimine los duplicados manteniendo solo la
primera aparición de cada elemento.
<br>3. Muestra el array sin duplicados.</p>
    <?php
    $duplicados=array(1,1,1,2,3,4,5,6,6,7,8,9,9,10);
    $noDuplicados=array();
    
    foreach($duplicados as $valor){
        $exist=false;
        foreach($noDuplicados as $v){
            if($v==$valor){
                $exist=true;
                break;
            }
        }
        if(!$exist){
            $noDuplicados[]=$valor;
        }
    }

    echo"========== Array con duplicados =========<br>";
    print_r($duplicados);
    echo"<br>========== Array sin duplicados =========<br>";
    print_r($noDuplicados);

    ?>
</body>
</html>