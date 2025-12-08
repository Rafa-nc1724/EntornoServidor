<?php
class alquiler{
    private $id;
    private $cod_juego;
    private $dni_cliente;
    private $fecha_alquiler;
    private $fecha_devol;

    public function __construct($id,$cod_juego,$dni_cliente,$fecha_alquier,$fecha_devol){
            $this->id = $id;
            $this->cod_juego = $cod_juego;
            $this->dni_cliente = $dni_cliente;
            $this->fecha_alquiler = $fecha_alquier;
            $this->fecha_devol = $fecha_devol;
    }

    public function __get(string $name){
        return $this->$name;
    }

    public function __set($name, $value)
    {
        return $this->$name = $value;
    }

    public function __toString(){
        return "$this->dni_cliente,$this->fecha_alquiler,$this->fecha_devol";
    }
}

