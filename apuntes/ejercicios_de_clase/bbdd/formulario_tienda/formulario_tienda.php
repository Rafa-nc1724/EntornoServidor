<?php
$tienda = false;
$unidades = false;
$error = false;
$msg="";

if (isset($_POST['traspasar'])) {

    if ($_POST['tiendaOg'] != $_POST['tiendaDes']) {
        $tienda = true;
    }

    if ($_POST['unidades'] > 0) {
        $unidades = true;
    }
}
if (isset($_POST['traspasar']) && $tienda && $unidades) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
        $conex->set_charset("utf8mb4");
    } catch (Exception $ex) {
        $msg="ERROR AL CONECTAR CON EL SERVIDOR DE BD";
        $error = true;
    }
    if (!$error) {
        try {
            $conex->autocommit(false);
            $conex->query("Update stock set unidades = unidades - $_POST[unidades] where tienda=$_POST[tiendaOg] and producto = '$_POST[codpro]' and unidades >= $_POST[unidades]");
            if ($conex->affected_rows == 0) {
                $msg="Las unidades disponibles son menores que las indicadas";
            } else {
                $conex->query("Update stock set unidades = unidades + $_POST[unidades] where tienda=$_POST[tiendaDes] and producto = '$_POST[codpro]'");
                if($conex->affected_rows == 0){
                    $conex->query("insert into stock values('$_POST[codpro]', $_POST[tiendaDes], $_POST[unidades])");
                }
                $conex->commit();
                $msg="Traspaso correcto";
            }
        } catch (mysqli_sql_exception $ex) {
            $msg="Error con servidor de BD. Intentelo más tarde";
            $conex->rollback();
        }
        $conex->autocommit(true);
        $conex->close();
    }
    
}
?>
<form action="" method="post">
    Tienda origen<br>
    <select name="tiendaOg">
        <option value="1">Central</option>
        <option value="2">Sucursal1</option>
        <option value="3">Sucursal2</option>
    </select>
    <br>

    Tienda destino<br>
    <select name="tiendaDes">
        <option value="1">Central</option>
        <option value="2">Sucursal1</option>
        <option value="3">Sucursal2</option>
    </select>
    <br>
    <?php if (isset($_POST['traspasar']) && !$tienda) echo "Las tiendas tienen que ser diferentes" ?>

    <input type="text" name="codpro"> Codigo producto<br>
    <input type="number" name="unidades"> Unidades <?php if (isset($_POST['traspasar']) && !$unidades) echo "Las unidades tiene que ser mayor que 0" ?>
    <br>

    <input type="submit" name="traspasar" value="Traspasar">
</form>
<?php
echo "<br><h2>$msg</h2>";
?>
