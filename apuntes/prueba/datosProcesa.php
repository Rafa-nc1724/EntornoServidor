<?php

if (!isset($_POST['enviar'])) {

?>

    <form action="" method="POST">
        Nombre:<input type="text" name="nombre"><br><br>
        Apellidos:<input type="text" name="apellidos"><br><br>
        Email:<input type="text" name="email"><br><br>
        Modulos:<br>
        <input type="checkbox" name="modulos[]" value="DWES">Desarrollo web Entorno Servidor<br>
        <input type="checkbox" name="modulos[]" value="DIW">Diseño de Interfaces Web<br>
        <input type="checkbox" name="modulos[]" value="DWEC">Desarrollo web Entorno Cliente<br><br>
        <!--<input type="submit" name="enviar" value="Enviar">-->
        <button type="submit" name="enviar">Enviar</button>
    </form>

<?php

} else {
    echo "Nombre: " . $_POST['nombre'] . "<br>";
    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
    echo "Email: " . $_POST['email'] . "<br>";
    echo "Modulos:<br>";
    foreach ($_POST['modulos'] as $valor) {
        echo " ------> ".$valor . "<br>";
    }
    echo "<a href=datosProcesa.php>Enviar Datos</a>";
}

?>
