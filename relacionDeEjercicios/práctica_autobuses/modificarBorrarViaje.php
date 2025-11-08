<?php
try {
    $db = 'mysql:host=localhost;dbname=autobuses;charset=utf8mb4';
    $opc = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $conex = new PDO($db, 'dwes', 'abc123.', $opc);

   
    if (isset($_POST['borrar'])) {
        $matricula = $_POST['matricula'];
        $fecha = $_POST['fecha'];
        $stmt = $conex->prepare("DELETE FROM viajes WHERE matricula=? AND fecha=?");
        $stmt->execute([$matricula, $fecha]);
        $mensaje = $stmt->rowCount() > 0 ? 
            "<h2 style='color:green'>Viaje eliminado correctamente</h2>" : 
            "<h2 style='color:red'>Fallo al eliminar</h2>";
    } 
    elseif (isset($_POST['modificar_2'])) {
        $matricula = $_POST['matricula'];
        $fecha = $_POST['fecha'];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $num_plazas = $_POST['num_plazas'];
        $plazas_libres = $_POST['plazas_libres'];

        $stmt = $conex->prepare("SELECT * FROM autos WHERE matricula=? AND num_plazas=?");
        $stmt->execute([$matricula, $num_plazas]);
        if ($stmt->rowCount() == 0) {
            $mensaje = "<h2 style='color:red'>No existe un autobús con esa matrícula o número de plazas</h2>";
        } elseif ($plazas_libres > $num_plazas) {
            $mensaje = "<h2 style='color:red'>No puedes poner más plazas libres que plazas totales del autobús</h2>";
        } else {
            $stmt = $conex->prepare("UPDATE viajes 
                                     SET origen=?, destino=?, plazas_libres=?
                                     WHERE matricula=? AND fecha=?");
            $stmt->execute([$origen, $destino, $plazas_libres, $matricula, $fecha]);
            $mensaje = $stmt->rowCount() > 0 ? 
                "<h2 style='color:green'>Viaje modificado correctamente</h2>" : 
                "<h2 style='color:red'>No se pudo modificar el viaje</h2>";
        }
    } 
    elseif (isset($_POST['modificar'])) {
        $matricula = $_POST['matricula'];
        $fecha = $_POST['fecha'];
        $stmt = $conex->prepare("SELECT v.fecha, v.matricula, a.num_plazas, v.origen, v.destino, v.plazas_libres
                                 FROM viajes v
                                 JOIN autos a ON v.matricula = a.matricula
                                 WHERE v.fecha=? AND v.matricula=?");
        $stmt->execute([$fecha, $matricula]);
        $viaje = $stmt->fetch();
    } 
    elseif (isset($_POST['menu'])) {
        header("Location: menu.php");
        exit;
    } 
    elseif (isset($_POST['cancelar'])) {
        header("Location: modificarBorrarViaje.php");
        exit;
    }

  
    $sql = "SELECT v.fecha, v.matricula, a.num_plazas, v.origen, v.destino, v.plazas_libres
            FROM viajes v
            JOIN autos a ON v.matricula = a.matricula
            ORDER BY v.fecha";
    $result = $conex->query($sql);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar / Borrar Viaje</title>
    <style>
        td { text-align: center; }
        table { border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 5px; }
    </style>
</head>
<body>

<?php
if (!empty($mensaje)) {
    echo $mensaje;
}


echo "<table>";
echo "<tr>
        <th>Fecha</th>
        <th>Matrícula</th>
        <th>Plazas</th>
        <th>Origen</th>
        <th>Destino</th>
        <th>Plazas libres</th>
        <th>Acciones</th>
      </tr>";
while ($fila = $result->fetch()) {
    echo "<tr>
            <td>$fila->fecha</td>
            <td>$fila->matricula</td>
            <td>$fila->num_plazas</td>
            <td>$fila->origen</td>
            <td>$fila->destino</td>
            <td>$fila->plazas_libres</td>
            <td>
                <form method='POST' style='display:inline'>
                    <input type='hidden' name='matricula' value='$fila->matricula'>
                    <input type='hidden' name='fecha' value='$fila->fecha'>
                    <input type='submit' name='modificar' value='Modificar'>
                </form>
                <form method='POST' style='display:inline'>
                    <input type='hidden' name='matricula' value='$fila->matricula'>
                    <input type='hidden' name='fecha' value='$fila->fecha'>
                    <input type='submit' name='borrar' value='Borrar'>
                </form>
            </td>
          </tr>";
}
echo "</table>";


echo "<form method='POST'>
        <input type='submit' name='menu' value='Menú'>
      </form>";


if (isset($viaje)) {
    echo "<h2>Modificar Viaje</h2>";
    echo "<form method='POST'>
            Fecha: <input type='text' name='fecha' value='{$viaje->fecha}' readonly><br>
            Matrícula: <input type='text' name='matricula' value='{$viaje->matricula}' readonly><br>
            Origen: <input type='text' name='origen' value='{$viaje->origen}'><br>
            Destino: <input type='text' name='destino' value='{$viaje->destino}'><br>
            Plazas: <input type='text' name='num_plazas' value='{$viaje->num_plazas}' readonly><br>
            Plazas Libres: <input type='text' name='plazas_libres' value='{$viaje->plazas_libres}'><br>
            <input type='submit' name='modificar_2' value='Modificar'>
            <input type='submit' name='cancelar' value='Cancelar'>
          </form>";
}
?>

</body>
</html>
