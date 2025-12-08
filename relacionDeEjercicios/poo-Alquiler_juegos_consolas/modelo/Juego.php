<?php

class Juego
{
    private $nombre_juego;
    private $nombre_consola;
    private $anno;
    private $precio;
    private $imagen;
    private $descripcion;

    public function __construct($nombre_juego, $nombre_consola, $anno, $precio, $imagen, $descripcion)
    {
        $this->nombre_juego = $nombre_juego;
        $this->nombre_consola = $nombre_consola;
        $this->anno = $anno;
        $this->precio = $precio;
        $this->imagen = $imagen;
        $this->descripcion = $descripcion;
    }

    public function getNombreJuego()
    {
        return $this->nombre_juego;
    }

    public function getNombreConsola()
    {
        return $this->nombre_consola;
    }

    public function getAnno()
    {
        return $this->anno;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setNombreJuego($nombre_juego)
    {
        $this->nombre_juego = $nombre_juego;
    }

    public function setNombreConsola($nombre_consola)
    {
        $this->nombre_consola = $nombre_consola;
    }

    public function setAnno($anno)
    {
        $this->anno = $anno;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function __toString()
    {
        return "Nombre del juego: " . $this->nombre_juego . ", Nombre de consola: " . $this->nombre_consola . " Año de salida: " . $this->anno . " Precio: " . $this->precio . " Imagen: " . $this->imagen;
    }
}