<form action="" method="POST">
    DNI:<input type="text" name="dni"><br>
    Nombre:<input type="text" name="nom"><br>
    Apellidos:<input type="text" name="apll"><br>
    Salario:<input type="text" name="sal">
    <br>==================<br>
    Idiomas:<br>
    <input type="checkbox" name="idiomas[]" value="1">Español<br>
    <input type="checkbox" name="idiomas[]" value="2">Inglés<br>
    <input type="checkbox" name="idiomas[]" value="4">Chino<br>
    <input type="checkbox" name="idiomas[]" value="8">Alemán
    <br>=================<br>
    Estudios:<br><select multiple="" name="estudios[]">
        <option value="ESO">ESO</option>
        <option value="Bachillerato">Bachiller</option>
        <option value="Grado">Grado</option>
        <option value="Carrera">Carrera</option>
    </select>
    <br>=======================<br>
    Usuario:<input type="text" name="usu"><br>
    Contraseña:<input type="text" name="pass">
    <br>=======================<br>
    <input type="submit" name="insertar" value="Insertar"><br>
    <input type="submit" name="recuperar" value="Recuperar"><br>
</form>
<?php
if (isset($_POST['insertar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
        $conex->set_charset("utf8mb4");

        $idio = 0;
        foreach ($_POST['idiomas'] as $value) {
            $idio += $value;
        }
        $estud = implode(',', $_POST['estudios']);

        $conex->query("INSERT INTO datos (DNI, Nombre, Apellidos, Salario, usuario, contrasenia, idiomas, estudios)
        VALUES(
        '$_POST[dni]',
        '$_POST[nom]',
        '$_POST[apll]',
        '$_POST[sal]',
        '$_POST[usu]',
        '$_POST[pass]',
        '$idio',
        '$estud');");
    } catch (mysqli_sql_exception $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['recuperar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
        $conex->set_charset("utf8mb4");
        $result = $conex->query("select * from datos");
        if($result->num_rows){
            while ($fila = $result->fetch_object()){
                echo "DNI: ".$fila->DNI."<br>";
                echo "Nombre: ".$fila->Nombre."<br>";
                echo "Apellidos: ".$fila->Apellidos."<br>";
                echo "Salario: ".$fila->Salario."<br>";
                echo "Idiomas: ".$fila->idiomas."<br>";
                echo "Estudios: ".$fila->estudios."<br>";
                echo"=================<br><br>";
            }
        }else{
            echo "No hay datos";
        }
    } catch (Exception $ex) {
        
    }
}
