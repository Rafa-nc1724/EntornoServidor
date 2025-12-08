<?php

require_once '../controlador/controladorEmpleado.php';

if(isset($_POST['login'])){
    $empleado = ControladorEmpleado::verificarEmpelado($_POST['email'], $_POST['pass']);
    if($empleado != null){
        session_name("emp");
        session_start();
        $_SESSION['emp'] = $empleado;
        header("Location: inicio.php");
    }else{
        echo "Contraseña y/o email incorrectos";
    }
}

?>

<form action="" method="post">
    Email: <input type="text" name="email"><br>
    Contraseña: <input type="text" name="pass"><br>
    <input type="submit" name="login" value="Login">
</form>

