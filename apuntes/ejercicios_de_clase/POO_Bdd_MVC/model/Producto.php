<?php
require_once '../controller/Conexion.php';

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

    public function __get($name)
    {
        return $this->$name;
    }
}