<form action="" method="POST">
    <label>Nombre: </label>
    <input type="text" name="name"><br><!--Sólo texto, max 30-->
    <label>DNI: </label>
    <input type="text" name="dni"><br><!--8 dígitos + 1 letra mayúscula-->
    <label>Fecha Nacimiento: </label>
    <input type="text" name="fchnac"><br><!--dd-mm-yyyy y correcta--><!--chec_date-->
    <label>Email: </label>
    <input type="text" name="email"><br><!--texto/numero/_ . /@texto/numero/.com/es/org-->
    <label>Edad: </label>
    <input type="text" name="edad"><br><!--Mayor 18, sólo números-->
    <input type="submit" name="acept" value="Aceptar">
</form>
<?php
if(isset($_POST['acept'])){
    if(!empty($_POST['name'])){
        $name=$_POST['name'];
        if(preg_match('/^[a-z]{1,30}$/',$name)){
            echo "Nombre correcto";
        } else{
            echo "Nombre Incorrecto";
        }
    } else{
        echo "nombre vacio";
    }
}
?>