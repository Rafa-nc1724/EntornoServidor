<?php

require_once '../controlador/Conexion.php';
require_once '../modelo/Tarea.php';

class ControladorTareas {

    public static function crearTarea($nom, $fini, $ffin, $part) {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("insert into tarea (nombre, fecha_inicio, fecha_fin, horas) values(?,?,?,?)");
            $horas = 0;
            $stmt->bind_param("sssi", $nom, $fini, $ffin, $horas);
            $stmt->execute();
            if ($resul = $stmt->affected_rows) {
                $resul = $conex->execute_query("select max(id) as id from tarea");
                $id = $resul->fetch_object();
                foreach ($part as $email) {
                    $conex->execute_query("insert into realiza values('$email', $id->id, 0)");
                }
            }
        } catch (Exception $ex) {
            
        }
    }

    public static function getTareas($emp) {
        try {
            $conex = new Conexion();
            $resul = $conex->execute_query("select * from tarea join realiza where id_tarea=id and email='" . $emp . "'");
            if ($resul->num_rows) {
                $tareas = [];
                while ($t = $resul->fetch_object()) {
                    $tareas[] = new Tarea($t->id, $t->nombre, $t->fecha_inicio, $t->fecha_fin, $t->horas);
                }

                return $tareas;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function modificarTarea($id, $h, $email) {
        try {
            $conex = new Conexion();
            $conex->autocommit(false);
            $conex->execute_query("update realiza set horas=$h where id_tarea=$id and email='$email'");
            if ($conex->affected_rows) {
                $conex->execute_query("update tarea set horas=horas+$h where id=$id");
                if ($conex->affected_rows) {
                    $conex->commit();
                    return true;
                } else {
                    $conex->rollback();
                    return false;
                }
            } else {
                $conex->rollback();
                return false;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
