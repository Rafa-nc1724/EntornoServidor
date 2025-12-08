<?php
require_once '../modelo/Cliente.php';
require_once '../modelo/Conexion.php';

class ControladorCliente {

    // Registrar cliente con contraseña encriptada
    public static function insertaCliente($dni, $nombre, $apellidos, $direccion, $localidad, $clave, $tipo = 'cliente') {
        try {
            $conex = new Conexion();

            if (self::existeDni($dni)) {
                echo "<p style='color:red'>El DNI ya está registrado.</p>";
                return false;
            }

            $stmt = $conex->prepare("INSERT INTO alquiler_juegos.cliente (DNI, Nombre, Apellidos, Direccion, Localidad, Clave, Tipo) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?)");

            $claveHash = md5($clave);

            $stmt->bind_param("sssssss", $dni, $nombre, $apellidos, $direccion, $localidad, $claveHash, $tipo);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                echo "<p style='color:red'>Error al registrar el cliente.</p>";
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    // Verificar login del cliente
    public static function verificarCliente($dni, $clave) {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM alquiler_juegos.cliente WHERE DNI = ?");
            $stmt->bind_param("s", $dni);
            $stmt->execute();

            $resul = $stmt->get_result();

            if ($resul->num_rows > 0) {
                $c = $resul->fetch_object();

                if (md5($clave) === $c->Clave) {
                    return new Cliente($c->DNI, $c->Nombre, $c->Apellidos, $c->Direccion, $c->Localidad, $c->Clave, $c->Tipo);
                } else {
                    echo "<p style='color:red'>Contraseña incorrecta.</p>";
                    return false;
                }
            } else {
                echo "<p style='color:red'>El usuario no existe.</p>";
                return false;
            }

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    // Comprobar si un DNI ya existe
    public static function existeDni($dni) {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT DNI FROM alquiler_juegos.cliente WHERE DNI = ?");
            $stmt->bind_param("s", $dni);
            $stmt->execute();
            $res = $stmt->get_result();
            return ($res->num_rows > 0);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Obtener cliente por DNI
    public static function getClientePorDni($dni) {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM alquiler_juegos.cliente WHERE DNI = ?");
            $stmt->bind_param("s", $dni);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                $c = $res->fetch_object();
                return new Cliente($c->DNI, $c->Nombre, $c->Apellidos, $c->Direccion, $c->Localidad, $c->Clave, $c->Tipo);
            }
            return null;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Saber si un cliente es administrador
    public static function esAdmin($dni) {
        $cliente = self::getClientePorDni($dni);
        if (!$cliente) return false;
        return ($cliente->getTipo() === 'admin');
    }
}