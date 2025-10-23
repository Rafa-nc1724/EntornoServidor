<?php

try {
    //Usando el bind_result()
    $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
   
    $stmt=$conex->prepare("SELECT * FROM tienda WHERE cod>?");
    $cod=3;
    $codigo="";
    $nombre="";
    $tlf="";
    $stmt->bind_param('i', $codigo);
    $stmt->execute();
    $stmt->bind_result($codigo,$nombre,$tlf);
    $stmt->store_result();//guarda la información en un buffer interno
    if($stmt->num_rows()){
        while($stmt->fetch()){
            echo "Código: $cod<br>";
            echo "Nombre: $nombre<br>";
            echo "Teléfono: $tlf<br>";
            echo "===================<br>";
        }
    }
    //Otra opción sería
    
    $stmt->execute();
    $result=$stmt->get_result();//el get result devuelve un obgeto por eso lo igualamosa una variable
    while($fila=$result->fetch_object()){
        echo "Código: $fila->cod<br>";
            echo "Nombre: $fila->nombre<br>";
            echo "Teléfono: $fila->tlf<br>";
            echo "===================<br>";
    }
} catch (Exception $ex) {
    die($ex->getMessage());
}