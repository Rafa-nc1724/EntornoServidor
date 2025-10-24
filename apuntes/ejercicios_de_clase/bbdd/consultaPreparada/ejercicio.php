<?php
/*
Realiza un formulario con apartados de datos e idiomas que al mandarlo 
haga una insert a la tabla idiomas en la base de datos empleados
*/
?>
<form action="" method="POST">
    <label>DNI</label>
    <input type="text" name="dni"><br><br>
    <label>Nombre</label>
    <input type="text" name="nombre"><br><br>
    <label>Apellido</label>
    <input type="text" name="apellido"><br><br>
    <label>Salario</label>
    <input type="text" name="salario"><br><br>
    <p>================================</p>
    <label>Idiomas:</label><br>
    <input type="checkbox" name="idiomas[]" value="ingles">Inglés<br>
    <input type="checkbox" name="idiomas[]" value="frances">Francés<br>
    <input type="checkbox" name="idiomas[]" value="aleman">Alemán<br>
    <input type="checkbox" name="idiomas[]" value="chino">Chino<br>
    <input type="checkbox" name="idiomas[]" value="portugues">Portugués<br>
    <br>
    <button type="submit" name="add">Añadir</button>
    <button type="submit" name="search">Buscar</button>
</form>
<?php
try {
    //creo conexión
    $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
    $conex->set_charset("utf8mb4");
    if (isset($_POST['add'])) {
        try {
            //consulta preparada
            $stmt = $conex->prepare("INSERT INTO datos (DNI,Nombre,Apellidos,Salario) VALUES (?,?,?,?);");
            //bariables para la consulta preparada
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $salario = $_POST['salario'];
            //mandamos las variables en orden
            $stmt->execute([$dni, $nombre, $apellido, $salario]);
            $stmt->close();
            if (!empty($_POST['idiomas'])) { //Sie el array de idiomas no está vacío
                foreach ($_POST['idiomas'] as $idioma) { //por cada idioma que haya dentro haz un insert con estos datos
                    $stmt = $conex->prepare("INSERT INTO idiomas (dni,idioma) VALUES (?,?);");
                    $stmt->execute([$dni, $idioma]);
                    $stmt->close();
                }
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    if(isset($_POST['search'])){
        
    }
} catch (Exception $ex) {
    die($ex->getMessage());
}

?>