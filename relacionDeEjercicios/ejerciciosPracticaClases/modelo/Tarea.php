<?php

class Tarea {
    private $id;
    private $nombre;
    private $fecha_ini;
    private $fecha_fin;
    private $horas;
    
    public function __construct($id, $n, $fn, $ff, $h) {
        $this->id=$id;
        $this->nombre=$n;
        $this->fecha_ini=$fn;
        $this->fecha_fin=$ff;
        $this->horas=$h;
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->$name=$value;
    }

}