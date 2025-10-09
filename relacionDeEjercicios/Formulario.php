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
        } elseif ($_POST['edad'] < 18) {
            $errores++;
        }
        if (empty($_POST['sexo'])) {
            $errores++;
        }
        if (empty($_POST['ec'])) {
            $errores++;
        }
        if (empty($_POST['provincias'])) {
            $errores++;
        }
        if (empty($_POST['aficiones'])) {
            $errores++;
        }
        if (empty($_POST['estudios'])) {
            $errores++;
        }
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
        echo '<br><a href="">Volver al Formulario</a>';
    } else if (!isset($_POST['enviar']) || $errores > 0) {
    ?>
        <form action="" method="POST">
            Nombre:<input type="text" name="nombre" value="<?php echo !empty($_POST['nombre']) ? $_POST['nombre'] : ''; ?>"><?php if (isset($_POST['enviar']) && empty($_POST['nombre'])) echo "<span style='color:red'>El nombre no puede estar vacío</span>"; ?>
            <br><br>
            Apellidos:<input type="text" name="apellidos" value="<?php echo !empty($_POST['apellidos']) ? $_POST['apellidos'] : '' ?>"><?php echo empty($_POST['apellidos']) && isset($_POST['enviar']) ? "<span style='color:red'>El apellido no puede estar vacio</span>" : ""; ?>
            <br><br>
            Edad:<input type="text" name="edad" value="<?php echo !empty($_POST['edad']) ? $_POST['edad'] : ''; ?> ">
            <?php
            if (isset($_POST['enviar'])) {
                $edad = trim($_POST['edad'] ?? '');
                if ($edad === '') {
                    echo "<span style='color:red'>La edad no puede estar vacía</span>";
                    $errores++;
                } elseif (!is_numeric($edad) || $edad < 18) {
                    echo "<span style='color:red'>Debe tener al menos 18 años</span>";
                    $errores++;
                }
            }

            ?>
            <br><br>

            Sexo:<?php if (isset($_POST['enviar']) && empty($_POST['sexo'])) {
                        echo "<span style='color:red'>Debes de elegir un sexo</span><br>";
                    } ?>
            <br><input type="radio" name="sexo" value="hombre" <?php if (isset($_POST['sexo']) && $_POST['sexo'] == 'hombre') echo 'checked'; ?>>Hombre<br>
            <input type="radio" name="sexo" value="mujer" <?php if (isset($_POST['sexo']) && $_POST['sexo'] == 'mujer') echo 'checked'; ?>>Mujer<br><br>

            Estado Civil:<?php if (isset($_POST['enviar']) && empty($_POST['ec'])) {
                                echo "<span style='color:red'>Debes de elegir un Estado Civil</span><br>";
                            } ?>
            <br><input type="radio" name="ec" value="soltero" <?php if (isset($_POST['ec']) && $_POST['ec'] == 'soltero') echo 'checked'; ?>>Soltero<br>
            <input type="radio" name="ec" value="casado" <?php if (isset($_POST['ec']) && $_POST['ec'] == 'casado') echo 'checked'; ?>>Casado<br>
            <input type="radio" name="ec" value="otro" <?php if (isset($_POST['ec']) && $_POST['ec'] == 'otro') echo 'checked'; ?>>Otro<br><br>

            Provincia:<select name="provincias" id="provincias">
                <option selected disabled>Selecciona una Provincia</option>
                <option value="cordoba" <?php if (isset($_POST['provincias']) && $_POST['provincias'] == 'cordoba') echo 'selected' ?>>Córdoba</option>
                <option value="sevilla" <?php if (isset($_POST['provincias']) && $_POST['provincias'] == 'sevilla') echo 'selected' ?>>Sevilla</option>
                <option value="malaga" <?php if (isset($_POST['provincias']) && $_POST['provincias'] == 'malaga') echo 'selected' ?>>Málaga</option>
                <option value="cadiz" <?php if (isset($_POST['provincias']) && $_POST['provincias'] == 'cadiz') echo 'selected' ?>>Cádiz</option>
                <option value="jaen" <?php if (isset($_POST['provincias']) && $_POST['provincias'] == 'jaen') echo 'selected' ?>>Jaen</option>
                <option value="almeria" <?php if (isset($_POST['provincias']) && $_POST['provincias'] == 'almeria') echo 'selected' ?>>Almeria</option>
                <option value="granada" <?php if (isset($_POST['provincias']) && $_POST['provincias'] == 'granada') echo 'selected' ?>>Granada</option>
                <option value="huelva" <?php if (isset($_POST['provincias']) && $_POST['provincias'] == 'huelva') echo 'selected' ?>>Huelva</option>

            </select><?php if (isset($_POST['enviar']) && empty($_POST['provincias'])) {
                            echo "";
                        } ?><br><br>

            Aficiones:<?php if (isset($_POST['enviar']) && empty($_POST['aficiones'])) echo "<span style='color:red'>Debes seleccionar almenos una afición.</span><br>"; ?>
            <br><input type="checkbox" name="aficiones[]" value="cine" <?php if (isset($_POST['enviar']) && !empty($_POST['aficiones']) && in_array('cine', $_POST['aficiones'])) echo "checked"; ?>>Cine
            <input type="checkbox" name="aficiones[]" value="lectura" <?php if (isset($_POST['enviar']) && !empty($_POST['aficiones']) && in_array('lectura', $_POST['aficiones'])) echo "checked"; ?>>Lectura
            <input type="checkbox" name="aficiones[]" value="tv" <?php if (isset($_POST['enviar']) && !empty($_POST['aficiones']) && in_array('tv', $_POST['aficiones'])) echo "checked"; ?>>TV<br>
            <input type="checkbox" name="aficiones[]" value="deporte" <?php if (isset($_POST['enviar']) && !empty($_POST['aficiones']) && in_array('deporte', $_POST['aficiones'])) echo "checked"; ?>>Deporte
            <input type="checkbox" name="aficiones[]" value="musica" <?php if (isset($_POST['enviar']) && !empty($_POST['aficiones']) && in_array('musica', $_POST['aficiones'])) echo "checked"; ?>>Música<br><br>

            Estudios:<?php if (isset($_POST['enviar']) && empty($_POST['estudios'])) {
                            echo "<br><span style='color:red'>Debes seleccionar al menos un estudio.</span><br>";
                        } ?>
            <select name="estudios[]" id="estudios" multiple>
                <option value="ESO" <?php if (isset($_POST['enviar']) && !empty($_POST['estudios']) && in_array('ESO', $_POST['estudios'])) echo 'selected'; ?>>ESO</option>
                <option value="Bach" <?php if (isset($_POST['enviar']) && !empty($_POST['estudios']) && in_array('Bach', $_POST['estudios'])) echo 'selected'; ?>>Bachillerato</option>
                <option value="CFGM" <?php if (isset($_POST['enviar']) && !empty($_POST['estudios']) && in_array('CFGM', $_POST['estudios'])) echo 'selected'; ?>>CFGM</option>
                <option value="CFGS" <?php if (isset($_POST['enviar']) && !empty($_POST['estudios']) && in_array('CFGS', $_POST['estudios'])) echo 'selected'; ?>>CFGS</option>
                <option value="Uni" <?php if (isset($_POST['enviar']) && !empty($_POST['estudios']) && in_array('Uni', $_POST['estudios'])) echo 'selected'; ?>>Universidad</option>
            </select><br><br>

            <button type="submit" name="enviar">Enviar</button>
        </form>
    <?php
    }
    ?>