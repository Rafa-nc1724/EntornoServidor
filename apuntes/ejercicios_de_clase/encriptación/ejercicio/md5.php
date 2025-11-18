<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>encripctación con MD5</title>
</head>

<body>

    <form action="" method="POST">
    Email: <input type="text" name="email">
    Password: <input type="password" name="pass">
    <br>
    <input type="submit" name="entrar" value="Entrar">
    </form>
    <?php
    try{
         $conex = new mysqli("localhost", "dwes", "abc123.", "usuarios");
        if(isset($_POST['entrar'])){
            $email=$_POST['email'];
            $pass=md5($_POST['pass']);

            

            $stmt=$conex->prepare("SELECT nombre, apellidos FROM datos WHERE email=? AND pass=?");
            $stmt->bind_param("ss",$email,$pass);
            $stmt->execute();

            $result=$stmt->get_result();

            if($result->num_rows>0){
                echo $pass;
                
                while($fila = $result->fetch_object()){
                    $nombre=$fila->nombre."|".$fila->apellidos;
                    setcookie("nombre",$nombre);
                }
                header("Location: index.php");
                exit();
            } else{
                echo "<h2 style='color:red'>Fallos en el usuario o contraseña.</h2>";
            }
        }

    } catch(Exception $ex){
        echo $ex->getMessage();
    }
    ?>
</body>

</html>