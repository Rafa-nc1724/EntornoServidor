<form action="" method="POST">
    usuario: <input type="text" name="user"><br>
    contraseña: <input type="text" name="pass"><br>
    <input type="submit" name="entrar" value="Entrar">
</form>


<?php
if(isset($_POST['entrar'])){
    /*try {
        $conex= new mysqli("localhost","dwes","abc123.","empleados");
        $result=$conex->query("Select * from datos where usuario=BINARY'$_POST[user]' and contrasenia=BINARY'$_POST[pass]';");
    } catch (Exception $ex) {

    }
    if($result->num_rows){
        echo "Has entrado maquinón";
    } else{
        echo "ERROR";
    }*/

        try{
         $conex= new mysqli("localhost","dwes","abc123.","empleados");
         $stmt=$conex->prepare("select * from datos where usuario=BINARY ? and contrasenia=BINARY ?");
        } catch (Exception $ex){
        }
        $stmt->bind_param('ss',$_POST['user'],$_POST['pass']);
        $stmt->execute();
        $result=$stmt->get_result();
        if($result->num_rows){
            echo "Has entrado";
        } else{
            echo "Error";
        }

}
