<form action="" method="POST">
    Codigo: <input type="text" name="codigo"><br>
    Nombre: <input type="text" name="nombre"><br>
    Precio: <input type="text" name="precio"><br>
    <input type="submit" name="insert" value="Insertar">
    <input type="submit" name="search" value="Buscar">
    <input type="submit" name="see" value="Mostrar">
</form>

<?php
require_once 'Producto.php';

if(isset($_POST['insert'])){
    $p=new Producto($_POST['codigo'],$_POST['nombre'],$_POST['precio']);
    if($p->insert()){
        echo "<br>Producto insertado correctamente<br>";
    }
}
if(isset($_POST['search'])){
    $p=Producto::search($_POST['codigo']);
    if($p) echo $p;
    else echo "No se encuentra ningún producto con este código.";
}

if(isset($_POST['see'])){
    $productos=Producto::seeAll();
    if($productos){
        foreach($productos as $p){
            echo "Código: $p->codigo<br>";
            echo "Nombre: $p->nombre<br>";
            echo "Precio: $p->precio<br>";
        }
    }else echo "No hay productos";
}
?>

