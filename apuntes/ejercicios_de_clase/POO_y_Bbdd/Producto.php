<?php
require_once 'Conexion.php';

/**
 * Clase Producto
 *
 * @property string $nom
 * @property float $pre
 * @property int $cod
 */

class Producto{
    private $cod;
    private $pre;
    private $nom;

    public function __construct($cod=0,$nombre="",$precio=0){
        $this->cod=$cod;
        $this->nom=$nombre;
        $this->pre=$precio;
    }

    public function nuevoProducto($cod,$nom,$pre){
        $this->cod=$cod;
        $this->nom=$nom;
        $this->pre=$pre;
    }

    public function __toString()
    {
        return "<br>Producto[nombre:$this->nom, precio:$this->pre, codigo:$this->cod].";
    }

    public function insert(){
        try{
            $conex= new Conexion();
            $conex->query("INSERT INTO Producto (nombre,precio,codigo) VALUES ('$this->nom',$this->pre,$this->cod) ");
            $fila=$conex->affected_rows;
            $conex->close();
            return $fila;
        }catch(Exception $ex){
            echo "<a href='index.php'>Ir a inicio</a><br>";
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
            echo "<a href='index.php'>Ir a inicio</a><br>";
            die("ERROR CON LA BASE DE DATOS: ".$ex->getMessage());
        }
    }

    public static function seeAll(){
        try{
            $conex=new Conexion();
            $result=$conex->query("SELECT * FROM Producto");
            if($result->num_rows){
                //$p=new self();
                while($fila=$result->fetch_object()){
                    //$p->nuevoProducto($fila->codigo,$fila->nombre,$fila->precio);
                    $p=new self($fila->cod,$fila->nom,$fila->pre);
                    $productos[]=$p;
                    //$productos[]=clone($p);
                }
            }
            else $productos=false;
            $conex->close();
            return $productos;            
        } catch (Exception $ex) {
            echo "<a href=index.php>Ir a inicio</a>";
            die("ERROR CON LA BD: ".$ex->getMessage());
        }
    }
}