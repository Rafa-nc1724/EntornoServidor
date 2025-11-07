<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Plantilla para Ejercicios Tema 3</title>
    <link href="plantilla/dwes.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="encabezado">
        <h1>Tarea: Edición de un producto</h1>
        
    </div>

    <div id="contenido">
        <h2>Producto:</h2>
        <?php
        try {
            $db = 'mysql:host=localhost;dbname=dwes;charset=utf8mb4';
            $opc = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_CASE => PDO::CASE_LOWER);
            $conex = new PDO($db, 'dwes', 'abc123.', $opc);

            if (isset($_GET['cod'])) {
                $cod=$_GET['cod'];
                $result=$conex->prepare("SELECT * FROM producto WHERE cod=?");
                $result->bindParam(1,$cod);
                $result->execute();
                if($producto=$result->fetch()){
                    ?>
                        <form action="" method="POST">
                            <input type="hidden" name="cod" value="<?= $producto->cod ?>">
                            Nombre_corto:<input type="text" name="nombre_corto" value="<?= $producto->nombre_corto ?>"><br>
                            Nombre:<br><textarea name="nombre" rows="5" cols="50" style="overflow:auto;"><?= $producto->nombre ?></textarea><br>
                            Descripción:<br><textarea name="descripcion" rows="5" cols="50" style="overflow:auto;"><?= $producto->descripcion ?></textarea><br>
                            PVP:<input type="text" name="PVP" value="<?= $producto->pvp ?>"><br>
                            <input type="hidden" name="familia"value="<?= $producto->familia ?>">
                            <input type="submit" name="actualizar" value="Actualizar">
                            <input type="submit" name="cancelar" value="Cancelar">
                        </form>
                    <?php
                }
            }
            if(isset($_POST['actualizar'])){
                $cod=$_POST['cod'];
                $nombre_corto=$_POST['nombre_corto'];
                $nombre=$_POST['nombre'];
                $descripcion=$_POST['descripcion'];
                $pvp=$_POST['PVP'];
                $familia=$_POST['familia'];

                $result=$conex->prepare("UPDATE producto SET nombre=?, nombre_corto=?, descripcion=?, pvp=?, familia=? WHERE cod=?");
                
                $result->bindParam(1,$nombre);
                $result->bindParam(2,$nombre_corto);
                $result->bindParam(3,$descripcion);
                $result->bindParam(4,$pvp);
                $result->bindParam(5,$familia);
                $result->bindParam(6,$cod);

                $result->execute();
                if($result->rowCount()>0){
                    header("Location: actualizar.php");
                    exit;
                }
            }
            if(isset($_POST['cancelar'])){
                header("Location: listado.php");
                exit;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        ?>
    </div>

    <div id="pie">
    </div>
</body>

</html>