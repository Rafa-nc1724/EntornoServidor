<?php
/*
Realiza un formulario con un apartado de datos donde recojas 
dni, nombre, apellido, salario. Y otro apartado de idiomas que sea un checbox
con ingles, aleman, frances, portugues, chino. Tendrá dos botones, uno insertar 
que hará lo necesario para insertar en la base de datos empleados tanto en la
tabla datos como en la de idiomas. El otro botón será buscar que cuando le des
deberá de hacer una lista debajo del formulario, esta lista mostrará los idiomas
que has seleccionado y todos los nombres los cuales en la base de datos están
relacionados con ese idioma.
La lista deberá de estar formada de esta manera:
    -Idioma:
        *Nombre
        *Nombre
        *Nombre
    -Idioma:
        *Nombre
        *Nombre
        *Nombre
Recuerda que la base de datos es empleados tiene dos tablas una 
datos(dni(PRIMARY_KEY),nombre,apellido,salario) y otra idioma(dni,idioma(ambas PRIMARY_KEY)).
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
    <p>================================</p>
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
    if (isset($_POST['search'])) {
        if (!empty($_POST['idiomas'])) {
            echo "<h3>Resultados de la búsqueda</h3>";

            foreach ($_POST['idiomas'] as $idioma) {
                echo "<strong>$idioma:</strong>";
                $stmt = $conex->prepare(
                    "
                    SELECT d.nombre, d.apellidos, i.idioma
                    FROM datos d
                    JOIN idiomas i ON d.dni=i.dni
                    WHERE idioma=?"
                );
                $stmt->execute([$idioma]);
                $result = $stmt->get_result(); //el get result devuelve un objeto por eso lo igualamosa una variable
                if ($result && $result->num_rows > 0) {
                    while ($persona = $result->fetch_object()) {
                        echo "<br>->$persona->nombre $persona->apellidos";
                    }
                }
                echo "<br>===============<br>";
            }
        }
    }
} catch (Exception $ex) {
    die($ex->getMessage());
}

?>