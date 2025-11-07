<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Tarea Enun</title>
  <link href="plantilla/dwes.css" rel="stylesheet" type="text/css">

</head>

<body>

  <div id="encabezado">
    <h1>Tarea: Listado de productos de una famillia </h1>

    <form action="" method="post">
      <label>Familia:</label>
      <select name="familia" id="familia">
        <?php
        try {
          $db = 'mysql:host=localhost;dbname=dwes;charset=utf8mb4';
          $opc = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_CASE => PDO::CASE_LOWER);
          $conex = new PDO($db, 'dwes', 'abc123.', $opc);

          $result = $conex->prepare("SELECT * FROM familia");
          $result->execute();

          while ($familia = $result->fetchObject()) {
            $selected = (isset($_POST['familia']) && $_POST['familia'] == $familia->cod) ? "selected" : "";
            echo "<option value='$familia->cod' $selected>$familia->nombre</option>";
          }
        } catch (Exception $ex) {
          echo $ex->getMessage();
        }
        ?>
      </select>
      <button type="submit" name="mostrarStock">Mostrar stock</button>
    </form>
  </div>

  <div id="contenido">
    <h2>Productos de la familia:</h2>

    <?php

    if (isset($_POST['mostrarStock'])) {
      $familia = $_POST['familia'];

      $result = $conex->prepare("SELECT * FROM producto WHERE familia = ?");
      $result->bindParam(1, $familia);
      $result->execute();

      while ($producto = $result->fetchObject()) {
        //print_r($producto); //Usa esto cuando quieras ver algo de un objeto o de un array coño.
        echo "<form method='GET'>";
        echo "<u>Producto:</u> $producto->nombre_corto <u>Precio:</u> $producto->pvp";
        echo "<input type='submit' name='editar' value='Editar'><br>";
        echo "<input type='hidden' name='cod' value='$producto->cod'><br>";
        echo "</form>";
      }
    }
    if (isset($_GET['editar'])) {
      $cod = $_GET['cod'];
      print_r($cod);
      header("Location: editar.php?cod=$cod");
      exit;
    }

    ?>

  </div>

  <div id="pie">
  </div>
</body>

</html>