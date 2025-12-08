<?php
require_once '../controlador/controladorTareas.php';
require_once '../modelo/Empleado.php';
require_once '../modelo/Tarea.php';

session_name("emp");
session_start();

$empleado = $_SESSION['emp'];
$emailLogeado = $empleado->email;

if (isset($_POST['modificar'])) {


    if (ControladorTareas::modificarTarea($_POST['id'], $_POST['horas'], $emailLogeado)) {
        echo "Modificacion ralizada";
    } else {
        echo "Ocurrio un error al intentar modificar la tarea";
    }
}
$tareas = ControladorTareas::getTareas($emailLogeado);
?>

<table border="1px">
    <tr>
        <th>Nombre</th>
        <th>Incio</th>
        <th>Fin</th>
        <th>Horas</th>
        <th>Modificar</th>
    </tr>
<?php
foreach ($tareas as $t) {
    echo "<tr>"
    . "<form action='' method='post'>"
    . "<td>$t->nombre</td> "
    . "<td>$t->fecha_ini</td> "
    . "<td>$t->fecha_fin</td> "
    . "<td><input type='number' name='horas' value='$t->horas'></td> "
    . "<td><input type='submit' name='modificar' value='Modificar'></td>"
    . "<input type='hidden' name='id' value='$t->id'>"
    . "</form>"
    . "</tr>";
}
?>

    <button><a href="inicio.php">Volver</a></button>
