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
}