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
        }
        ?>
      </select>
      <button type="submit" name="mostrar">Mostrar stock</button>
    </form>
  </section>

  <section id="contenido">
    <h2>Stock del producto en las tiendas:</h2>

    <?php
    try{
    if (isset($_POST['mostrar'])) {
      $cod = $_POST['producto'];
      $sql = "SELECT t.nombre tienda, s.unidades
              FROM stock s JOIN tienda t ON s.tienda = t.cod
              WHERE s.producto = '$cod'";
      $rs = $conex->query($sql);

      if ($rs->num_rows > 0) {
        while ($fila = $rs->fetch_object()) {
          echo "<p>Tienda: <strong>$fila->tienda</strong>: $fila->unidades unidades</p>";
        }
      } else {
        echo "<p>No hay stock disponible para este producto.</p>";
      }
    }
  } catch(Exception $ex){
    
  }
    ?>
  </section>

  <section id="pie">
    <?php if ($conex->connect_error) echo "Error: " . $conex->connect_error; ?>
  </section>
</body>

</html>