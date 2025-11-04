<form action="" method="POST">
    <label>Nombre: </label>
    <input type="text" name="name"><br><!--Sólo texto, max 30-->
    <label>DNI: </label>
    <input type="text" name="dni"><br><!--8 dígitos + 1 letra mayúscula-->
    <label>Fecha Nacimiento: </label>
    <input type="text" name="fchnac"><br><!--dd-mm-yyyy y correcta--><!--chec_date-->
    <label>Email: </label>
    <input type="text" name="email"><br><!--texto/numero/_ . /@/texto/numero/.com/es/org-->
    <label>Edad: </label>
    <input type="text" name="edad"><br><!--Mayor 18, sólo números-->
    <input type="submit" name="acept" value="Aceptar">
</form>
<?php
if (isset($_POST['acept'])) {
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
        if (preg_match('/^[a-zA-Z]{1,30}$/', $name)) {
            echo "Nombre correcto<br>";
        } else {
            echo "Nombre Incorrecto<br>";
        }
    } else {
        echo "nombre vacio<br>";
    }
    if (!empty($_POST['dni'])) {
        $dni = $_POST['dni'];
        if (preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
            echo "dni correcto<br>";
        } else {
            echo "dni incorrecto<br>";
        }
    } else {
        echo "dni vacio<br>";
    }
    if (!empty($_POST['fchnac'])) {
        $fechnac = $_POST['fchnac'];
        if (preg_match('/^(0[1-9]|[12][0-9]|3[01])\-(0[1-9]|1[0-2])\-(19|20)\d{2}$/', $fechnac)) {
            //(0[1-9]|[12][0-9]|3[01]) → días del 01 al 31
            //(0[1-9]|1[0-2]) → meses del 01 al 12
            //(19|20)\d{2} → años desde 1900 a 2099

            list($dia, $mes, $anio) = explode('-', $fechnac); //extraemos las partes de lista separadas en este caso por guiones

            // Validar que la fecha exista
            if (checkdate($mes, $dia, $anio)) {
                // Comprobar que no sea futura
                $fecha_actual = date('Y-m-d');
                $fecha_input = "$anio-$mes-$dia";

                if ($fecha_input <= $fecha_actual) {
                    echo "fecha válida y no futura<br>";
                } else {
                    echo "fecha incorrecta es futura<br>";
                }
            } else {
                echo "fecha incorrecta no existe<br>";
            }
        } else {
            echo "fecha de nacimiento incorrecta<br>";
        }
    } else {
        echo "Fecha de nacimiento vacía<br>";
    }
    if (!empty($_POST['email'])) {/*[texto/numero/_ .]@[texto/numero].[com|es|org]*/
        $email = $_POST['email'];
        if (preg_match('/^[A-Za-z0-9._]+@[A-Za-z0-9]+\.(com|es|org)$/', $email)) {
            echo "email correcto<br>";
        } else {
            echo "email incorrecto formato([texto/numero/_ .]@[texto/numero].(com|es|org))<br>";
        }
    } else {
        echo "email vacio<br>";
    }
    if (!empty($_POST['edad'])) {
        $edad = $_POST['edad'];

        if (preg_match('/^[0-9]+$/', $edad)) {
            if ($edad >= 18) {
                echo "edad válida (mayor o igual a 18)<br>";
            } else {
                echo "debes ser mayor de 18 años<br>";
            }
        } else {
            echo "edad solo puedes poner números<br>";
        }
    } else {
        echo "campo de edad vacío";
    }
}


?>