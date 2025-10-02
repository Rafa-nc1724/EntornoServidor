<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios_5</title>
</head>
<body>
    <h2>Ejercicio 5: Arrays Multidimensionales</h2>
    <h3>Objetivo: Practicar la creación y acceso a elementos de un array
multidimensional.</h3>
    <h3>• Descripción:</h3>
    <p>1. Crea un array multidimensional llamado $productos que contenga tres
arrays internos, cada uno representando un producto con nombre, precio
y cantidad.
<br>2. Muestra el nombre y el precio del segundo producto.
<br>3. Muestra todos los productos con un bucle foreach.</p>
    <?php
    echo "<br>==================CREAMOS LA MATRIZ===================<br>";
    $productos = array(
            "movil"=>(array(
                "nombre"=>"IPHONE",
                "precio"=>1200,
                "cantidad"=>7)),
            "ordenador"=>(array(
                "nombre"=>"MACBOOK",
                "precio"=>1400,
                "cantidad"=>4)),
            "tablet"=>(array(
                "nombre"=>"IPAD",
                "precio"=>400,
                "cantidad"=>8))
            );
    foreach($productos as $ind=>$fila){
    echo $ind."<br>";
    foreach($fila as $indc=>$valor){
        echo "--->  ".$indc."=".$valor."<br>";
    }
}
     echo "<br>==================MOSTRAMOS EL NOMBRE Y EL PRECIO DEL SEGUNDO PRODUCTO===================<br>";

    echo $productos["ordenador"]["nombre"]."<br>";   
    echo $productos["ordenador"]["precio"]."<br>";
    ?>
</body>
</html>