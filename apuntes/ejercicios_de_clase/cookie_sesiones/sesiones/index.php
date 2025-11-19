<?php
session_name('admin');
session_start();
//Nunca se pueden crear dos sesiones a la vez
//no puede haber dos sesiones en un mismo cliente
if(isset($_SESSION['nombre'])){
    echo $_SESSION['nombre'];
}
$_SESSION['nombre']="Pepe";

?>
<br><a href="datos.php">Ir a datos</a>
