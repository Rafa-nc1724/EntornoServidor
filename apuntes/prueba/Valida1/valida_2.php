    <?php
$errores = 0;

//si el formulario se ha enviado
if (isset($_POST['enviar'])) {
    //validamos datos
    if (empty($_POST['nombre'])) {
        $errores++;
    }
    if (empty($_POST['apellidos'])) {
        $errores++;
    }
    if (empty($_POST['modulos'])) {
        $errores++;
    }
    
} //fin si

//si el formulario se ha enviado y no hay errores
if (isset($_POST['enviar']) && $errores == 0) {
    //procesamos el formulario
    echo "Nombre: " . $_POST['nombre'] . "<br>";
    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
    echo "Modulos:<br>";
    foreach ($_POST['modulos'] as $valor) {
        echo " ------> " . $valor . "<br>";
    }
    echo '<br><a href="">Volver al Formulario</a>';
} else if (!isset($_POST['enviar']) || $errores > 0) { //si no, mostramos el formulario en blanco o con errores y datos correctos
    ?>
    <form action="" method="POST">
        Nombre:<input type="text" name="nombre" value="<?php echo !empty($_POST['nombre']) ? $_POST['nombre'] : ''; ?>"><?php echo empty($_POST['nombre']) && isset($_POST['enviar']) ? "<span style='color:red'>El nombre no puede estar vacío</span>" : ""; ?><br><br>
        Apellidos:<input type="text" name="apellidos" value="<?php echo !empty($_POST['apellidos']) ? $_POST['apellidos'] : '' ?>"><?php echo empty($_POST['apellidos']) && isset($_POST['enviar']) ? "<span style='color:red'>El apellido no puede estar vacio</span>" : ""; ?><br><br>
        Modulos:<?php echo empty($_POST['modulos']) && isset($_POST['enviar']) ? "<span style='color:red'>Debes seleccionar almenos una casilla</span>" : "" ?>
        <br>
        <input type="checkbox" name="modulos[]" value="DWES" <?php if(!empty($_POST['modulos'])){echo in_array('DWES', $_POST['modulos']) ? 'checked' : '';} ?>>Desarrollo web Entorno Servidor<br>
        <input type="checkbox" name="modulos[]" value="DIW" <?php if(!empty($_POST['modulos'])){echo in_array('DIW', $_POST['modulos']) ? 'checked' : '';} ?>>Diseño de Interfaces Web<br>
        <input type="checkbox" name="modulos[]" value="DWEC" <?php if(!empty($_POST['modulos'])){echo in_array('DWEC', $_POST['modulos']) ? 'checked' : '';} ?>>Desarrollo web Entorno Cliente<br><br>


        <button type="submit" name="enviar">Enviar</button>
    </form>
    <?php
} 



    ?>