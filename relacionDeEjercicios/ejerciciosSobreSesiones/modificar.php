<?php
session_name("user");
session_start();

if (isset($_POST['modificar'])) {

    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "gestionsesiones");
        $stmt = $conex->prepare("update usuario set nombre=?, apellidos=?, direccion=?, localidad=?, user=?, color_letra=?, color_fondo=?, tipo_letra=?, tam_letra=? where user=?");
        $stmt->bind_param("ssssssssss", $_POST['nombre'], $_POST['apellido'], $_POST['dir'], $_POST['loc'], $_POST['usu'], $_POST['cl'], $_POST['cf'], $_POST['tl'], $_POST['sl'], $_SESSION['user']);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $_SESSION['nombre'] = $_POST['nombre'];
            $_SESSION['apellido'] = $_POST['ape'];
            $_SESSION['dir'] = $_POST['dir'];
            $_SESSION['loc'] = $_POST['loc'];
            $_SESSION['user'] = $_POST['usu'];
            $_SESSION['cl'] = $_POST['cl'];
            $_SESSION['cf'] = $_POST['cf'];
            $_SESSION['tl'] = $_POST['tl'];
            $_SESSION['sl'] = $_POST['sl'];
            header("Location: inicio.php");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>

<form action="" method="post">
    Nombre: <input type="text" name="nombre" <?= "value='$_SESSION[nombre]'" ?> ><br>
    Apellido: <input type="text" name="ape" <?= "value='$_SESSION[apellido]'" ?> ><br>
    Direccion: <input type="text" name="dir" <?= "value='$_SESSION[dir]'" ?> ><br>
    Localidad: <input type="text" name="loc" <?= "value='$_SESSION[loc]'" ?> ><br>
    Usario: <input type="text" name="usu" <?= "value='$_SESSION[user]'" ?> ><br>

    Color de letra
    <select name="cl">
        <option value="red" <?php if ($_SESSION['cl'] == "red") echo "selected" ?> >Rojo</option>
        <option value="green" <?php if ($_SESSION['cl'] == "green") echo "selected" ?> >Verde</option>
        <option value="blue" <?php if ($_SESSION['cl'] == "blue") echo "selected" ?> >Blue</option>
    </select><br>

    Color de fondo
    <select name="cf">
        <option value="red" <?php if ($_SESSION['cf'] == "red") echo "selected" ?> >Rojo</option>
        <option value="black" <?php if ($_SESSION['cf'] == "black") echo "selected" ?> >Negro</option>
        <option value="whithe" <?php if ($_SESSION['cf'] == "whithe") echo "selected" ?> >Blanco</option>
    </select><br>

    Tipo de letra
    <select name="tl">
        <option value="Inter" <?php if ($_SESSION['tl'] == "Inter") echo "selected" ?> >Inter</option>
        <option value="Montserrat" <?php if ($_SESSION['tl'] == "Montserrat") echo "selected" ?> >Montserrat</option>
        <option value="Roboto" <?php if ($_SESSION['tl'] == "Roboto") echo "selected" ?> >Roboto</option>
    </select><br>

    Tamaño de letra
    <select name="sl">
        <option value="30px" <?php if ($_SESSION['sl'] == "30px") echo "selected" ?> >pequeña</option>
        <option value="40px" <?php if ($_SESSION['sl'] == "40px") echo "selected" ?> >mediana</option>
        <option value="50px" <?php if ($_SESSION['sl'] == "50px") echo "selected" ?> >grande</option>
    </select><br>
    <br>


    <input type="submit" name="modificar" value="Modificar">
    <button><a href='inicio.php'>Volver</a></button>
</form>
