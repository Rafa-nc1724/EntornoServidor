<?php
require_once '../controlador/controladorEmpleado.php';
require_once '../controlador/controladorTareas.php';
require_once '../modelo/Empleado.php';

session_name("emp");
session_start();

$empleado = $_SESSION['emp'];
$emailLogeado = $empleado->email;

if(isset($_POST['crear'])){
    ControladorTareas::crearTarea($_POST['nombre'], $_POST['feini'], $_POST['fefin'], $_POST['part']);
}

?>

<h1>Nueva tarea</h1>

<form action="" method="post">
    Nombre: <input type="text" name="nombre"><br>
    Fecha inicio: <input type="date" name="feini"><br>
    Fecha din: <input type="date" name="fefin"><br>
    <select name="part[]" multiple="">
        <?php
        $array = ControladorEmpleado::getEmpladosDept($empleado->departamento);
        foreach ($array as $e) {
            if ($e->email != $emailLogeado) {
                echo "<option value='$e->email'>$e->nombre</option>";
            }
        }
        ?>
    </select><br>
    <input type="submit" name="crear" value="Crear Tarea">
</form>

<button><a href="inicio.php">Volver</a></button>