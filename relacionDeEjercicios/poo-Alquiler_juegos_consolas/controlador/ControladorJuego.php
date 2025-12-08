<?php
include_once "../modelo/Conexion.php";

class ControladorJuego
{
    public static function muestraJuegos()
    {
        $conex = new Conexion();
        $stmt = $conex->query("SELECT * FROM alquiler_juegos.juegos");

        if ($stmt->num_rows) {
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Código</th>";
            echo "<th>Nombre</th>";
            echo "<th>Consola</th>";
            echo "<th>Año</th>";
            echo "<th>Precio</th>";
            echo "<th>Alquilado</th>";
            echo "<th>Imagen</th>";
            echo "<th>Descripción</th>";
            echo "<th>Acciones</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($fila = $stmt->fetch_object()) {
                echo "<tr>";
                echo "<td>{$fila->Codigo}</td>";
                echo "<td>{$fila->Nombre_juego}</td>";
                echo "<td>{$fila->Nombre_consola}</td>";
                echo "<td>{$fila->Anno}</td>";
                echo "<td>{$fila->Precio}</td>";
                echo "<td>{$fila->Alquilado}</td>";
                echo "<td><img src='../{$fila->Imagen}' width='80' height='80'></td>";
                echo "<td>{$fila->descripcion}</td>";
                echo "<td>";

                // Botón para ver detalle (todos los usuarios)
                echo "<form method='get' action='detalle.php'>";
                echo "<input type='hidden' name='codigo' value='{$fila->Codigo}'>";
                echo "<input type='submit' value='Ver detalle'>";
                echo "</form>";

                // Botones extra solo para los administradores
                if (isset($_SESSION['cliente']) && $_SESSION['cliente']['tipo'] === 'admin') {

                    // Mostrar quién tiene el juego, si está alquilado
                    if ($fila->Alquilado === 'SI') {
                        $clienteAlquila = ControladorJuego::getClienteQueAlquila($fila->Codigo);

                        if ($clienteAlquila) {
                            echo "<p style='color:blue; font-size:12px;'>Lo tiene: "
                                . htmlspecialchars($clienteAlquila['Nombre']) . " "
                                . htmlspecialchars($clienteAlquila['Apellidos']) .
                                " (" . htmlspecialchars($clienteAlquila['DNI']) . ")</p>";
                        }
                    }

                    echo "<form method='post'>";
                    echo "<input type='hidden' name='codigo' value='{$fila->Codigo}'>";
                    echo "<input type='submit' name='modificar' value='Modificar'>";
                    echo "<input type='submit' name='borrar' value='Borrar'>";
                    echo "</form>";
                }

                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
    }

    public static function muestraJuegosAlquilados()
    {
        $conex = new Conexion();
        $stmt = $conex->query("SELECT * FROM alquiler_juegos.juegos WHERE Alquilado = 'SI'");

        if ($stmt->num_rows) {
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Código</th>";
            echo "<th>Nombre</th>";
            echo "<th>Consola</th>";
            echo "<th>Año</th>";
            echo "<th>Precio</th>";
            echo "<th>Alquilado</th>";
            echo "<th>Imagen</th>";
            echo "<th>Descripción</th>";
            echo "<th>Acciones</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($fila = $stmt->fetch_object()) {
                echo "<tr>";
                echo "<td>{$fila->Codigo}</td>";
                echo "<td>{$fila->Nombre_juego}</td>";
                echo "<td>{$fila->Nombre_consola}</td>";
                echo "<td>{$fila->Anno}</td>";
                echo "<td>{$fila->Precio}</td>";
                echo "<td>{$fila->Alquilado}</td>";
                echo "<td><img src='../{$fila->Imagen}' width='80' height='80'></td>";
                echo "<td>{$fila->descripcion}</td>";
                echo "<td>";
                echo "<form method='get' action='detalle.php'>";
                echo "<input type='hidden' name='codigo' value='{$fila->Codigo}'>";
                echo "<input type='submit' value='Ver detalle'>";
                echo "</form>";
                if (isset($_SESSION['cliente']) && $_SESSION['cliente']['tipo'] === 'admin') {
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='codigo' value='{$fila->Codigo}'>";
                    echo "<input type='submit' name='modificar' value='Modificar'>";
                    echo "<input type='submit' name='borrar' value='Borrar'>";
                    echo "</form>";
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
    }

    public static function muestraJuegosNoAlquilados()
    {
        $conex = new Conexion();
        $stmt = $conex->query("SELECT * FROM alquiler_juegos.juegos WHERE Alquilado = 'NO'");

        if ($stmt->num_rows) {
            echo "<table border='1' >";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Código</th>";
            echo "<th>Nombre</th>";
            echo "<th>Consola</th>";
            echo "<th>Año</th>";
            echo "<th>Precio</th>";
            echo "<th>Alquilado</th>";
            echo "<th>Imagen</th>";
            echo "<th>Descripción</th>";
            echo "<th>Acciones</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($fila = $stmt->fetch_object()) {
                echo "<tr>";
                echo "<td>{$fila->Codigo}</td>";
                echo "<td>{$fila->Nombre_juego}</td>";
                echo "<td>{$fila->Nombre_consola}</td>";
                echo "<td>{$fila->Anno}</td>";
                echo "<td>{$fila->Precio}</td>";
                echo "<td>{$fila->Alquilado}</td>";
                echo "<td><img src='../{$fila->Imagen}' width='80' height='80'></td>";
                echo "<td>{$fila->descripcion}</td>";
                echo "<td>";
                echo "<form method='get' action='detalle.php'>";
                echo "<input type='hidden' name='codigo' value='{$fila->Codigo}'>";
                echo "<input type='submit' value='Ver detalle'>";
                echo "</form>";
                if (isset($_SESSION['cliente']) && $_SESSION['cliente']['tipo'] === 'admin') {
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='codigo' value='{$fila->Codigo}'>";
                    echo "<input type='submit' name='modificar' value='Modificar'>";
                    echo "<input type='submit' name='borrar' value='Borrar'>";
                    echo "</form>";
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
    }

    public static function muestraMisJuegos($dni)
    {
        $conex = new Conexion();

        $sql = "SELECT j.*
            FROM juegos j
            JOIN alquiler a ON j.Codigo = a.cod_juego
            WHERE a.dni_cliente = ?
            AND a.fecha_devol IS NULL";

        $stmt = $conex->prepare($sql);
        $stmt->bind_param("s", $dni);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {

            echo "<table border='1' cellpadding='5' cellspacing='0'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Código</th>";
            echo "<th>Nombre</th>";
            echo "<th>Consola</th>";
            echo "<th>Año</th>";
            echo "<th>Precio</th>";
            echo "<th>Imagen</th>";
            echo "<th>Descripción</th>";
            echo "<th>Acciones</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($fila = $resultado->fetch_object()) {
                echo "<tr>";
                echo "<td>{$fila->Codigo}</td>";
                echo "<td>{$fila->Nombre_juego}</td>";
                echo "<td>{$fila->Nombre_consola}</td>";
                echo "<td>{$fila->Anno}</td>";
                echo "<td>{$fila->Precio}</td>";
                echo "<td><img src='../{$fila->Imagen}' width='80'></td>";
                echo "<td>{$fila->descripcion}</td>";
                echo "<td>";
                echo "<form method='get' action='detalle.php'>";
                echo "<input type='hidden' name='codigo' value='{$fila->Codigo}'>";
                echo "<input type='submit' value='Ver detalle'>";
                echo "</form>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='codigo' value='{$fila->Codigo}'>";
                echo "<input type='submit' name='devolver' value='Devolver'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        }
    }

    public static function insertarJuego(Juego $juego){
        $conex = new Conexion();
        $sql="INSERT INTO juegos (Codigo,Nombre_juego,Nombre_consola,Anno,Precio,Alquilado,Imagen,descripcion) 
        VALUES (?,?,?,?,?,?,?,?)";

        $codigo  = strtoupper(substr($juego->getNombreConsola(), 0, 3)) . "-" . strtoupper(substr($juego->getNombreJuego(), 0, 3));
        $nombre  = $juego->getNombreJuego();
        $consola = $juego->getNombreConsola();
        $anno    = $juego->getAnno();
        $precio  = $juego->getPrecio();
        $alquilado = "NO";
        $imagen  = $juego->getImagen();
        $desc    = $juego->getDescripcion();

        $stmt=$conex->prepare($sql);

        $stmt->bind_param(
            "sssssdss",
            $codigo,
            $nombre,
            $consola,
            $anno,
            $precio,
            $alquilado,
            $imagen,
            $desc
        );
        return $stmt->execute();
    }

    public static function modificarJuego(Juego $juego, $codigoOriginal) {
        $conex = new Conexion();

        $sql = "UPDATE juegos SET 
        Nombre_juego = ?, 
        Nombre_consola = ?, 
        Anno = ?, 
        Precio = ?, 
        Imagen = ?, 
        descripcion = ?
        WHERE Codigo = ?";

        $stmt = $conex->prepare($sql);

        $nombre  = $juego->getNombreJuego();
        $consola = $juego->getNombreConsola();
        $anno    = $juego->getAnno();
        $precio  = $juego->getPrecio();
        $imagen  = $juego->getImagen();
        $desc    = $juego->getDescripcion();
        $codigo  = $codigoOriginal;

        $stmt->bind_param(
            "sssdsss",
            $nombre,
            $consola,
            $anno,
            $precio,
            $imagen,
            $desc,
            $codigo
        );

        return $stmt->execute();
    }

    public function borrarJuego($codigo) {
        $conex = new Conexion();

        $sql = "DELETE FROM juegos WHERE Codigo = ?";

        $stmt = $conex->prepare($sql);
        $stmt->bind_param("s", $codigo);

        return $stmt->execute();
    }

    public static function devolverJuego($codigo, $dni)
    {
        $conex = new Conexion();

        // Buscar el alquiler activo de este usuario para este juego
        $sql = "SELECT id FROM alquiler 
            WHERE cod_juego = ? 
            AND dni_cliente = ?
            AND fecha_devol IS NULL";

        $stmt = $conex->prepare($sql);
        $stmt->bind_param("ss", $codigo, $dni);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 0) {
            return false; // No hay alquiler activo
        }

        $fila = $resultado->fetch_object();
        $idAlquiler = $fila->id;

        // Marcar el alquiler como devuelto
        $sql2 = "UPDATE alquiler SET fecha_devol = NOW() WHERE id = ?";
        $stmt2 = $conex->prepare($sql2);
        $stmt2->bind_param("i", $idAlquiler);
        $stmt2->execute();

        // Marcar el juego como NO alquilado
        $sql3 = "UPDATE juegos SET Alquilado = 'NO' WHERE Codigo = ?";
        $stmt3 = $conex->prepare($sql3);
        $stmt3->bind_param("s", $codigo);
        $stmt3->execute();

        return true;
    }

    public static function alquilarJuego($codigo, $dni)
    {
        $conex = new Conexion();

        $sqlCheck = "SELECT * FROM alquiler WHERE cod_juego = ? AND fecha_devol IS NULL";
        $stmt = $conex->prepare($sqlCheck);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            return false;
        }

        $sql = "INSERT INTO alquiler (cod_juego, dni_cliente, fecha_alquiler) VALUES (?, ?, NOW())";
        $stmt2 = $conex->prepare($sql);
        $stmt2->bind_param("ss", $codigo, $dni);
        $stmt2->execute();

        $sql3 = "UPDATE juegos SET Alquilado = 'SI' WHERE Codigo = ?";
        $stmt3 = $conex->prepare($sql3);
        $stmt3->bind_param("s", $codigo);
        $stmt3->execute();

        return true;
    }

    public static function comprobarDisponibilidad($codigo)
    {
        $conex = new Conexion();
        $sql = "SELECT fecha_alquiler FROM alquiler WHERE cod_juego = ? AND fecha_devol IS NULL";
        $stmt = $conex->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            return "disponible";
        }

        $fila = $res->fetch_object();
        return $fila->fecha_alquiler;
    }

    public static function getJuegoPorCodigo($codigo)
    {
        $conex = new Conexion();

        $sql = "SELECT * FROM juegos WHERE Codigo = ?";
        $stmt = $conex->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();

        return $stmt->get_result()->fetch_object();
    }

    public static function getClienteQueAlquila($codigo)
    {
        $conex = new Conexion();

        $sql = "SELECT c.Nombre, c.Apellidos, c.DNI 
            FROM alquiler a
            JOIN cliente c ON a.dni_cliente = c.DNI
            WHERE a.cod_juego = ? AND a.fecha_devol IS NULL";

        $stmt = $conex->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

}