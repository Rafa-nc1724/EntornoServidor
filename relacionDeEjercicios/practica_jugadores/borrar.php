<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Jugador</title>
</head>

<body>
    <h1><u>Borrar Jugador</u></h1>

    <?php
    try {
        // Conexión a la base de datos
        $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores");
        $conex->set_charset("utf8mb4");

        // --- BOTÓN MENÚ ---
        if (isset($_POST['menu'])) {
            header("Location: index.php");
            exit;
        }

        // --- BOTÓN CANCELAR ---
        if (isset($_POST['cancelar'])) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        // --- BOTÓN BORRAR ---
        if (isset($_POST['borrar'])) {
            $dni = $_POST['dni'];
            $sql = "DELETE FROM datos WHERE dni = ?";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("s", $dni);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location: index.php?mensaje=Jugador Borrado correctamente&tipo=exito");
                exit;
            } else {
                echo "<h3 style='color:red;'>No se encontró ningún jugador con ese DNI.</h3>";
            }
        }

        // --- BOTÓN BUSCAR ---
        elseif (isset($_POST['buscar']) && !empty($_POST['dni'])) {
            $dni = $_POST['dni'];

            $sql = "SELECT * FROM datos WHERE dni = ?";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("s", $dni);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $fila = $result->fetch_object();
    ?>
                <h3>Jugador encontrado:</h3>
                <ul>
                    <li><b>Nombre:</b> <?= $fila->nombre ?></li>
                    <li><b>DNI:</b> <?= $fila->dni ?></li>
                    <li><b>Dorsal:</b> <?= $fila->dorsal ?></li>
                    <li><b>Posición:</b> <?= $fila->posicion ?></li>
                    <li><b>Equipo:</b> <?= $fila->equipo ?></li>
                    <li><b>Nº Goles:</b> <?= $fila->nGoles ?></li>
                </ul>

                <form method="POST">
                    <input type="hidden" name="dni" value="<?= htmlspecialchars($fila->dni) ?>">
                    <input type="submit" name="cancelar" value="Cancelar">
                    <input type="submit" name="borrar" value="Borrar">
                </form>
            <?php
            } else {
                echo "<h3 style='color:red;'>No se encontró ningún jugador con ese DNI.</h3>";
            }
        }

        // --- FORMULARIO INICIAL ---
        else {
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