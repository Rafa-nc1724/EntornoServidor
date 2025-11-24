<?php
require_once 'Producto.php';

if(isset($_POST['insert'])){
    $p=new Producto($_POST['cod'],$_POST['nom'],$_POST['pre']);
    if($p->insert()){
        echo "<br>Producto insertado correctamente<br>";
    }
}
if(isset($_POST['search'])){
    $p=Producto::search($_POST['cod']);
    if($p) echo $p;
    else echo "No se encuentra ningún producto con este código.";
}

if(isset($_POST['see'])){
    $productos=Producto::seeAll();
    if($productos){
        foreach($productos as $p){
            echo "Código: $p->cod<br>";
            echo "Nombre: $p->nom<br>";
            echo "Precio: $p->pre<br>";
        }
    }else echo "No hay productos";
}
?>

<form action="" method="POST">
    Codigo: <input type="text" name="cod"><br>
    Nombre: <input type="text" name="nom"><br>
    Precio: <input type="text" name="pre"><br>
    <input type="submit" name="insert" value="Insertar">
    <input type="submit" name="search" value="Buscar">
    <input type="submit" name="see" value="Mostrar">
</form>