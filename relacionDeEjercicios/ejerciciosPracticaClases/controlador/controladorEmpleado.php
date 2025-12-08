<?php

require_once '../controlador/Conexion.php';
require_once '../modelo/Empleado.php';

class ControladorEmpleado {

    public static function verificarEmpelado($email, $pass) {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("select * from empleado where email=? and pass=?");
            $stmt->bind_param("ss", $email, $pass);
            $stmt->execute();
            $resul = $stmt->get_result();
            if($resul->num_rows > 0){
               $e = $resul->fetch_object();
               return new Empleado($e->email, $e->pass, $e->nombre, $e->salario, $e->departamento);
                
            }else{
                return null;
            }
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public static function getEmpladosDept($dep) {
        try {
            $conex = new Conexion();
            $result = $conex->execute_query("select * from empleado where departamento='".$dep."'");
            $array = [];
            while ($e = $result->fetch_object()){
                $array[] = new Empleado($e->email, $e->pass, $e->nombre, $e->salario, $e->departamento);
            }
            
            return $array;
            
        } catch (Exception $ex) {
            
        }
        
    }
    
}