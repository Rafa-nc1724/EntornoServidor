<?php
require_once '../controller/Conexion.php';
require_once'../model/Producto.php';

class ProductoControl{

    public static function insert($p){
        try{
            $conex= new Conexion();
            $conex->query("INSERT INTO Producto (nombre,precio,codigo) VALUES ('$p->nom',$p->pre,$p->cod) ");
            $fila=$conex->affected_rows;
            $conex->close();
            return $fila;
        }catch(Exception $ex){
            echo "<a href='index.php'>Ir a inicio</a>";
            die("ERROR CON LA BASE DE DATOS: ".$ex->getMessage());
        }
    }

    public static function search($cod){
        try{
            $conex=new Conexion();
            $result=$conex->query("SELECT * FROM Producto WHERE codigo=$cod");
            if($result->num_rows){
                $reg=$result->fetch_object();
                $p=new Producto($reg->cod,$reg->nom,$reg->pre);
                

            }else $p=false;
            
            $conex->close();
            return $p;
            
        }catch(Exception $ex){
            echo $ex->getMessage();
        }
    }

    public static function seeAll(){
        try{
            $conex= new Conexion();
            $result=$conex->query("SELECT * FROM Producto");
            if($result->num_rows){
                while($fila=$result->fetch_object()){
                    $p=new self($fila->codigo,$fila->nombre,$fila->precio);
                    $productos[]=$p;
                }
            }else $productos=false;
            $conex->close();
            return $productos;
        }catch(Exception $ex){

        }
    }
}