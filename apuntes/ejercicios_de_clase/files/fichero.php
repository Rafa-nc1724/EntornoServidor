<?php
if (isset($_POST['enviar'])) {
    echo "Nombre original: " . $_FILES['foto']['name'] . "<br>";
    echo "Nombre temporal: " . $_FILES['foto']['tmp_name'] . "<br>";
    echo "Tamaño: " . $_FILES['foto']['type'] . "<br>";
    echo "Error: " . $_FILES['foto']['error'] . "<br>";
    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $fich=time()."-".$_FILES['foto']['name'];
        $ruta="fotos/".$fich;
        move_uploaded_file($_FILES['foto']['tmp_name'],$ruta);
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "ficheros");
            $conex->query("INSERT INTO ficheros(nombre,ruta) VALUES('$_POST[nombre]','$ruta')");
            $conex->close();
        } catch (mysqli_sql_exception $ex) {
            unlink($ruta);
            echo $ex->getMessage();
        }
        echo "<br>Datos almacenados correctamente<br>";
    }else{
        echo "Error al subir";
        echo $_FILES['foto']['error'];
        if ($_FILES['foto']['error']==1){
            echo "El fichero supera el limite permitido";
        }
    }
}
if(isset($_POST['mostrar'])){
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "ficheros");
        $result=$conex->query("SELECT * FROM ficheros");
        if($result->num_rows>0){
            while ($reg=$result->fetch_object()){
                echo "<img src=$reg->ruta width=50 height=50>";
                echo "Nombre: ".$reg->nombre."<br>";
            }
        }
        $conex->close();
    }catch (mysqli_sql_exception $ex){
        echo $ex->getMessage();
    }
}

?>
<!--sin esto "enctype="multipart/form-data" no funciona-->
<form action="" method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre"><br>
    Imagen: <input type="file" name="foto"><br>
    <input type="submit" name="enviar" value="Enviar">
    <input type="submit" name="mostrar" value="Mostrar">
</form>
