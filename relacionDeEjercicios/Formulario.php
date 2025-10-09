    <?php
    $errores = 0;

    if (isset($_POST['enviar'])) {
        if (empty($_POST['nombre'])) {
            $errores++;
        }
        if (empty($_POST['apellidos'])) {
            $errores++;
        }
        if (empty($_POST['edad'])) {
            $errores++;
        }
        if (empty($_POST['sexo'])) {
            $errores++;
        }
        if (empty($_POST['estadoCivil'])) {
            $errores++;
        }
        if (empty($_POST['provincia'])) {
            $errores++;
        }
        if (empty($_POST['aficiones[]'])) {
            $errores++;
        }
        if (empty($_POST['estudios[]'])) {
            $errores++;
        }
        print_r($_POST);
    }
    if (isset($_POST['enviar']) && $errores == 0) {
        //procesamos
        echo "Nombre: " . $_POST['nombre'] . "<br>";
        echo "Apellidos: " . $_POST['apellidos'] . "<br>";
        echo "Edad: " . $_POST['edad'] . "<br>";
        echo "Sexo: " . $_POST['sexo'] . "<br>";
        echo "Estado Civil: " . $_POST['ec'] . "<br>";
        echo "Provincia: " . $_POST['provincias'] . "<br>";
        echo "Aficiones: <br>";
        foreach ($_POST['aficiones'] as $valor) {
            echo "---> " . $valor . "<br>";
        }
        echo "Estudios: <br>";
        foreach ($_POST['estudios'] as $valor) {
            echo "---> " . $valor . "<br>";
        }
    } else if (!isset($_POST['enviar']) || $errores > 0) {
    ?>
        <form action="" method="POST">
            Nombre:<input type="text" name="nombre" value="<?php echo !empty($_POST['nombre']) ? $_POST['nombre'] : ''; ?>"><?php if (isset($_POST['enviar']) && empty($_POST['nombre']))
                                                                                                                                    echo "<span style='color:red'>El nombre no puede estar vacío</span>"; ?>
            <br><br>
            Apellidos:<input type="text" name="apellidos" value="
                                            <?php echo !empty($_POST['apellidos']) ? $_POST['apellidos'] : '' ?>
                                        ">
            <?php echo empty($_POST['apellidos']) && isset($_POST['enviar']) ?
                "<span style='color:red'>El apellido no puede estar vacio</span>" : ""; ?>
            <br><br>

            Edad:<input type="number" name="edad" value="
                                            <?php
                                            echo !empty($_POST['edad']) ? $_POST['edad'] : '';

                                            ?>
                                        ">
            <?php
            if (isset($_POST['enviar']) && $_POST['edad'] < 18) {
                echo "<span style='color:red'>La edad debe de ser como minimo 18 años</span>";
            }
            ?>
            <br><br>

            Sexo:<br>
            <input type="radio" name="sexo" value="hombre">Hombre<br>
            <input type="radio" name="sexo" value="mujer">Mujer<br><br>

            Estado Civil:<br>
            <input type="radio" name="ec" value="soltero">Soltero<br>
            <input type="radio" name="ec" value="casado">Casado<br>
            <input type="radio" name="ec" value="otro">Otro<br><br>

            Provincia:<select name="provincias" id="provincias">
                <option selected disabled>Selecciona una Provincia</option>
                <option value="cordoba">Córdoba</option>
                <option value="sevilla">Sevilla</option>
                <option value="malaga">Málaga</option>
                <option value="cadiz">Cádiz</option>
                <option value="jaen">Jaen</option>
                <option value="almeria">Almeria</option>
                <option value="granada">Granada</option>
                <option value="huelva">Huelva</option>
            </select><br><br>

            Aficiones:<br>
            <input type="checkbox" name="aficiones[]" value="cine">Cine
            <input type="checkbox" name="aficiones[]" value="lectura">Lectura
            <input type="checkbox" name="aficiones[]" value="tv">TV<br>
            <input type="checkbox" name="aficiones[]" value="deporte">Deporte
            <input type="checkbox" name="aficiones[]" value="musica">Música<br><br>

            Estudios:
            <select name="estudios[]" id="estudios" multiple>
                <option value="ESO">ESO</option>
                <option value="Bach">Bachillerato</option>
                <option value="CFGM">CFGM</option>
                <option value="CFGM">CFGS</option>
                <option value="Uni">Universidad</option>
            </select><br><br>


            <button type="submit" name="enviar">Enviar</button>
        </form>
    <?php
    }
    ?>