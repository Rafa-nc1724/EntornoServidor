<?php
try {
    $db = 'mysql:host=localhost;dbname=dwes;charset=utf8mb4';
    $opc = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_CASE => PDO::CASE_LOWER);
    $conex = new PDO($db, 'dwes', 'abc123.', $opc);

    $menor = 100;
    $mayor = 200;
    $result = $conex->prepare("SELECT * FROM producto WHERE PVP>? AND PVP<?");
    for ($i = 0; $i < 1000; $i += 100) {
        $result->bindParam(1, $menor);
        $result->bindParam(2, $mayor);
        $result->execute();
        $menor += $i;
        $mayor += $i;
        echo "Productos con precio entre ".$menor." y ".$mayor."<br>";
        while ($fila = $result->fetchObject()) {
            
            echo "Nombre: ".$fila->nombre_corto."<br>";
            
        }
        echo "<br>=======<br>";
    }
} catch (PDOException $ex) {
    echo $ex->getMessage() . "<br>";
}
