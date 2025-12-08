<?php
require_once '../modelo/Conexion.php';

class ControladorAlquiler {


    public static function estaAlquilado(string $codigo): bool {
        $conex = new Conexion();
        $sql = "SELECT 1 FROM alquiler WHERE cod_juego = ? AND fecha_devol IS NULL";
        $stmt = $conex->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }


    public static function alquilarJuego(string $codigo, string $dni): bool {
        if (self::estaAlquilado($codigo)) {
            return false;
        }

        $conex = new Conexion();
        $sql = "INSERT INTO alquiler (cod_juego, dni_cliente, fecha_alquiler) VALUES (?, ?, NOW())";
        $stmt = $conex->prepare($sql);
        $stmt->bind_param("ss", $codigo, $dni);
        $stmt->execute();

        $sql2 = "UPDATE juegos SET Alquilado = 'SI' WHERE Codigo = ?";
        $stmt2 = $conex->prepare($sql2);
        $stmt2->bind_param("s", $codigo);
        $stmt2->execute();

        return true;
    }


    public static function devolver(int $idAlquiler, string $dni): array|false {
        $conex = new Conexion();

        // Recuperar datos del alquiler y juego
        $sql = "SELECT 
                    a.id,
                    a.cod_juego,
                    a.fecha_alquiler,
                    a.fecha_devol,
                    j.Precio
                FROM alquiler a
                JOIN juegos j ON a.cod_juego = j.Codigo
                WHERE a.id = ? AND a.dni_cliente = ?";
        $stmt = $conex->prepare($sql);
        $stmt->bind_param("is", $idAlquiler, $dni);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 0) return false;

        $fila = $res->fetch_assoc();

        $fechaAlq = new DateTime($fila['fecha_alquiler']);
        $fechaDev = new DateTime();
        $fechaPrev = clone $fechaAlq;
        $fechaPrev->modify("+7 days");

        // Calcular retraso
        $diasRetraso = 0;
        if ($fechaDev > $fechaPrev) {
            $diff = $fechaDev->diff($fechaPrev);
            $diasRetraso = $diff->days;
        }

        $precioSemana = (float)$fila['Precio'];
        $recargo = $diasRetraso * 1.0;
        $total = $precioSemana + $recargo;

        // Actualizar alquiler
        $sql2 = "UPDATE alquiler SET fecha_devol = ? WHERE id = ?";
        $stmt2 = $conex->prepare($sql2);
        $fechaDevStr = $fechaDev->format('Y-m-d H:i:s');
        $stmt2->bind_param("si", $fechaDevStr, $idAlquiler);
        $stmt2->execute();

        // cambiar juego de si alguilado a no
        $sql3 = "UPDATE juegos SET Alquilado = 'NO' WHERE Codigo = ?";
        $stmt3 = $conex->prepare($sql3);
        $stmt3->bind_param("s", $fila['cod_juego']);
        $stmt3->execute();

        return [
            "precioSemana" => $precioSemana,
            "recargo"      => $recargo,
            "dias"         => $diasRetraso,
            "total"        => $total,
            "cod_juego"    => $fila['cod_juego']
        ];
    }


    public static function getAlquileresCliente(string $dni) {
        $conex = new Conexion();
        $sql = "SELECT 
                    a.*,
                    j.Nombre_juego,
                    j.Nombre_consola,
                    j.Anno,
                    j.Precio,
                    j.Imagen
                FROM alquiler a
                JOIN juegos j ON a.cod_juego = j.Codigo
                WHERE a.dni_cliente = ?
                ORDER BY a.fecha_alquiler DESC";
        $stmt = $conex->prepare($sql);
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        return $stmt->get_result();
    }
}