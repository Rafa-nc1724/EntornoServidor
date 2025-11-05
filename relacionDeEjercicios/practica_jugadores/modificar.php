<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Jugador</title>
</head>

<body>
    <h1><u>Modificar Jugador</u></h1>

    <?php
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
        $conex->set_charset("utf8mb4");

        // --- BOTÓN MENÚ ---
        if (isset($_POST['menu'])) {
            header('Location: index.php');
            exit;
        }

        // --- BOTÓN CANCELAR ---
        if (isset($_POST['cancelar'])) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        // --- BOTÓN MODIFICAR (UPDATE) ---
        if (isset($_POST['modificar'])) {
            $dni = $_POST['dni_original']; // Dni original oculto
            $nuevo_dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $dorsal = $_POST['dorsal'];
            $posicion = $_POST['posicion'];
            $equipo = $_POST['equipo'];
            $nGoles = $_POST['nGoles'];

            $sql = "UPDATE datos 
                    SET nombre=?, dni=?, dorsal=?, posicion=?, equipo=?, nGoles=?
                    WHERE dni=?";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("ssissis", $nombre, $nuevo_dni, $dorsal, $posicion, $equipo, $nGoles, $dni);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($stmt->affected_rows > 0) {
                //Se ha metido el jugador
                header("Location: index.php?mensaje=Jugador modificado correctamente&tipo=exito");
                exit;
            } else {
                //Fallo sin cambios
                header("Location: index.php?mensaje=No se pudo modificar el jugador&tipo=error");
                exit;
            }
        }

        // --- BUSCAR JUGADOR ---
        if (isset($_POST['buscar']) && !empty($_POST['dni'])) {
            $dni = $_POST['dni'];
            $sql = "SELECT * FROM datos WHERE dni=?";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("s", $dni);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $fila = $result->fetch_object();
    ?>

                <form method="POST">
                    Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($fila->nombre) ?>"><br>
                    DNI: <input type="text" name="dni" value="<?= htmlspecialchars($fila->dni) ?>"><br>
                    <input type="hidden" name="dni_original" value="<?= htmlspecialchars($fila->dni) ?>">
                    Dorsal: <input type="text" name="dorsal" value="<?= htmlspecialchars($fila->dorsal) ?>"><br>
                    Posición: <input type="text" name="posicion" value="<?= htmlspecialchars($fila->posicion) ?>"><br>
                    Equipo: <input type="text" name="equipo" value="<?= htmlspecialchars($fila->equipo) ?>"><br>
                    Nº Goles: <input type="text" name="nGoles" value="<?= htmlspecialchars($fila->nGoles) ?>"><br><br>

                    <input type="submit" name="cancelar" value="Cancelar">
                    <input type="submit" name="modificar" value="Modificar">
                </form>

    <?php
            } else {
                echo "<p style='color:red;'>No se encontró ningún jugador con ese DNI.</p>";
            }
        } else {
            // Mostrar formulario de búsqueda inicial
    ?>
            <form method="POST">
                Buscar jugador (DNI):
                <input type="text" name="dni"><br><br>
                <input type="submit" name="menu" value="Menú">
                <input type="submit" name="buscar" value="Buscar">
            </form>
    <?php
        }
    } catch (Exception $ex) {
        echo "<p style='color:red;'>Error: " . $ex->getMessage() . "</p>";
    }
    ?>
</body>
</html>
