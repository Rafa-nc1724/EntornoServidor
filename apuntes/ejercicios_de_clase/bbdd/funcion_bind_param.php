<?php

/**
 * En esta ocasión realizamos in insert mediante la función bind_param.
 * Creamos un objeto stmt
 */

try {
    $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
    //$stmt=$conex->stmt_init();
    //$stmt->prepare($query);
    $stmt = $conex->prepare("INSERT INTO tienda (nombre,tlf) VALUES (?,?)");
    
    $tiendas = array('SUCURSAL4' => '444444444', 'SUCURSALR5' => '555555555', 'SUCURSAL6' => '666666666');
    $n = "";
    $tlf = "";
    $stmt->bind_param('ss', $n, $tlf);

    foreach ($tiendas as $key => $valor) {
        $n = $key;
        $tlf = $valor;
        $stmt->execute();
        echo "Tienda insertada<br>";
    }

} catch (Exception $ex) {
    die($ex->getMessage());
}

