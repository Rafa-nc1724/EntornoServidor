
<?php

/**
 * En esta ocasión realizamos in insert mediante la función bind_param.
 * Creamos un objeto stmt
 */

try {
    $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
    $stmt = $conex->prepare("INSERT INTO tienda (nombre,tlf) VALUES (?,?)");
    
    $n = "Sucursal8";
    $tlf = "888888888";
    $stmt->execute([$n, $tlf]);
    echo "Tienda insertada";
} catch (Exception $ex) {
    die($ex->getMessage());
}
