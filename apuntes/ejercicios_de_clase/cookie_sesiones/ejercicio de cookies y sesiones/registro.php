<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <form action="" method="POSt">
        Nombre: <input type="text" name="usser"><br>
        Apellidos: <input type="text" name="usser"><br>
        Dirección: <input type="text" name="usser"><br>
        Localidad: <input type="text" name="usser"><br>
        Usuario: <input type="text" name="usser"><br>
        Clave: <input type="text" name="usser"><br>
        Repetir clave: <input type="text" name="usser"><br>
        Color letra: <select name="color">
            <option value="red">Rojo</option>
            <option value="green">Verde</option>
            <option value="blue">Azul</option>
            <option value="yellow">Amarillo</option>
        </select>
        Color fondo: <select name="color">
            <option value="red">Rojo</option>
            <option value="green">Verde</option>
            <option value="blue">Azul</option>
            <option value="yellow">Amarillo</option>
        </select>
        Tipo letra: <select name="font">
            <option value="">Arial</option>
            <option value="">Times New Roman</option>
            <option value="">Roboto</option>
        </select>
        Tamaño letra: <select name="size-font">
            <option value="48px">Grande</option>
            <option value="25px">Mediano</option>
            <option value="16px">Pequeño</option>
        </select>
        <input type="submit" name="reg" value="Registro">
        <input type="submit" name="log" value="Loguin">
    </form>

    <?php
    try{
        $concex=new mysqli("localhost","dwes","abc123.","practicaLogueo");
        $conex->set_charset("utf8mb4");
        if(isset($_POST['reg'])){

        }
        if(isset($_POST['log'])){
            
        }
    } catch(Exception $ex){
        echo $ex->getMessage();
    }
    ?>
</body>

</html>