<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nuevoAutobus</title>
    <style>
        .block {
            display: block;
        }
    </style>
</head>

<body>
    <form method="POST">
        Matrícula:<input class="block" type="text" name="matricula">
        Marca:<input class="block" type="text" name="marca">
        NºPlazas:<input class="block" type="text" name="nPlazas">
        <input class="block" type="submit" name="add" value="Añadir">
        <input class="block" type="submit" name="menu" value="Menú">

    </form>
    <?php
    try {
        $db = 'mysql:host=localhost;dbname=autobuses;charset=utf8mb4';
        $opc = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_CASE => PDO::CASE_LOWER);
        $conex = new PDO($db, 'dwes', 'abc123.', $opc);
        if (isset($_POST['add'])) {
            $matricula = $_POST['matricula'];
            $marca = $_POST['marca'];
            $nPlazas = $_POST['nPlazas'];

            $result = $conex->prepare("SELECT*FROM autos WHERE matricula=?");
            $result->bindParam(1, $matricula);
            $result->execute();

            if ($result->rowCount()) {
                echo "<h2 style='color: red'>La Matrícula ya existe</h2>";
            } else{
                $result = $conex->prepare("INSERT INTO autos (matricula, marca, num_plazas) VALUE (?,?,?)");
                $result->bindParam(1, $matricula);
                $result->bindParam(2, $marca);
                $result->bindParam(3, $nPlazas);
                $result->execute();
                echo "<h2 style='color: green'>Autobús insertado correctamente</h2>";
            }
        }
        if(isset($_POST['menu'])){
            header("Location: menu.php");
            exit;
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
    ?>
</body>

</html>