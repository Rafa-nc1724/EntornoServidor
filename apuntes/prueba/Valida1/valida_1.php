<?php
if (isset($_POST['enviar'])) {
    if (!empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['modulos'])) {
        echo "Nombre: " . $_POST['nombre'] . "<br>";
        echo "Apellidos: " . $_POST['apellidos'] . "<br>";
        echo "Modulos:<br>";
        foreach ($_POST['modulos'] as $valor) {
            echo " ------> " . $valor . "<br>";
        }
        echo '<br><a href="">Volver al Formulario</a>';
    } else {
?>
        <form action="" method="POST">
            Nombre:<input type="text" name="nombre" value="<?= !empty($_POST['nombre'])? $_POST['nombre']: "" ?>"><?= empty($_POST['nombre'])? "<span style='color:red'>El nombre no puede estar vacio</span>" : "" ?><br><br>
            Apellidos:<input type="text" name="apellidos" value="<?= !empty($_POST['apellidos'])? $_POST['apellidos']: "" ?>"><?= empty($_POST['apellidos'])? "<span style='color:red'>El apellido no puede estar vacio</span>" : "" ?><br><br>
            Modulos:<?= empty($_POST['modulos'])? "<span style='color:red'>Debes seleccionar almenos una casilla</span>" : "" ?>
            <br>
            <input type="checkbox" name="modulos[]" value="DWES">Desarrollo web Entorno Servidor<br>
            <input type="checkbox" name="modulos[]" value="DIW">Diseño de Interfaces Web<br>
            <input type="checkbox" name="modulos[]" value="DWEC">Desarrollo web Entorno Cliente<br><br>
            
           
            <button type="submit" name="enviar">Enviar</button>
        </form>
    <?php
    }
} else {




    ?>

    <form action="" method="POST">
        Nombre:<input type="text" name="nombre"><br><br>
        Apellidos:<input type="text" name="apellidos"><br><br>
        Modulos:<br>
        <input type="checkbox" name="modulos[]" value="DWES">Desarrollo web Entorno Servidor<br>
        <input type="checkbox" name="modulos[]" value="DIW">Diseño de Interfaces Web<br>
        <input type="checkbox" name="modulos[]" value="DWEC">Desarrollo web Entorno Cliente<br><br>
        <!--<input type="submit" name="enviar" value="Enviar">-->
        <button type="submit" name="enviar">Enviar</button>
    </form>

<?php
}
?>