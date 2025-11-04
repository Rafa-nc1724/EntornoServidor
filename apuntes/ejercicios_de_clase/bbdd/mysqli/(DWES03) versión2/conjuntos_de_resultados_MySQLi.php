<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Conjuntos de resultados en MySQLi</title>
  <link rel="stylesheet" href="estilo.css">
</head>

<body>
  <section id="encabezado">
    <h1>Ejercicio: Conjuntos de resultados en MySQLi</h1>

    <form action="" method="post">
      <label for="producto">Producto:</label>
      <select name="producto" id="producto">
        <?php
        try {
          $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
          $conex->set_charset("utf8mb4");

          $res = $conex->query("SELECT cod, nombre_corto FROM producto");
          while ($p = $res->fetch_object()) {
            $sel = (isset($_POST['producto']) && $_POST['producto'] == $p->cod) ? "selected" : "";
            echo "<option value='$p->cod' $sel>$p->nombre_corto</option>";
          }
        } catch (Exception $ex) {
          echo "Error de conexión.";
        }
        ?>
      </select>
      <button type="submit" name="mostrar">Mostrar stock</button>
    </form>
  </section>

  <section id="contenido">
    <h2>Stock del producto en las tiendas:</h2>

    <?php
    try {
      if (isset($_POST['mostrar'])) {
        $cod = $_POST['producto'];
        $sql = "SELECT t.cod AS cod_tienda, t.nombre AS tienda, s.unidades
                FROM stock s JOIN tienda t ON s.tienda = t.cod
                WHERE s.producto = '$cod'";
        $rs = $conex->query($sql);

        if ($rs->num_rows > 0) {
          echo "<form method='post'>";
          echo "<input type='hidden' name='producto' value='$cod'>";
          while ($fila = $rs->fetch_object()) {
            echo "<p>";
            echo "<label><strong>$fila->tienda</strong></label> ";
            echo "<input type='hidden' name='tienda[]' value='$fila->cod_tienda'>";
            echo "<input type='text' name='unidades[]' value='$fila->unidades'>";
            echo "</p>";
          }
          echo "<input type='submit' name='update' value='Actualizar'>";
          echo "</form>";
        } else {
          echo "<p>No hay stock disponible para este producto.</p>";
        }
      }

      if (isset($_POST['update'])) {
        $cod = $_POST['producto'];
        $tiendas = $_POST['tienda'];
        $unidades = $_POST['unidades'];

        $actualizados = 0;

        for ($i = 0; $i < count($tiendas); $i++) {
          $t = $tiendas[$i];
          $u = $unidades[$i];
          $sql = "UPDATE stock SET unidades = '$u' WHERE tienda = '$t' AND producto = '$cod'";
          $conex->query($sql);
          if ($conex->affected_rows > 0) $actualizados++;
        }

        echo "<p><strong>Se han actualizado $actualizados registros.</strong></p>";
      }
    } catch (Exception $ex) {
      echo "Error: " . $ex->getMessage();
    }
    ?>
  </section>

  <section id="pie">
    <?php if ($conex->connect_error) echo "Error: " . $conex->connect_error; ?>
  </section>
</body>

</html>