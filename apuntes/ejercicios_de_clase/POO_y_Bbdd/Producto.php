<?php
require_once 'Conexion.php';

/**
 * Clase Producto
 *
 * @property string $nombre
 * @property float $precio
 * @property int $codigo
 */

class Producto{
    private $codigo;
    private $precio;
    private $nombre;

    public function __construct($codigo=0,$nombre="",$precio=0){
        $this->codigo=$codigo;
        $this->nombre=$nombre;
        $this->precio=$precio;
    }

    public function nuevoProducto($codigo,$nombre,$precio){
        $this->codigo=$codigo;
        $this->nombre=$nombre;
        $this->precio=$precio;
    }

    public function __toString()
    {
        return "<br>Producto[nombre:$this->nombre, precio:$this->precio, codigo:$this->codigo].";
    }

    public function insert(){
        try{
            $conex= new Conexion();
            $conex->query("INSERT INTO Producto (nombre,precio,codigo) VALUES ('$this->nombre',$this->precio,$this->codigo) ");
            $fila=$conex->affected_rows;
            $conex->close();
            return $fila;
        }catch(Exception $ex){
            echo "<a href='index.php'>Ir a inicio</a><br>";
            die("ERROR CON LA BASE DE DATOS: ".$ex->getMessage());
        }
    }

    public static function search($codigo){
        try{
            $conex=new Conexion();
            $result=$conex->query("SELECT * FROM Producto WHERE codigo=$codigo");
            if($result->num_rows){
                $reg=$result->fetch_object();
                $p=new Producto($reg->codigo,$reg->nombre,$reg->precio);
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

                    $p=new self($fila->codigo,$fila->nombre,$fila->precio);
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

    public function __get($name)
    {
        return $this->$name;
    }


}