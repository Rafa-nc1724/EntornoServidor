<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar_Jugador</title>
</head>

<body>
    <h1>Insertar Jugador</h1>
    <form action="" method="POST">
        
        Nombre:<input type="text" name="nombre" value="<?= ($_POST['nombre'] ?? '') ?>">
        <?php
        if (isset($_POST['insertar'])) {
            if (empty($_POST['nombre']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', trim($_POST['nombre']))) {
                echo "<span style='color:red'> El nombre no puede estar vacío y solo puede contener letras </span>";
            }
        }
        ?>
        <br>

        DNI:<input type="text" name="dni" value="<?= ($_POST['dni'] ?? '') ?>">
        <?php
        if (isset($_POST['insertar'])) {
            if (empty($_POST['dni']) || !preg_match('/^[0-9]{8}[A-Z]$/', trim($_POST['dni']))) {
                echo "<span style='color:red'> El DNI no puede estar vacío y debe tener 8 números y una letra mayúscula </span>";
            }
        }
        ?>
        <br>

        Dorsal:
        <select name="dorsal">
            <option selected disabled>Selecciona un dorsal</option>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                $selected = (isset($_POST['dorsal']) && $_POST['dorsal'] == $i) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>
        <br>

        Posición:<br>
        <select multiple name="posicion[]">
            <option value="portero" <?= (isset($_POST['posicion']) && in_array('portero', $_POST['posicion'])) ? 'selected' : '' ?>>Portero</option>
            <option value="defensa" <?= (isset($_POST['posicion']) && in_array('defensa', $_POST['posicion'])) ? 'selected' : '' ?>>Defensa</option>
            <option value="centrocampista" <?= (isset($_POST['posicion']) && in_array('centrocampista', $_POST['posicion'])) ? 'selected' : '' ?>>Centrocampista</option>
            <option value="delantero" <?= (isset($_POST['posicion']) && in_array('delantero', $_POST['posicion'])) ? 'selected' : '' ?>>Delantero</option>
        </select>
        <br>

        Equipo:<input type="text" name="equipo" value="<?= ($_POST['equipo'] ?? '') ?>">
        <?php
        if (isset($_POST['insertar']) && empty($_POST['equipo'])) {
            echo "<span style='color:red'> El equipo no puede estar vacío </span>";
        }
        ?>
        <br>

        NºGoles:<input type="text" name="nGoles" value="<?= ($_POST['nGoles'] ?? '') ?>">
        <?php
        if (isset($_POST['insertar']) && (!preg_match('/^[0-9]+$/', $_POST['nGoles']) && $_POST['nGoles'] !== '')) {
            echo "<span style='color:red'> Los goles solo pueden ser números </span>";
        }
        ?>
        <br><br>

        <input type="submit" name="insertar" value="Insertar">
        <input type="submit" name="menu" value="Menú">
    </form>

    <?php
    if (isset($_POST['insertar'])) {
        
        $nombreValido = !empty($_POST['nombre']) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', trim($_POST['nombre']));
        $dniValido = !empty($_POST['dni']) && preg_match('/^[0-9]{8}[A-Z]$/', trim($_POST['dni']));
        $equipoValido = !empty($_POST['equipo']);
        $golesValido = ($_POST['nGoles'] === '' || preg_match('/^[0-9]+$/', $_POST['nGoles']));

        if ($nombreValido && $dniValido && $equipoValido && $golesValido) {
            try {
                $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
                $conex->set_charset("utf8mb4");

                $stmt = $conex->prepare("INSERT INTO datos (nombre, dni, dorsal, posicion, equipo, nGoles) VALUES (?,?,?,?,?,?)");

                $nombre = trim($_POST['nombre']);
                $dni = trim($_POST['dni']);
                $dorsal = $_POST['dorsal'];
                $posicion = isset($_POST['posicion']) ? implode(',', $_POST['posicion']) : '';
                $equipo = trim($_POST['equipo']);
                $nGoles = $_POST['nGoles'] ?? 0;

                $stmt->execute([$nombre, $dni, $dorsal, $posicion, $equipo, $nGoles]);

                if ($stmt->affected_rows > 0) {
                    header("Location: index.php?mensaje=Jugador inscrito correctamente&tipo=exito");
                    exit;
                } else {
                    header("Location: index.php?mensaje=No se pudo insertar el jugador&tipo=error");
                    exit;
                }
            } catch (mysqli_sql_exception $ex) {
                $error = urlencode("Error al insertar: " . $ex->getMessage());
                header("Location: index.php?mensaje=$error&tipo=error");
                exit;
            }
        } else {
            echo "<h3 style='color:red'> No se ha podido insertar el jugador. Corrige los errores antes de continuar.</h3>";
        }
    }

    if (isset($_POST['menu'])) {
        header('Location: index.php');
        exit;
    }
    ?>
</body>

</html>
